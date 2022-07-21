<?php

namespace App\Models\Kependudukan\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_pendidikan';
    const tableName = 'penduduk_pendidikan';
    const image_folder = 'assets/kependudukan/penduduk/pendidikan';
    const image_default = 'assets/kependudukan/penduduk/pendidikan/default.png';
}
