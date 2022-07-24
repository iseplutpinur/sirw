<?php

namespace App\Http\Controllers\Admin\Kependudukan;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;

use App\Models\DataMaster\Agama;
use App\Models\DataMaster\Pekerjaan;
use App\Models\DataMaster\Pendidikan;
use App\Models\DataMaster\StatusKawin;
use App\Models\DataMaster\StatusPenduduk;
use App\Models\DataMaster\RukunTetangga;
use App\Models\Kependudukan\Penduduk;
use App\Models\Kependudukan\Penduduk\Akte as PendudukAkte;
use App\Models\Kependudukan\Penduduk\Ktp as PendudukKtp;

use App\Repository\Admin\Kependudukan\PendudukRepository;

class PendudukController extends Controller
{
    private $repo;
    private $folder_akte = PendudukAkte::image_folder;
    private $folder_ktp = PendudukKtp::image_folder;

    public function __construct(PendudukRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->repo->datatable($request);
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
        return view('admin.kependudukan.penduduk.index', array_merge($data, ['compact' => $data]));
    }

    public function insert(Request $request)
    {
        return $this->repo->insert($request);
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
