<?php

namespace App\Http\Controllers\API\Admin\Kependudukan;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Repository\Admin\Kependudukan\KartuKeluargaRepository;

class KartuKeluargaController extends Controller
{
    private $repo;
    public function __construct(KartuKeluargaRepository $repo)
    {
        $this->repo = $repo;
    }

    public function insert(Request $request)
    {
        return $this->repo->insert($request);
    }

    public function datatable(Request $request)
    {
        return $this->repo->datatable($request);
    }
}
