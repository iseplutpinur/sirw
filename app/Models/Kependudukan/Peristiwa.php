<?php

namespace App\Models\Kependudukan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peristiwa extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduks_peristiwa';
    const tableName = 'penduduks_peristiwa';
    const image_folder = './assets/penduduks/penduduks_peristiwa';
    const image_default = 'assets/image/anggota_default.png';
}
