<?php

namespace App\Models\Kependudukan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduks';
    const tableName = 'penduduks';
    const image_folder = './assets/penduduk/data';
    const image_default = './assets/penduduk/data/default.png';
}
