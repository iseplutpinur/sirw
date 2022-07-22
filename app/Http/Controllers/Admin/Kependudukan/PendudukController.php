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
use App\Models\Kependudukan\KartuKeluarga;
use App\Models\Kependudukan\Penduduk;
use App\Models\Kependudukan\Penduduk\Agama as PendudukAgama;
use App\Models\Kependudukan\Penduduk\Akte;
use App\Models\Kependudukan\Penduduk\Ktp;
use App\Models\Kependudukan\Penduduk\Rt;
use App\Models\Kependudukan\Penduduk\Pendidikan as PendudukPendidikan;
use App\Models\Kependudukan\Penduduk\Pekerjaan as PendudukPekerjaan;
use App\Models\Kependudukan\Penduduk\StatusKawin as PendudukStatusKawin;
use App\Models\Kependudukan\Penduduk\Status as PendudukStatus;

class PendudukController extends Controller
{
    private $folder_akte = Akte::image_folder;
    private $folder_ktp = Ktp::image_folder;

    private $validate_model = [
        'nama' => ['required', 'string', 'max:255'],
        'nik' => ['nullable', 'string', 'max:16'],
        'kota_lahir' => ['required', 'string', 'max:255'],
        'jenis_kelamin' => ['required', 'string', 'max:255'],
        'no_hp' => ['nullable', 'string', 'max:255'],
        'alamat_lengkap' => ['required', 'string'],
        'tanggal_lahir' => ['required', 'string', 'max:255'],
        'tanggal_mati' => ['nullable', 'string', 'max:255'],
        'status' => ['required', 'int'],
        'asal_data' => ['required', 'int'],

        // 'penduduk_negara' => ['required', 'int'],
        // 'negara_asal' => ['nullable', 'string', 'max:255'],

        // // data master
        // 'agama_id' => ['required', 'int'],
        // 'pendidikan_id' => ['required', 'int'],
        // 'pekerjaan_id' => ['required', 'int'],
        // 'status_penduduk_id' => ['required', 'int'],
        // 'rt_id' => ['required', 'int'],

        // tanggal
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
        return view('admin.kependudukan.penduduk', compact(
            'page_attr',
            'agamas',
            'pendidikans',
            'pekerjaans',
            'status_kawins',
            'status_penduduks',
            'rts',
            'folder_akte',
            'folder_ktp'
        ));
    }

