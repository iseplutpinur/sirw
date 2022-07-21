<?php

namespace App\Models\Kependudukan\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_rt';
    const tableName = 'penduduk_rt';
    const image_folder = 'assets/kependudukan/penduduk/rt';
    const image_default = 'assets/kependudukan/penduduk/rt/default.png';
}
