<?php

namespace App\Models\Kependudukan\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_agama';
    const tableName = 'penduduk_agama';
    const image_folder = 'assets/kependudukan/penduduk/agama';
    const image_default = 'assets/kependudukan/penduduk/agama/default.png';
}
