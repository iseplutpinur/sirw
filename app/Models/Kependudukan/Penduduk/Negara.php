<?php

namespace App\Models\Kependudukan\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_negara';
    const tableName = 'penduduk_negara';
    const image_folder = 'assets/kependudukan/penduduk/negara';
    const image_default = 'assets/kependudukan/penduduk/negara/default.png';
}
