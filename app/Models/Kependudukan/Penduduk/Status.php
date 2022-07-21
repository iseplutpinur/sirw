<?php

namespace App\Models\Kependudukan\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_status';
    const tableName = 'penduduk_status';
    const image_folder = 'assets/kependudukan/penduduk/status';
    const image_default = 'assets/kependudukan/penduduk/status/default.png';
}
