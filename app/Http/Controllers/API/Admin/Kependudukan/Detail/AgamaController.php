<?php

namespace App\Http\Controllers\API\Admin\Kependudukan\Detail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kependudukan\Penduduk\Agama as PendudukAgama;

class AgamaController extends Controller
{
    private $repo;
    public function __construct(\App\Repository\Admin\Kependudukan\Detail\AgamaRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $req)
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

    public function delete(PendudukAgama $model)
    {
        return $this->repo->delete($model);
    }

    public function refresh(Request $req)
    {
        return $this->repo->refresh($req->penduduk_id);
    }
}