    private function datatable(Request $request)
    {
        // list table
        $table_penduduk = Penduduk::tableName;

        // data master ============================================================================================
        // rt
        $table_penduduk_rt = Rt::tableName;
        $table_rt = RukunTetangga::tableName;
        $table_penduduk_ktp = Ktp::tableName;
        $table_penduduk_akte = Akte::tableName;
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

        $this->query['tanggal_lahir_str'] = <<<SQL
                (DATE_FORMAT($table_penduduk.tanggal_lahir, '%d-%b-%Y'))
        SQL;
        $this->query['tanggal_lahir_str_alias'] = 'tanggal_lahir_str';

        $this->query['umur'] = <<<SQL
                (SELECT TIMESTAMPDIFF(YEAR, $table_penduduk.tanggal_lahir, CURDATE()))
        SQL;
        $this->query['umur_alias'] = 'umur';

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
            DB::raw("{$this->query['umur']} as {$this->query['umur_alias']}"),
        ]);

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
            ->filterColumn($this->query['umur_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['umur']} like '%$keyword%'");
            })
            ->make(true);
    }

    public function insert(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate($this->validate_model);
            // insert data model penduduk
            $model = new Penduduk();
            $model->nama = $request->nama;
            $model->nik = $request->nik;
            $model->kota_lahir = $request->kota_lahir;
            $model->jenis_kelamin = $request->jenis_kelamin;
            $model->no_hp = $request->no_hp;
            $model->alamat_lengkap = $request->alamat_lengkap;
            $model->tanggal_lahir = $request->tanggal_lahir;
            $model->tanggal_mati = $request->tanggal_mati;

            // 0 Tidak ada di lingkungan rw, 1 ada di lingkungan rw
            $model->status = $request->status;

            // 0 kelahiran, 1 kedatangan
            $model->asal_data = $request->asal_data;

            // get id
            $model->save();

            dd($model);



            // upload foto ktp dan akta
            $foto_ktp = '';
            if ($image = $request->file('file_ktp')) {
                $foto_ktp = $request->nik . AppHelper::slugify($request->nama)  .  '.' .  $image->getClientOriginalExtension();
                $image->move($this->folder_ktp, $foto_ktp);
                $model->file_ktp = $foto_ktp;
                $model->ada_ktp = 1;
            } else {
                $model->ada_ktp = 0;
            }

            $foto_akte = '';
            if ($image = $request->file('file_akte')) {
                $foto_akte = $request->nik . AppHelper::slugify($request->nama)  .  '.' .  $image->getClientOriginalExtension();
                $image->move($this->folder_akte, $foto_akte);
                $model->file_akte = $foto_akte;
                $model->ada_akte = 1;
            } else {
                $model->ada_akte = 0;
            }

            // set peristiwa
            $model->save();
            // Peristiwa::create([
            //     'penduduk_id' => $model->id,
            //     'tanggal' => $request->tanggal_lahir,
            //     'peristiwa' => 1
            // ]);

            // // warga pindahan dari luar
            // if ($request->asal_data == 1) {
            //     Peristiwa::create([
            //         'penduduk_id' => $model->id,
            //         'tanggal' => $request->tanggal_datang,
            //         'peristiwa' => 4
            //     ]);
            // }

            DB::commit();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $model = Penduduk::find($request->id);
            $request->validate(array_merge(['id' => ['required', 'int']], $this->validate_model));

            $model->agama_id = $request->agama_id;
            $model->pendidikan_id = $request->pendidikan_id;
            $model->pekerjaan_id = $request->pekerjaan_id;
            $model->status_kawin_id = $request->status_kawin_id;
            $model->status_penduduk_id = $request->status_penduduk_id;
            $model->rt_id = $request->rt_id;

            $model->status = $request->status;
            $model->penduduk_negara = $request->penduduk_negara;
            $model->negara_asal = $request->negara_asal;

            $model->nik = $request->nik;
            $model->nama = $request->nama;
            $model->kota_lahir = $request->kota_lahir;
            $model->jenis_kelamin = $request->jenis_kelamin;
            $model->alamat_lengkap = $request->alamat_lengkap;
            $model->tanggal_lahir = $request->tanggal_lahir;

            $model->asal_data = $request->asal_data;

            // upload foto ktp dan akta
            if ($image = $request->file('file_ktp')) {
                if (file_exists("{$this->folder_ktp}/{$model->file_ktp}")) {
                    $date_time = date('Y-m-d-H-i-s');
                    rename("{$this->folder_ktp}/{$model->file_ktp}", "{$this->folder_ktp}/delete/{$date_time}-{$model->file_ktp}");
                }

                $foto_ktp = $request->nik . AppHelper::slugify($request->nama) . '.' . $image->getClientOriginalExtension();
                $image->move($this->folder_ktp, $foto_ktp);
                // move file to delete

                $model->file_ktp = $foto_ktp;
                $model->ada_ktp = 1;
            }

            if ($image = $request->file('file_akte')) {
                if (file_exists("{$this->folder_akte}/{$model->file_akte}")) {
                    $date_time = date('Y-m-d-H-i-s');
                    rename("{$this->folder_akte}/{$model->file_akte}", "{$this->folder_akte}/delete/{$date_time}-{$model->file_akte}");
                }

                $foto_akte = $request->nik . AppHelper::slugify($request->nama) . '.' . $image->getClientOriginalExtension();
                $image->move($this->folder_akte, $foto_akte);
                $model->file_akte = $foto_akte;
                $model->ada_akte = 1;
            }

            // update peristiwa
            // Peristiwa::updateOrCreate([
            //     'id' => $request->tanggal_lahir_id,
            //     'penduduk_id' => $model->id,
            //     'tanggal' => $request->tanggal_lahir,
            //     'peristiwa' => 1
            // ]);

            if ($request->asal_data == 1) {
                // Peristiwa::updateOrCreate([
                //     'id' => $request->tanggal_datang_id,
                //     'penduduk_id' => $model->id,
                //     'tanggal' => $request->tanggal_datang,
                //     'peristiwa' => 4
                // ]);
            } else {
                // $asal = Peristiwa::where('penduduk_id', '=', $model->id)
                //     ->where('peristiwa', '=', 4)
                //     ->orderBy('tanggal', 'desc')->get()->first();
                // if ($asal) {
                //     $asal->delete();
                // }
            }

            $model->save();
            DB::commit();
            return response()->json();
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

    public function getById(Penduduk $model)
    {
        try {
            if ($model->asal_data == 1) {
                // tanggal datang
                // $peristiwa = Peristiwa::where('penduduk_id', '=', $model->id)
                //     ->where('peristiwa', '=', 4)
                //     ->orderBy('tanggal', 'desc')->get(['tanggal', 'id'])->first();
                // if ($peristiwa) {
                //     $model->tanggal_datang = $peristiwa->tanggal;
                //     $model->tanggal_datang_id = $peristiwa->id;
                // }
            }

            // tanggal lahir
            // $peristiwa = Peristiwa::where('penduduk_id', '=', $model->id)
            //     ->where('peristiwa', '=', 1)
            //     ->orderBy('tanggal', 'desc')->get(['tanggal', 'id'])->first();
            // if ($peristiwa) {
            //     $model->tanggal_lahir = $peristiwa->tanggal;
            //     $model->tanggal_lahir_id = $peristiwa->id;
            // }

            return response()->json($model);
        } catch (\Exception $error) {
            return response()->json($error, 500);
        }
    }
}
