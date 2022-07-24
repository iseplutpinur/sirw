<?php

namespace App\Repository\Admin\Kependudukan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;

use App\Helpers\AppHelper;
use App\Models\DataMaster\HubunganDenganKK;
use App\Models\DataMaster\RukunTetangga;
use App\Models\Kependudukan\KartuKeluarga;
use App\Models\Kependudukan\KartuKeluarga\Rt as KartuKeluargaRt;
use App\Models\Kependudukan\KartuKeluarga\Transaksi as KartuKeluargaTransaksi;
use App\Models\Kependudukan\KartuKeluarga\Negara as KartuKeluargaNegara;
use App\Models\Kependudukan\KartuKeluarga\Data as KartuKeluargaData;
use App\Models\Kependudukan\Penduduk;

class KartuKeluargaRepository
{
    private $image_folder = KartuKeluarga::image_folder;
    private $validate_model = [
        'no' => ['nullable', 'string', 'max:16'],
        'alamat_lengkap' => ['required', 'string'],
        'tanggal_dibuat' => ['required', 'date'],
        'tanggal_hapus' => ['nullable', 'date'],
        'asal_data' => ['required', 'int'],

        // validasi rt
        'rt_id' => ['required', 'int'],
        // validasi negara
        'negara' => ['required', 'int'],
        'negara_nama' => ['nullable', 'string'],
        'negara_dari' => ['nullable', 'date'],
    ];

