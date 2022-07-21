<?php

namespace App\Models\Kependudukan\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKawin extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_status_kawin';
    const tableName = 'penduduk_status_kawin';
    const image_folder = 'assets/kependudukan/penduduk/status_kawin';
    const image_default = 'assets/kependudukan/penduduk/status_kawin/default.png';
}
