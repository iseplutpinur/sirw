<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HubunganDenganKK extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'master_hub_dgn_kk';
    const tableName = 'master_hub_dgn_kk';
    const image_folder = '/assets/master/hub_dgn_kk';
    const image_default = '/assets/master/hub_dgn_kk/default.png';
}
