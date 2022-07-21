<?php

namespace App\Models\Kependudukan\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_pekerjaan';
    const tableName = 'penduduk_pekerjaan';
    const image_folder = 'assets/kependudukan/penduduk/pekerjaan';
    const image_default = 'assets/kependudukan/penduduk/pekerjaan/default.png';
}
