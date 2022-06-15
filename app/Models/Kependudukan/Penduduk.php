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
    const image_folder_ktp = '/assets/penduduks/ktp';
    const image_folder_akte = '/assets/penduduks/akte';
    const image_default = 'assets/image/anggota_default.png';
}
