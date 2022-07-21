<?php

namespace App\Models\Kependudukan\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akte extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_akte';
    const tableName = 'penduduk_akte';
    const image_folder = 'assets/kependudukan/penduduk/akte';
    const image_default = 'assets/kependudukan/penduduk/akte/default.png';
}
