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
    const image_folder = 'assets/kependudukan/penduduk/profile';
    const image_default = 'assets/kependudukan/penduduk/profile/profile.png';
}
