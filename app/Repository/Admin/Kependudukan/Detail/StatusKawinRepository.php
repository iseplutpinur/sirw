<?php

namespace App\Repository\Admin\Kependudukan\Detail;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\StatusKawin as DataMasterStatusKawin;
use App\Models\Kependudukan\Penduduk;
use Illuminate\Http\Request;


use App\Models\Kependudukan\Penduduk\StatusKawin as PendudukStatusKawin;
use Exception;
use Illuminate\Support\Facades\DB;
use League\Config\Exception\ValidationException;

class StatusKawinRepository extends Controller
{
    private $validate_model = [
        'penduduk_id' => ['required', 'int'],
        'dari' => ['required', 'date'],
        'sampai' => ['nullable', 'date'],
        'status_kawin_id' => ['required', 'int'],
        'ganti_baru' => ['nullable', 'int'],
    ];
    private $query = [];
    public function all(?int $penduduk_id)
    {
        if (is_null($penduduk_id)) return response()->json(null, 404);
        $result = $this->q([['penduduk_id', '=', $penduduk_id]]);
        $code = $result ? 200 : 404;
        return response()->json($result, $code);
    }

    public function find(?int $id)
    {
        if (is_null($id)) return response()->json(null, 404);
        $result = $this->q([['id', '=', $id]], false);
        $code = $result ? 200 : 404;
        return response()->json($result, $code);
    }

    public function insert(Request $req)
    {
        try {
            DB::beginTransaction();
            $req->validate($this->validate_model);

            // check apakah ada nilai dari yang sama
            $check = PendudukStatusKawin::where('penduduk_id', '=', $req->penduduk_id)
                ->where('dari', '=', $req->dari)->count();

            if ($check) throw new Exception("Tanggal dari sudah digunakan");
            $model = new PendudukStatusKawin();
            $model->penduduk_id = $req->penduduk_id;
            $model->dari = $req->dari;
            $model->sampai = $req->sampai;
            $model->status_kawin_id = $req->status_kawin_id;
            $model->save();

            DB::commit();
            return response()->json([
                'data' => $this->q([['id', '=', $model->id]]),
            ], 200);
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function update(Request $req)
    {
        try {
            DB::beginTransaction();
            $req->validate(array_merge([
                'id' => ['required', 'int'],
            ], $this->validate_model));

            $model = PendudukStatusKawin::find($req->id);
            $model->penduduk_id = $req->penduduk_id;
            $model->dari = $req->dari;
            $model->sampai = $req->sampai;
            $model->status_kawin_id = $req->status_kawin_id;
            $model->save();
            DB::commit();
            return response()->json([
                'data' => $this->q([['id', '=', $model->id]]),
            ], 200);
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function delete(PendudukStatusKawin $model)
    {
        try {
            DB::beginTransaction();
            $model->delete();
            DB::commit();
            return response()->json(true, 200);
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }


    private function q(?array $filter = [], bool $result = true)
    {
        // table penduduk
        $tp_model = PendudukStatusKawin::tableName;
        $t_model = DataMasterStatusKawin::tableName;
        $t_penduduk = Penduduk::tableName;

        $ag_fun = function (string $select, string $alias, $format) use ($tp_model): array {
            $str = <<<SQL
                (DATE_FORMAT($tp_model.$select, '$format'))
            SQL;
            return [$alias => $str, ($alias . '_alias') => $alias];
        };

        $c_dari_str = 'dari_str';
        $c_dari_full_str = 'dari_full_str';
        $this->query = array_merge($this->query, $ag_fun('dari', $c_dari_str, '%d-%b-%Y'));
        $this->query = array_merge($this->query, $ag_fun('dari', $c_dari_full_str, '%W, %d %M %Y'));

        $c_sampai_str = 'sampai_str';
        $c_sampai_full_str = 'sampai_full_str';
        $this->query = array_merge($this->query, $ag_fun('sampai', $c_sampai_str, '%d-%b-%Y'));
        $this->query = array_merge($this->query, $ag_fun('sampai', $c_sampai_full_str, '%W, %d %M %Y'));

        $c_created_str = 'created_str';
        $c_created_full_str = 'created_full_str';
        $this->query = array_merge($this->query, $ag_fun('created_at', $c_created_str, '%d-%b-%Y'));
        $this->query = array_merge($this->query, $ag_fun('created_at', $c_created_full_str, '%W, %d %M %Y %H:%i:%s'));

        $c_updated_str = 'updated_str';
        $c_updated_full_str = 'updated_full_str';
        $this->query = array_merge($this->query, $ag_fun('updated_at', $c_updated_str, '%d-%b-%Y'));
        $this->query = array_merge($this->query, $ag_fun('updated_at', $c_updated_full_str, '%W, %d %M %Y %H:%i:%s'));

        // ========================================================================================================
        // select raw as alias
        $sraa = function (string $col): string {
            return $this->query[$col] . ' as ' . $this->query[$col . '_alias'];
        };

        $model_filter = [
            $c_dari_str,
            $c_dari_full_str,
            $c_sampai_str,
            $c_sampai_full_str,
            $c_created_str,
            $c_created_full_str,
            $c_updated_str,
            $c_updated_full_str,
        ];

        $to_db_raw = array_map(function ($a) use ($sraa) {
            return DB::raw($sraa($a));
        }, $model_filter);

        $model = PendudukStatusKawin::select(array_merge([
            "$tp_model.id",
            "$tp_model.penduduk_id",
            "$tp_model.status_kawin_id",
            "$tp_model.dari",
            "$tp_model.sampai",
            "$tp_model.created_at",
            "$tp_model.updated_at",
            DB::raw("$t_model.singkatan as model"),
            DB::raw("$t_model.nama as model_full"),
            DB::raw("$t_penduduk.nik as penduduk_nik"),
            DB::raw("$t_penduduk.nama as penduduk"),
        ], $to_db_raw))
            ->leftJoin($t_model, "$t_model.id", "=", "$tp_model.status_kawin_id")
            ->leftJoin($t_penduduk, "$t_penduduk.id", "=", "$tp_model.penduduk_id")
            ->orderBy("$tp_model.dari", 'desc');

        foreach ($filter as $f) {
            $model->where("$tp_model.{$f[0]}", $f[1], $f[2]);
        }

        return $result ? $model->get() : $model->first();
    }

    public function refresh(?int $penduduk_id)
    {
        if (is_null($penduduk_id)) return response()->json(null, 404);
        // $result = $this->q([['penduduk_id', '=', $penduduk_id]]);
        // $code = $result ? 200 : 404;


        // check jika cuman 1 berarti sampai nya null
        $rows = PendudukStatusKawin::where('penduduk_id', '=', $penduduk_id)->orderBy('dari')->get();
        if ($rows->count() < 1) return response()->json(null, 404);
        // jika cuman ada satu
        if ($rows->count() == 1) {
            $rows[0]->sampai = null;
            $rows[0]->save();
            return response()->json(null, 200);
        }
        foreach ($rows as $k => $row) {
            if (isset($rows[$k + 1])) {
                $next = $rows[$k + 1];
                $tanggal = date('Y-m-d', strtotime($next->dari . ' - 1 day'));
                $row->sampai = $tanggal;
                $row->save();
            } else {
                $row->sampai = null;
                $row->save();
            }
        }

        return response()->json();
    }
}
