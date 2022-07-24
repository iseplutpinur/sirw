<?php

namespace App\Http\Controllers\Admin\Kependudukan;

use Illuminate\Support\Facades\DB;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;

use App\Models\DataMaster\Agama;
use App\Models\DataMaster\Pekerjaan;
use App\Models\DataMaster\Pendidikan;
use App\Models\DataMaster\StatusKawin;
use App\Models\DataMaster\StatusPenduduk;
use App\Models\DataMaster\RukunTetangga;
use App\Models\Kependudukan\Penduduk;
use App\Models\Kependudukan\Penduduk\Agama as PendudukAgama;
use App\Models\Kependudukan\Penduduk\Akte as PendudukAkte;
use App\Models\Kependudukan\Penduduk\Ktp as PendudukKtp;
use App\Models\Kependudukan\Penduduk\Negara as PendudukNegara;
use App\Models\Kependudukan\Penduduk\Rt as PendudukRt;
use App\Models\Kependudukan\Penduduk\Transaksi as PendudukTransaksi;
use App\Models\Kependudukan\Penduduk\Pendidikan as PendudukPendidikan;
use App\Models\Kependudukan\Penduduk\Pekerjaan as PendudukPekerjaan;
use App\Models\Kependudukan\Penduduk\StatusKawin as PendudukStatusKawin;
use App\Models\Kependudukan\Penduduk\Status as PendudukStatus;

class PendudukController extends Controller
{
    private $folder_akte = PendudukAkte::image_folder;
    private $folder_ktp = PendudukKtp::image_folder;

