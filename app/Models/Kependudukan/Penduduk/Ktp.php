<?php

namespace App\Models\Kependudukan\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ktp extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_ktp';
    const tableName = 'penduduk_ktp';
    const image_folder = 'assets/kependudukan/penduduk/ktp';
    const image_default = 'assets/kependudukan/penduduk/ktp/default.png';
}
