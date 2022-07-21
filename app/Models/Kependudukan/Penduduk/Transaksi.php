<?php

namespace App\Models\Kependudukan\Penduduk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'penduduk_transaksi';
    const tableName = 'penduduk_transaksi';
    const image_folder = 'assets/kependudukan/penduduk/transaksi';
    const image_default = 'assets/kependudukan/penduduk/transaksi/default.png';
}
