<?php

namespace App\Repository\Admin\Kependudukan\Detail;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\RukunTetangga as DataMasterRt;
use App\Models\Kependudukan\Penduduk;
use Illuminate\Http\Request;

use App\Models\Kependudukan\Penduduk\Transaksi as PendudukTransaksi;
use Exception;
use Illuminate\Support\Facades\DB;
use League\Config\Exception\ValidationException;

class TransaksiRepository extends Controller
{
    private $validate_model = [
        'penduduk_id' => ['required', 'int'],
        'rt_id' => ['nullable', 'int'],
        'keterangan' => ['nullable', 'string'],
        'tanggal' => ['required', 'date'],
        'jenis' => ['required', 'int'],
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

            // check apakah ada nilai tanggal yang sama
            $check = PendudukTransaksi::where('penduduk_id', '=', $req->penduduk_id)
                ->where('tanggal', '=', $req->tanggal)->count();

            if ($check) throw new Exception("Tanggal tanggal sudah digunakan");

            $model = new PendudukTransaksi();
            $model->penduduk_id = $req->penduduk_id;
            $model->tanggal = $req->tanggal;
            $model->keterangan = $req->keterangan;
            $model->jenis = $req->jenis;
            $model->rt_id = $req->rt_id;
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

            $model = PendudukTransaksi::find($req->id);
            $model->penduduk_id = $req->penduduk_id;
            $model->tanggal = $req->tanggal;
            $model->keterangan = $req->keterangan;
            $model->jenis = $req->jenis;
            $model->rt_id = $req->rt_id;
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

    public function delete(PendudukTransaksi $model)
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
        $tp_model = PendudukTransaksi::tableName;
        $t_model = DataMasterRt::tableName;
        $t_penduduk = Penduduk::tableName;

        $ag_fun = function (string $select, string $alias, $format) use ($tp_model): array {
            $str = <<<SQL
                (DATE_FORMAT($tp_model.$select, '$format'))
            SQL;
            return [$alias => $str, ($alias . '_alias') => $alias];
        };

        $c_tanggal_str = 'tanggal_str';
        $c_tanggal_full_str = 'tanggal_full_str';
        $this->query = array_merge($this->query, $ag_fun('tanggal', $c_tanggal_str, '%d-%b-%Y'));
        $this->query = array_merge($this->query, $ag_fun('tanggal', $c_tanggal_full_str, '%W, %d %M %Y %H:%i:%s'));

        $c_created_str = 'created_str';
        $c_created_full_str = 'created_full_str';
        $this->query = array_merge($this->query, $ag_fun('created_at', $c_created_str, '%d-%b-%Y'));
        $this->query = array_merge($this->query, $ag_fun('created_at', $c_created_full_str, '%W, %d %M %Y %H:%i:%s'));

        $c_updated_str = 'updated_str';
        $c_updated_full_str = 'updated_full_str';
        $this->query = array_merge($this->query, $ag_fun('updated_at', $c_updated_str, '%d-%b-%Y'));
        $this->query = array_merge($this->query, $ag_fun('updated_at', $c_updated_full_str, '%W, %d %M %Y %H:%i:%s'));

        $c_jenis_str = 'jenis_str';
        $this->query[$c_jenis_str] = <<<SQL
            (if($tp_model.jenis = 1, 'Pindah', if($tp_model.jenis = 2, 'Datang', 'Tidak Diketahui')) )
        SQL;
        $this->query["{$c_jenis_str}_alias"] = $c_jenis_str;

        // ========================================================================================================
        // select raw as alias
        $sraa = function (string $col): string {
            return $this->query[$col] . ' as ' . $this->query[$col . '_alias'];
        };

        $model_filter = [
            $c_tanggal_str,
            $c_tanggal_full_str,
            $c_created_str,
            $c_created_full_str,
            $c_updated_str,
            $c_updated_full_str,
        ];

        $to_db_raw = array_map(function ($a) use ($sraa) {
            return DB::raw($sraa($a));
        }, $model_filter);

        $model = PendudukTransaksi::select(array_merge([
            "$tp_model.id",
            "$tp_model.penduduk_id",
            "$tp_model.rt_id",
            "$tp_model.keterangan",
            "$tp_model.tanggal",
            "$tp_model.jenis",
            "$tp_model.created_at",
            "$tp_model.updated_at",
            DB::raw("$t_model.nomor as model"),
            DB::raw("$t_model.nama as model_full"),
            DB::raw("$t_penduduk.nik as penduduk_nik"),
            DB::raw("$t_penduduk.nama as penduduk"),
        ], $to_db_raw))
            ->leftJoin($t_model, "$t_model.id", "=", "$tp_model.rt_id")
            ->leftJoin($t_penduduk, "$t_penduduk.id", "=", "$tp_model.penduduk_id")
            ->orderBy("$tp_model.tanggal", 'desc');

        foreach ($filter as $f) {
            $model->where("$tp_model.{$f[0]}", $f[1], $f[2]);
        }

        return $result ? $model->get() : $model->first();
    }
}
