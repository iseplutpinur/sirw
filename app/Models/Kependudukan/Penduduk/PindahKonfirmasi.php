<?php

namespace App\Models\Kependudukan\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PindahKonfirmasi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_pindah_konfirmasi';
    const tableName = 'penduduk_pindah_konfirmasi';
    const image_folder = 'assets/kependudukan/penduduk/pindah_konfirmasi';
    const image_default = 'assets/kependudukan/penduduk/pindah_konfirmasi/default.png';
}