    private $validate_model = [
        'nama' => ['required', 'string', 'max:255'],
        'nik' => ['nullable', 'string', 'max:16'],
        'kota_lahir' => ['required', 'string', 'max:255'],
        'jenis_kelamin' => ['required', 'string', 'max:255'],
        'no_hp' => ['nullable', 'string', 'max:255'],
        'alamat_lengkap' => ['required', 'string'],
        'tanggal_lahir' => ['required', 'date'],
        'tanggal_mati' => ['nullable', 'date'],
        'asal_data' => ['required', 'int'],
        'tinggal_dari_tanggal' => ['nullable', 'date'],

        // validasi rt
        'rt_id' => ['required', 'int'],

        // validasi ktp
        'ktp_status' => ['required', 'int'],
        'ktp_dari' => ['nullable', 'date'],

        // validasi akte
        'akte_status' => ['required', 'int'],
        'akte_dari' => ['nullable', 'date'],

        // validasi agama
        'agama_id' => ['required', 'int'],
        'agama_dari' => ['nullable', 'date'],

        // validasi pendidikan
        'pendidikan_id' => ['required', 'int'],
        'pendidikan_dari' => ['nullable', 'date'],

        // validasi pekerjaan
        'pekerjaan_id' => ['required', 'int'],
        'pekerjaan_dari' => ['nullable', 'date'],

        // validasi status_kawin
        'status_kawin_id' => ['required', 'int'],
        'status_kawin_dari' => ['nullable', 'date'],

        // validasi negara
        'negara' => ['required', 'int'],
        'negara_nama' => ['nullable', 'string'],
        'negara_dari' => ['nullable', 'date'],

        // validasi status_penduduk
        'status_penduduk_id' => ['required', 'int'],
        'status_penduduk_dari' => ['nullable', 'date'],
    ];

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->datatable($request);
        }
        $page_attr = [
            'title' => 'Manage List Penduduk',
            'breadcrumbs' => [
                ['name' => 'Dashboard'],
                ['name' => 'Data Master'],
            ]
        ];

        $agamas = Agama::where('status', '=', 1)->get();
        $pendidikans = Pendidikan::where('status', '=', 1)->get();
        $pekerjaans = Pekerjaan::where('status', '=', 1)->get();
        $status_kawins = StatusKawin::where('status', '=', 1)->get();
        $status_penduduks = StatusPenduduk::where('status', '=', 1)->get();
        $rts = RukunTetangga::all();
        $folder_akte = $this->folder_akte;
        $folder_ktp = $this->folder_ktp;
        $data = compact(
            'page_attr',
            'agamas',
            'pendidikans',
            'pekerjaans',
            'status_kawins',
            'status_penduduks',
            'rts',
            'folder_akte',
            'folder_ktp'
        );
        return view('admin.kependudukan.penduduk', array_merge($data, ['compact' => $data]));
    }

    private function datatable(Request $request)
    {
        $filter = $request->filter;
        // list table
        $table_penduduk = Penduduk::tableName;

        // data master ============================================================================================
        // rt
        $table_penduduk_rt = PendudukRt::tableName;
        $table_rt = RukunTetangga::tableName;
        $table_penduduk_ktp = PendudukKtp::tableName;
        $table_penduduk_akte = PendudukAkte::tableName;
        $table_penduduk_agama = PendudukAgama::tableName;
        $table_agama = Agama::tableName;
        $table_penduduk_pendidikan = PendudukPendidikan::tableName;
        $table_pendidikan = Pendidikan::tableName;
        $table_penduduk_pekerjaan = PendudukPekerjaan::tableName;
        $table_pekerjaan = Pekerjaan::tableName;
        $table_penduduk_status_kawin = PendudukStatusKawin::tableName;
        $table_status_kawin = StatusKawin::tableName;
        $table_penduduk_status_penduduk = PendudukStatus::tableName;
        $table_status_penduduk = StatusPenduduk::tableName;
        $table_penduduk_negara = PendudukNegara::tableName;

        // cusotm query
        // get list anggota kk dengan no urut terendah
        // ========================================================================================================
        // rt
        $this->query['rt'] = <<<SQL
                                (select $table_rt.nomor from $table_rt
                                    join $table_penduduk_rt on
                                        $table_rt.id = $table_penduduk_rt.rt_id
                                    where $table_penduduk_rt.penduduk_id = $table_penduduk.id
                                    order by $table_penduduk_rt.dari desc limit 1)
                        SQL;
        $this->query['rt_alias'] = 'rt';
        $this->query['rt_nama'] = <<<SQL
                                (select $table_rt.nama from $table_rt
                                    join $table_penduduk_rt on
                                        $table_rt.id = $table_penduduk_rt.rt_id
                                    where $table_penduduk_rt.penduduk_id = $table_penduduk.id
                                    order by $table_penduduk_rt.dari desc limit 1)
                        SQL;
        $this->query['rt_nama_alias'] = 'rt_nama';
        $this->query['rt_id'] = <<<SQL
                                (select $table_rt.id from $table_rt
                                    join $table_penduduk_rt on
                                        $table_rt.id = $table_penduduk_rt.rt_id
                                    where $table_penduduk_rt.penduduk_id = $table_penduduk.id
                                    order by $table_penduduk_rt.dari desc limit 1)
                        SQL;
        $this->query['rt_id_alias'] = 'rt_id';

        // ktp
        $this->query['ktp_ada'] = <<<SQL
                            (select `status` from $table_penduduk_ktp where $table_penduduk_ktp.penduduk_id = $table_penduduk.id
                                order by $table_penduduk_ktp.dari desc limit 1)
                        SQL;
        $this->query['ktp_ada_alias'] = 'ktp_ada';

        // akte
        $this->query['akte_ada'] = <<<SQL
                            (select `status` from $table_penduduk_akte where $table_penduduk_akte.penduduk_id = $table_penduduk.id
                                order by $table_penduduk_akte.dari desc limit 1)
                        SQL;
        $this->query['akte_ada_alias'] = 'akte_ada';

        // agama
        $this->query['agama'] = <<<SQL
                (select $table_agama.singkatan from $table_agama
                    join $table_penduduk_agama on
                        $table_agama.id = $table_penduduk_agama.agama_id
                    where $table_penduduk_agama.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_agama.dari desc limit 1)
        SQL;
        $this->query['agama_alias'] = 'agama';

        $this->query['agama_nama'] = <<<SQL
                (select $table_agama.nama from $table_agama
                    join $table_penduduk_agama on
                        $table_agama.id = $table_penduduk_agama.agama_id
                    where $table_penduduk_agama.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_agama.dari desc limit 1)
        SQL;
        $this->query['agama_nama_alias'] = 'agama_nama';

        $this->query['agama_id'] = <<<SQL
                (select $table_agama.id from $table_agama
                    join $table_penduduk_agama on
                        $table_agama.id = $table_penduduk_agama.agama_id
                    where $table_penduduk_agama.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_agama.dari desc limit 1)
        SQL;
        $this->query['agama_id_alias'] = 'agama_id';

        // pendidikan
        $this->query['pendidikan'] = <<<SQL
                (select $table_pendidikan.singkatan from $table_pendidikan
                    join $table_penduduk_pendidikan on
                        $table_pendidikan.id = $table_penduduk_pendidikan.pendidikan_id
                    where $table_penduduk_pendidikan.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_pendidikan.dari desc limit 1)
        SQL;
        $this->query['pendidikan_alias'] = 'pendidikan';
        $this->query['pendidikan_nama'] = <<<SQL
                (select $table_pendidikan.nama from $table_pendidikan
                    join $table_penduduk_pendidikan on
                        $table_pendidikan.id = $table_penduduk_pendidikan.pendidikan_id
                    where $table_penduduk_pendidikan.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_pendidikan.dari desc limit 1)
        SQL;
        $this->query['pendidikan_nama_alias'] = 'pendidikan_nama';
        $this->query['pendidikan_id'] = <<<SQL
                (select $table_pendidikan.id from $table_pendidikan
                    join $table_penduduk_pendidikan on
                        $table_pendidikan.id = $table_penduduk_pendidikan.pendidikan_id
                    where $table_penduduk_pendidikan.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_pendidikan.dari desc limit 1)
        SQL;
        $this->query['pendidikan_id_alias'] = 'pendidikan_id';

        // pekerjaan
        $this->query['pekerjaan'] = <<<SQL
                (select $table_pekerjaan.singkatan from $table_pekerjaan
                    join $table_penduduk_pekerjaan on
                        $table_pekerjaan.id = $table_penduduk_pekerjaan.pekerjaan_id
                    where $table_penduduk_pekerjaan.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_pekerjaan.dari desc limit 1)
        SQL;
        $this->query['pekerjaan_alias'] = 'pekerjaan';
        $this->query['pekerjaan_nama'] = <<<SQL
                (select $table_pekerjaan.nama from $table_pekerjaan
                    join $table_penduduk_pekerjaan on
                        $table_pekerjaan.id = $table_penduduk_pekerjaan.pekerjaan_id
                    where $table_penduduk_pekerjaan.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_pekerjaan.dari desc limit 1)
        SQL;
        $this->query['pekerjaan_nama_alias'] = 'pekerjaan_nama';
        $this->query['pekerjaan_id'] = <<<SQL
                (select $table_pekerjaan.id from $table_pekerjaan
                    join $table_penduduk_pekerjaan on
                        $table_pekerjaan.id = $table_penduduk_pekerjaan.pekerjaan_id
                    where $table_penduduk_pekerjaan.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_pekerjaan.dari desc limit 1)
        SQL;
        $this->query['pekerjaan_id_alias'] = 'pekerjaan_id';

        // status_kawin
        $this->query['status_kawin'] = <<<SQL
                (select $table_status_kawin.singkatan from $table_status_kawin
                    join $table_penduduk_status_kawin on
                        $table_status_kawin.id = $table_penduduk_status_kawin.status_kawin_id
                    where $table_penduduk_status_kawin.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_status_kawin.dari desc limit 1)
        SQL;
        $this->query['status_kawin_alias'] = 'status_kawin';
        $this->query['status_kawin_nama'] = <<<SQL
                (select $table_status_kawin.nama from $table_status_kawin
                    join $table_penduduk_status_kawin on
                        $table_status_kawin.id = $table_penduduk_status_kawin.status_kawin_id
                    where $table_penduduk_status_kawin.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_status_kawin.dari desc limit 1)
        SQL;
        $this->query['status_kawin_nama_alias'] = 'status_kawin_nama';
        $this->query['status_kawin_id'] = <<<SQL
                (select $table_status_kawin.id from $table_status_kawin
                    join $table_penduduk_status_kawin on
                        $table_status_kawin.id = $table_penduduk_status_kawin.status_kawin_id
                    where $table_penduduk_status_kawin.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_status_kawin.dari desc limit 1)
        SQL;
        $this->query['status_kawin_id_alias'] = 'status_kawin_id';

        // status_penduduk
        $this->query['status_penduduk'] = <<<SQL
                (select $table_status_penduduk.singkatan from $table_status_penduduk
                    join $table_penduduk_status_penduduk on
                        $table_status_penduduk.id = $table_penduduk_status_penduduk.status_penduduk_id
                    where $table_penduduk_status_penduduk.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_status_penduduk.dari desc limit 1)
        SQL;
        $this->query['status_penduduk_alias'] = 'status_penduduk';
        $this->query['status_penduduk_nama'] = <<<SQL
                (select $table_status_penduduk.nama from $table_status_penduduk
                    join $table_penduduk_status_penduduk on
                        $table_status_penduduk.id = $table_penduduk_status_penduduk.status_penduduk_id
                    where $table_penduduk_status_penduduk.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_status_penduduk.dari desc limit 1)
        SQL;
        $this->query['status_penduduk_nama_alias'] = 'status_penduduk_nama';
        $this->query['status_penduduk_id'] = <<<SQL
                (select $table_status_penduduk.id from $table_status_penduduk
                    join $table_penduduk_status_penduduk on
                        $table_status_penduduk.id = $table_penduduk_status_penduduk.status_penduduk_id
                    where $table_penduduk_status_penduduk.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_status_penduduk.dari desc limit 1)
        SQL;
        $this->query['status_penduduk_id_alias'] = 'status_penduduk_id';

        // tanggal lahir
        $this->query['tanggal_lahir_str'] = <<<SQL
                (DATE_FORMAT($table_penduduk.tanggal_lahir, '%d-%b-%Y'))
        SQL;
        $this->query['tanggal_lahir_str_alias'] = 'tanggal_lahir_str';
        $this->query['tanggal_mati_str'] = <<<SQL
                (DATE_FORMAT($table_penduduk.tanggal_mati, '%d-%b-%Y'))
        SQL;
        $this->query['tanggal_mati_str_alias'] = 'tanggal_mati_str';

        $this->query['umur'] = <<<SQL
                (SELECT TIMESTAMPDIFF(YEAR, $table_penduduk.tanggal_lahir, (ifnull( $table_penduduk.tanggal_mati , CURDATE()))))
        SQL;
        $this->query['umur_alias'] = 'umur';

        $this->query['umur_bulan'] = <<<SQL
                (SELECT TIMESTAMPDIFF(MONTH, $table_penduduk.tanggal_lahir, (ifnull( $table_penduduk.tanggal_mati , CURDATE()))))
        SQL;
        $this->query['umur_bulan_alias'] = 'umur_bulan';

        $this->query['umur_hari'] = <<<SQL
                (SELECT TIMESTAMPDIFF(DAY, $table_penduduk.tanggal_lahir, (ifnull( $table_penduduk.tanggal_mati , CURDATE()))))
        SQL;
        $this->query['umur_hari_alias'] = 'umur_hari';

        // negara
        $this->query['negara'] = <<<SQL
                (select negara from $table_penduduk_negara where $table_penduduk_negara.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_negara.dari desc limit 1)
        SQL;
        $this->query['negara_alias'] = 'negara';
        $this->query['negara_nama'] = <<<SQL
                (select nama from $table_penduduk_negara where $table_penduduk_negara.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_negara.dari desc limit 1)
        SQL;
        $this->query['negara_nama_alias'] = 'negara_nama';

        // ========================================================================================================
        $model = Penduduk::select([
            // penduduk
            "$table_penduduk.id",
            "$table_penduduk.nama",
            "$table_penduduk.nik",
            "$table_penduduk.kota_lahir",
            "$table_penduduk.jenis_kelamin",
            "$table_penduduk.no_hp",
            "$table_penduduk.alamat_lengkap",
            "$table_penduduk.tanggal_lahir",
            "$table_penduduk.tanggal_mati",
            "$table_penduduk.asal_data",

            // data master
            DB::raw("{$this->query['rt']} as {$this->query['rt_alias']}"),
            DB::raw("{$this->query['rt_nama']} as {$this->query['rt_nama_alias']}"),

            DB::raw("{$this->query['ktp_ada']} as {$this->query['ktp_ada_alias']}"),
            DB::raw("{$this->query['akte_ada']} as {$this->query['akte_ada_alias']}"),

            DB::raw("{$this->query['agama']} as {$this->query['agama_alias']}"),
            DB::raw("{$this->query['agama_nama']} as {$this->query['agama_nama_alias']}"),

            DB::raw("{$this->query['pendidikan']} as {$this->query['pendidikan_alias']}"),
            DB::raw("{$this->query['pendidikan_nama']} as {$this->query['pendidikan_nama_alias']}"),

            DB::raw("{$this->query['pekerjaan']} as {$this->query['pekerjaan_alias']}"),
            DB::raw("{$this->query['pekerjaan_nama']} as {$this->query['pekerjaan_nama_alias']}"),

            DB::raw("{$this->query['status_kawin']} as {$this->query['status_kawin_alias']}"),
            DB::raw("{$this->query['status_kawin_nama']} as {$this->query['status_kawin_nama_alias']}"),

            DB::raw("{$this->query['status_penduduk']} as {$this->query['status_penduduk_alias']}"),
            DB::raw("{$this->query['status_penduduk_nama']} as {$this->query['status_penduduk_nama_alias']}"),

            DB::raw("{$this->query['tanggal_lahir_str']} as {$this->query['tanggal_lahir_str_alias']}"),
            DB::raw("{$this->query['tanggal_mati_str']} as {$this->query['tanggal_mati_str_alias']}"),
            DB::raw("{$this->query['umur']} as {$this->query['umur_alias']}"),
            DB::raw("{$this->query['umur_bulan']} as {$this->query['umur_bulan_alias']}"),
            DB::raw("{$this->query['umur_hari']} as {$this->query['umur_hari_alias']}"),

            DB::raw("{$this->query['negara']} as {$this->query['negara_alias']}"),
            DB::raw("{$this->query['negara_nama']} as {$this->query['negara_nama_alias']}"),
        ]);

        // filter
        if ($filter['rt_id']) {
            $model->whereRaw("{$this->query['rt_id']}='{$filter['rt_id']}'");
        }
        if ($filter['jenis_kelamin']) {
            $model->whereRaw("$table_penduduk.jenis_kelamin='{$filter['jenis_kelamin']}'");
        }
        if ($filter['agama']) {
            $model->whereRaw("{$this->query['agama_id']}='{$filter['agama']}'");
        }
        if ($filter['status_kawin']) {
            $model->whereRaw("{$this->query['status_kawin_id']}='{$filter['status_kawin']}'");
        }
        if ($filter['pendidikan']) {
            $model->whereRaw("{$this->query['pendidikan_id']}='{$filter['pendidikan']}'");
        }
        if ($filter['pekerjaan']) {
            $model->whereRaw("{$this->query['pekerjaan_id']}='{$filter['pekerjaan']}'");
        }
        if ($filter['status_penduduk']) {
            $model->whereRaw("{$this->query['status_penduduk_id']}='{$filter['status_penduduk']}'");
        }
        if ($filter['ktp']) {
            $model->whereRaw("{$this->query['ktp_ada']}='{$filter['ktp']}'");
        }
        if ($filter['akte']) {
            $model->whereRaw("{$this->query['akte_ada']}='{$filter['akte']}'");
        }

        return Datatables::of($model)
            ->addIndexColumn()
            // custom pencarian
            ->filterColumn($this->query['rt_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['rt']} like '%$keyword%'");
            })
            ->filterColumn($this->query['rt_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['rt_nama']} like '%$keyword%'");
            })

            ->filterColumn($this->query['ktp_ada_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['ktp_ada']} like '%$keyword%'");
            })
            ->filterColumn($this->query['akte_ada_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['akte_ada']} like '%$keyword%'");
            })

            ->filterColumn($this->query['agama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['agama']} like '%$keyword%'");
            })
            ->filterColumn($this->query['agama_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['agama_nama']} like '%$keyword%'");
            })

            ->filterColumn($this->query['pendidikan_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['pendidikan']} like '%$keyword%'");
            })

            ->filterColumn($this->query['pendidikan_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['pendidikan_nama']} like '%$keyword%'");
            })

            ->filterColumn($this->query['pekerjaan_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['pekerjaan']} like '%$keyword%'");
            })
            ->filterColumn($this->query['pekerjaan_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['pekerjaan_nama']} like '%$keyword%'");
            })

            ->filterColumn($this->query['status_kawin_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['status_kawin']} like '%$keyword%'");
            })
            ->filterColumn($this->query['status_kawin_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['status_kawin_nama']} like '%$keyword%'");
            })

            ->filterColumn($this->query['status_penduduk_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['status_penduduk']} like '%$keyword%'");
            })
            ->filterColumn($this->query['status_penduduk_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['status_penduduk_nama']} like '%$keyword%'");
            })

            ->filterColumn($this->query['tanggal_lahir_str_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['tanggal_lahir_str']} like '%$keyword%'");
            })
            ->filterColumn($this->query['tanggal_mati_str_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['tanggal_mati_str']} like '%$keyword%'");
            })
            ->filterColumn($this->query['umur_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['umur']} like '%$keyword%'");
            })
            ->filterColumn($this->query['umur_bulan_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['umur_bulan']} like '%$keyword%'");
            })
            ->filterColumn($this->query['umur_hari_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['umur_hari']} like '%$keyword%'");
            })

            ->filterColumn($this->query['negara_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['negara']} like '%$keyword%'");
            })
            ->filterColumn($this->query['negara_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['negara_nama']} like '%$keyword%'");
            })
            ->make(true);
    }

    public function insert(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate($this->validate_model);

            // insert data model penduduk =============================================================================
            $model = new Penduduk();
            $model->nama = $request->nama;
            $model->nik = $request->nik;
            $model->kota_lahir = $request->kota_lahir;
            $model->jenis_kelamin = $request->jenis_kelamin;
            $model->no_hp = $request->no_hp;
            $model->alamat_lengkap = $request->alamat_lengkap;
            $model->tanggal_lahir = $request->tanggal_lahir;
            $model->tanggal_mati = $request->tanggal_mati;

            // 0 kelahiran, 1 kedatangan
            $model->asal_data = $request->asal_data;

            // get id
            $model->save();

            // insert data master =====================================================================================
            // rt
            // jika kedatangan 1 maka tambahkan kedalam tabel penduudk rt transaksi
            if ($model->asal_data == 1) {
                $transaksi = new PendudukTransaksi();
                $transaksi->penduduk_id = $model->id;
                $transaksi->rt_id = $request->datang_rt_id;
                $transaksi->keterangan = $request->datang_keterangan;
                $transaksi->tanggal = $request->tinggal_dari_tanggal ?? $request->tanggal_lahir;
                $transaksi->jenis = 2;
                $transaksi->save();
            }

            // simpan ke tanggal di rt sekarang
            $rt = new PendudukRt();
            $rt->penduduk_id = $model->id;
            $rt->rt_id = $request->rt_id;
            $rt_dari = $request->rt_dari;
            $rt_dari = $rt_dari ?? $request->tinggal_dari_tanggal;
            $rt_dari = $rt_dari ?? $request->negara_dari;
            $rt_dari = $rt_dari ?? $request->tanggal_lahir;
            $rt->dari = $rt_dari;
            $rt->save();

            // simpan ktp
            $ktp = new PendudukKtp();
            $ktp->penduduk_id = $model->id;
            $ktp->status = $request->ktp_status;
            $ktp->dari = $request->ktp_dari ?? (date('Y-m-d', strtotime($request->tanggal_lahir . ' + 17 years')));
            // simpan ktp foto
            $foto_ktp = '';
            if ($image = $request->file('ktp_file')) {
                $foto_ktp = $request->nik . AppHelper::slugify($request->nama)  .  '.' .  $image->getClientOriginalExtension();
                $image->move('./' . $this->folder_ktp, $foto_ktp);
                $ktp->foto = $foto_ktp;
            }

            // simpan akte
            $akte = new PendudukAkte();
            $akte->penduduk_id = $model->id;
            $akte->status = $request->akte_status;
            $akte->dari = $request->akte_dari ?? (date('Y-m-d', strtotime($request->tanggal_lahir . ' + 17 years')));
            // simpan akte foto
            $foto_akte = '';
            if ($image = $request->file('akte_file')) {
                $foto_akte = $request->nik . AppHelper::slugify($request->nama)  .  '.' .  $image->getClientOriginalExtension();
                $image->move('./' . $this->folder_akte, $foto_akte);
                $akte->foto = $foto_akte;
            }

            $akte->save();

            // agama
            $agama = new PendudukAgama();
            $agama->penduduk_id = $model->id;
            $agama->agama_id = $request->agama_id;
            $agama->dari = $request->agama_dari ?? $request->tanggal_lahir;
            $agama->save();

            // pendidikan
            $pendidikan = new PendudukPendidikan();
            $pendidikan->penduduk_id = $model->id;
            $pendidikan->pendidikan_id = $request->pendidikan_id;
            $pendidikan->dari = $request->pendidikan_dari ?? $request->tanggal_lahir;
            $pendidikan->save();

            // pekerjaan
            $pekerjaan = new PendudukPekerjaan();
            $pekerjaan->penduduk_id = $model->id;
            $pekerjaan->pekerjaan_id = $request->pekerjaan_id;
            $pekerjaan->dari = $request->pekerjaan_dari ?? $request->tanggal_lahir;
            $pekerjaan->save();

            // status_kawin
            $status_kawin = new PendudukStatusKawin();
            $status_kawin->penduduk_id = $model->id;
            $status_kawin->status_kawin_id = $request->status_kawin_id;
            $status_kawin->dari = $request->status_kawin_dari ?? $request->tanggal_lahir;
            $status_kawin->save();

            // negara 0 wna, 1 wni
            $negara = new PendudukNegara();
            $negara->penduduk_id = $model->id;
            $negara->negara = $request->negara;
            $negara->negara_nama = $request->negara_nama;
            $negara->dari = $request->negara_dari ?? $request->tanggal_lahir;
            $negara->save();

            // status
            $status = new PendudukStatus();
            $status->penduduk_id = $model->id;
            $status->status_penduduk_id = $request->status_penduduk_id;
            $status->dari = $request->status_dari ?? $request->tanggal_lahir;
            $status->save();

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

    public function delete(Penduduk $model)
    {
        try {
            DB::beginTransaction();
            // delete peristiwa
            // $peristiwa = Peristiwa::where('penduduk_id', '=', $model->id)->get(['id']);
            // if ($peristiwa) {
            // Peristiwa::destroy($peristiwa->toArray());
            // }

            // delete file ktp akte
            if (file_exists("{$this->folder_ktp}/{$model->file_ktp}")) {
                $date_time = date('Y-m-d-H-i-s');
                rename("{$this->folder_ktp}/{$model->file_ktp}", "{$this->folder_ktp}/delete/{$date_time}-{$model->file_ktp}");
            }

            if (file_exists("{$this->folder_akte}/{$model->file_akte}")) {
                $date_time = date('Y-m-d-H-i-s');
                rename("{$this->folder_akte}/{$model->file_akte}", "{$this->folder_akte}/delete/{$date_time}-{$model->file_akte}");
            }

            // delete data
            $model->delete();
            DB::commit();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function select2(Request $request)
    {
        try {
            $model = Penduduk::select(['id', DB::raw('nama as text')])
                ->whereRaw("(`nama` like '%$request->search%' or `id` like '%$request->search%')")
                ->limit(10);

            $result = $model->get()->toArray();
            if ($request->with_empty && $request->search) {
                $result = array_merge([['id' => $request->search, 'text' => $request->search . ' (Buat Data Penduduk)']], $result);
            }

            return response()->json(['results' => $result]);
        } catch (\Exception $error) {
            return response()->json($error, 500);
        }
    }
}
