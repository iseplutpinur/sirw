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
                ['name' => 'Kependudukan'],
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

    public function detail(Penduduk $model)
    {
        $penduduk = $model;
        $page_attr = [
            'title' => 'Detail Penduduk',
            'breadcrumbs' => [
                ['name' => 'Dashboard'],
                ['name' => 'Kependudukan', 'url' => 'admin.kependudukan.penduduk'],
            ]
        ];
        $data = compact(
            'page_attr',
            'penduduk',
        );
        return view('admin.kependudukan.penduduk.detail.index', array_merge($data, ['compact' => $data]));
    }

    public function insert(Request $request)
    {
        return $this->repo->insert($request);
    }

    public function delete(Penduduk $model)
    {
        return $this->repo->delete($model);
    }

    public function select2(Request $request)
    {
        return $this->repo->select2($request);
    }
}
