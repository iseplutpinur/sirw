<?php

namespace App\Models\Kependudukan\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HubKk extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_hub_kk';
    const tableName = 'penduduk_hub_kk';
    const image_folder = 'assets/kependudukan/penduduk/hub_kk';
    const image_default = 'assets/kependudukan/penduduk/hub_kk/default.png';
}
