<?php

namespace App\Http\Controllers\Admin\Kependudukan;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\Agama;
use App\Models\DataMaster\Pekerjaan;
use App\Models\DataMaster\Pendidikan;
use App\Models\DataMaster\RukunTetangga;
use App\Models\DataMaster\StatusKawin;
use App\Models\DataMaster\StatusPenduduk;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;
use App\Models\Kependudukan\Penduduk;
use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    private $validate_model = [
        'nama' => ['required', 'string', 'max:255'],
        'nik' => ['required', 'string', 'max:16'],
        'kota_lahir' => ['required', 'string', 'max:255'],
        'jenis_kelamin' => ['required', 'string', 'max:255'],
        'alamat_lengkap' => ['required', 'string'],

        'status' => ['required', 'int'],
        'status_tinggal' => ['required', 'int'],
        'penduduk_negara' => ['required', 'int'],
        'negara_asal' => ['nullable', 'string', 'max:255'],

        // data master
        'agama_id' => ['required', 'int'],
        'pendidikan_id' => ['required', 'int'],
        'pekerjaan_id' => ['required', 'int'],
        'status_kawin_id' => ['required', 'int'],
        'status_penduduk_id' => ['required', 'int'],
        'rt_id' => ['required', 'int'],

        // tanggal
        'tanggal_lahir' => ['required', 'string', 'max:255'],
        'tanggal_mati' => ['nullable', 'string', 'max:255'],
        'tanggal_pindah' => ['nullable', 'string', 'max:255'],
        'tanggal_datang' => ['nullable', 'string', 'max:255'],
    ];

    public function index(Request $request)
    {
        if (request()->ajax()) {
            // get key from validate
            $select = [];
            foreach ($this->validate_model as $k => $val) $select[] = $k;

            // get data from model
            $model = Penduduk::select(array_merge(['id'], $select))
                ->selectRaw("IF(status = 1, 'Dipakai', 'Tidak Dipakai') as status_str");

            // filter
            if (isset($request->filter)) {
                $filter = $request->filter;
                if ($filter['status'] != '') {
                    $model->where('status', '=', $filter['status']);
                }
            }

            return Datatables::of($model)
                ->addIndexColumn()
                ->make(true);
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

        return view('admin.kependudukan.penduduk', compact(
            'page_attr',
            'agamas',
            'pendidikans',
            'pekerjaans',
            'status_kawins',
            'status_penduduks',
            'rts',
        ));
    }

    public function insert(Request $request)
    {
        try {
            $request->validate($this->validate_model);

            $model = new Penduduk();
            $model->nama = $request->nama;
            $model->singkatan = $request->singkatan;
            $model->keterangan = $request->keterangan;
            $model->status = $request->status;
            $model->save();
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
            $model = Penduduk::find($request->id);
            $request->validate(array_merge(['id' => ['required', 'int']], $this->validate_model));

            $model->nama = $request->nama;
            $model->singkatan = $request->singkatan;
            $model->keterangan = $request->keterangan;
            $model->status = $request->status;
            $model->save();
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
            $model->delete();
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
