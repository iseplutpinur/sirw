<?php

namespace App\Http\Controllers\API\Admin\DataMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;
use App\Models\DataMaster\RukunTetangga;
use Illuminate\Support\Facades\DB;

class RukunTetanggaController extends Controller
{
    private $validate_model = [
        'nama' => ['required', 'string', 'max:255'],
        'nomor' => ['required', 'int'],
        'telepon' => ['nullable', 'string', 'max:255'],
        'whatsapp' => ['nullable', 'string', 'max:255'],
    ];

    public function index(Request $request)
    {
        if (request()->ajax()) {
            // get key from validate
            $select = [];
            foreach ($this->validate_model as $k => $val) $select[] = $k;

            // get data from model
            $model = RukunTetangga::select(array_merge(['id'], $select));

            return Datatables::of($model)
                ->addIndexColumn()
                ->make(true);
        }
        $page_attr = [
            'title' => 'Manage List Rukun Tetangga',
            'breadcrumbs' => [
                ['name' => 'Dashboard'],
                ['name' => 'Data Master'],
            ]
        ];
        return view('admin.data_master.rukun_tetangga', compact('page_attr'));
    }

    public function insert(Request $request)
    {
        try {
            $request->validate($this->validate_model);

            $model = new RukunTetangga();
            $model->nama = $request->nama;
            $model->nomor = $request->nomor;
            $model->telepon = $request->telepon;
            $model->whatsapp = $request->whatsapp;
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
            $model = RukunTetangga::find($request->id);
            $request->validate(array_merge(['id' => ['required', 'int']], $this->validate_model));

            $model->nama = $request->nama;
            $model->nomor = $request->nomor;
            $model->telepon = $request->telepon;
            $model->whatsapp = $request->whatsapp;
            $model->save();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function delete(RukunTetangga $model)
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
            $model = RukunTetangga::select(['id', DB::raw('nama as text')])
                ->whereRaw("(`nama` like '%$request->search%' or `id` like '%$request->search%')")
                ->limit(10);

            $result = $model->get()->toArray();
            if ($request->with_empty && $request->search) {
                $result = array_merge([['id' => $request->search, 'text' => $request->search . ' (Buat Data RukunTetangga)']], $result);
            }

            return response()->json(['results' => $result]);
        } catch (\Exception $error) {
            return response()->json($error, 500);
        }
    }
}