    public function insert(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate($this->validate_model);

            // kartu keluarga
            $model = new KartuKeluarga();
            $model->no = $request->no;
            $model->alamat_lengkap = $request->alamat_lengkap;
            // tanggal masuk ke lingkungan rw

            $model->tanggal_dibuat = $request->tanggal_dibuat;

            if ($image = $request->file('foto')) {
                $foto_kk = AppHelper::slugify($request->no) . substr($request->slug, 0, 10) . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($this->image_folder, $foto_kk);
                $model->foto = $foto_kk;
            }

            $model->save();

            // kartu keluarga rt
            $rt = new KartuKeluargaRt();
            $rt->kartu_keluarga_id = $model->id;
            $rt->rt_id = $request->rt_id;
            $rt_dari = $request->rt_dari;
            $rt_dari = $rt_dari ?? $request->tanggal_dibuat;
            $rt->dari = $rt_dari;
            $rt->save();

            // kartu keluarga transaksi
            // asal data 0 dibuat di rt stempat. 1 pendatang
            if ($model->asal_data == 1) {
                $transaksi = new KartuKeluargaTransaksi();
                $transaksi->kartu_keluarga_id = $model->id;
                $transaksi->rt_id = $request->datang_rt_id;
                $transaksi->keterangan = $request->datang_keterangan;
                $transaksi->tanggal = $request->tanggal_dibuat ?? date('Y-m-d');
                $transaksi->jenis = 2;
                $transaksi->save();
            }

            // negara 0 wna, 1 wni
            $negara = new KartuKeluargaNegara();
            $negara->kartu_keluarga_id = $model->id;
            $negara->negara = $request->negara;
            $negara->negara_nama = $request->negara_nama;
            $negara->dari = $request->negara_dari ?? $request->tanggal_dibuat;
            $negara->save();

            DB::commit();
            return response()->json([
                'data' => $model,
            ], 200);
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function datatable(Request $request)
    {
        $filter = $request->filter;
        // list table
        $table_penduduk = Penduduk::tableName;
        $table_hd_kk = HubunganDenganKK::tableName;

        $table_kk = KartuKeluarga::tableName;
        $table_kk_list = KartuKeluargaData::tableName;
        $table_rt = RukunTetangga::tableName;
        $table_kk_rt = KartuKeluargaRt::tableName;
        $table_kk_negara = KartuKeluargaNegara::tableName;

        $base_url_image_folder = url(str_replace('./', '', $this->image_folder)) . '/';
        // cusotm query
        // ========================================================================================================
        // get list anggota kk dengan no urut terendah
        $c_jumlah_anggota = 'jumlah_anggota';
        $this->query[$c_jumlah_anggota] = <<<SQL
            (select count(*) from $table_kk_list where $table_kk_list.kartu_keluarga_id = $table_kk.id and $table_kk_list.sampai is null)
        SQL;
        $this->query["{$c_jumlah_anggota}_alias"] = $c_jumlah_anggota;

        $c_anggota = 'anggota';
        $this->query[$c_anggota] = <<<SQL
            (select concat($table_penduduk.nama, '[', $table_hd_kk.singkatan , ']') from $table_penduduk
                join $table_kk_list on $table_penduduk.id = $table_kk_list.penduduk_id
                join $table_hd_kk on $table_kk_list.hubungan_dengan_kk_id = $table_hd_kk.id
                where $table_kk_list.kartu_keluarga_id = $table_kk.id and $table_kk_list.sampai is null
                order by $table_hd_kk.urut asc limit 1)
        SQL;
        $this->query["{$c_anggota}_alias"] = $c_anggota;

        // rt
        $rt_fun = function (string $select, string $alias) use ($table_rt, $table_kk_rt, $table_kk): array {
            $str = <<<SQL
                (select $table_rt.$select from $table_rt
                    join $table_kk_rt on
                        $table_rt.id = $table_kk_rt.rt_id
                    where $table_kk_rt.kartu_keluarga_id = $table_kk.id
                    order by $table_kk_rt.dari desc limit 1)
            SQL;
            $result = [];
            $result[$alias] = $str;
            $result[$alias . '_alias'] = $alias;
            return $result;
        };
        $c_rt = 'rt';
        $c_rt_nama = 'rt_nama';
        $c_rt_id = 'rt_id';
        $this->query = array_merge($this->query, $rt_fun('nomor', $c_rt));
        $this->query = array_merge($this->query, $rt_fun('nama', $c_rt_nama));
        $this->query = array_merge($this->query, $rt_fun('id', $c_rt_id));

        $c_created = 'created';
        $this->query[$c_created] = <<<SQL
                (DATE_FORMAT($table_kk.created_at, '%d-%b-%Y'))
        SQL;
        $this->query["{$c_created}_alias"] = $c_created;

        $c_created_str = 'created_str';
        $this->query[$c_created_str] = <<<SQL
                (DATE_FORMAT($table_kk.created_at, '%W, %d %M %Y %H:%i:%s'))
        SQL;
        $this->query["{$c_created_str}_alias"] = $c_created_str;

        $c_updated = 'updated';
        $this->query[$c_updated] = <<<SQL
                (DATE_FORMAT($table_kk.updated_at, '%d-%b-%Y'))
        SQL;
        $this->query["{$c_updated}_alias"] = $c_updated;

        $c_updated_str = 'updated_str';
        $this->query[$c_updated_str] = <<<SQL
                (DATE_FORMAT($table_kk.updated_at, '%W, %d %M %Y %H:%i:%s'))
        SQL;
        $this->query["{$c_updated_str}_alias"] = $c_updated_str;

        $c_tanggal_dibuat_str = 'tanggal_dibuat_str';
        $this->query[$c_tanggal_dibuat_str] = <<<SQL
                (DATE_FORMAT($table_kk.tanggal_dibuat, '%d-%b-%Y'))
        SQL;
        $this->query["{$c_tanggal_dibuat_str}_alias"] = $c_tanggal_dibuat_str;

        $c_foto_link = 'foto_link';
        $this->query[$c_foto_link] = <<<SQL
                (concat('$base_url_image_folder',$table_kk.foto))
        SQL;
        $this->query["{$c_foto_link}_alias"] = $c_foto_link;

        // negara
        $c_negara = 'negara';
        $this->query[$c_negara] = <<<SQL
                (select negara from $table_kk_negara where $table_kk_negara.kartu_keluarga_id = $table_kk.id
                    order by $table_kk_negara.dari desc limit 1)
        SQL;
        $this->query["{$c_negara}_alias"] = $c_negara;

        $c_negara_nama = 'negara_nama';
        $this->query[$c_negara_nama] = <<<SQL
                (select negara_nama from $table_kk_negara where $table_kk_negara.kartu_keluarga_id = $table_kk.id
                    order by $table_kk_negara.dari desc limit 1)
        SQL;
        $this->query["{$c_negara_nama}_alias"] = $c_negara_nama;

        // ========================================================================================================


        // ========================================================================================================
        // select raw as alias
        $sraa = function (string $col): string {
            return $this->query[$col] . ' as ' . $this->query[$col . '_alias'];
        };
        $model_filter = [
            $c_foto_link,
            $c_created,
            $c_created_str,
            $c_updated,
            $c_updated_str,
            $c_jumlah_anggota,
            $c_anggota,
            $c_rt,
            $c_rt_nama,
            $c_negara,
            $c_negara_nama,
            $c_tanggal_dibuat_str
        ];

        $to_db_raw = array_map(function ($a) use ($sraa) {
            return DB::raw($sraa($a));
        }, $model_filter);

        $model = KartuKeluarga::select(array_merge([
            "$table_kk.id",
            "$table_kk.no",
            "$table_kk.alamat_lengkap",
            "$table_kk.tanggal_dibuat",
            "$table_kk.tanggal_hapus",
            "$table_kk.asal_data"
        ], $to_db_raw));

        // filter check
        $f_c = function (string $param) use ($filter): mixed {
            return isset($filter[$param]) ? $filter[$param] : false;
        };

        $f = [$c_rt_id];

        // loop filter
        foreach ($f as $v) {
            if ($f_c($v)) {
                $model->whereRaw("{$this->query[$v]}='{$f_c($v)}'");
            }
        }

        $datatable = Datatables::of($model)->addIndexColumn();
        foreach ($model_filter as $v) {
            // custom pencarian
            $datatable->filterColumn($this->query["{$v}_alias"], function ($query, $keyword) use ($v) {
                $query->whereRaw("({$this->query[$v]} like '%$keyword%')");
            });
        }

        // create datatable
        return $datatable->make(true);
    }
}
