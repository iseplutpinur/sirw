<?php

namespace App\Http\Controllers\Admin\Kependudukan\Detail;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kependudukan\Penduduk\Transaksi as TransaksiStatus;

class TransaksiController extends Controller
{
    private $repo;
    public function __construct(\App\Repository\Admin\Kependudukan\Detail\TransaksiRepository $repo)
    {
        $this->repo = $repo;
    }

    public function all(Request $req)
    {
        return $this->repo->all($req->penduduk_id);
    }

    public function find(Request $req)
    {
        return $this->repo->find($req->id);
    }

    public function insert(Request $req)
    {
        return $this->repo->insert($req);
    }

    public function update(Request $req)
    {
        return $this->repo->update($req);
    }

    public function delete(TransaksiStatus $model)
    {
        return $this->repo->delete($model);
    }
}
