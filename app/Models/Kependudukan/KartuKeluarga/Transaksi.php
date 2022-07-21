<?php

namespace App\Models\Kependudukan\KartuKeluarga;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'kartu_keluarga_transaksi';
    const tableName = 'kartu_keluarga_transaksi';
    const image_folder = './assets/kependudukan/kartu_keluarga/transaksi';
    const image_default = './assets/kependudukan/kartu_keluarga/transaksi/default.png';
}
