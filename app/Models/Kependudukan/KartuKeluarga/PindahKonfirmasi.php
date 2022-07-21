<?php

namespace App\Models\Kependudukan\KartuKeluarga;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PindahKonfirmasi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'kartu_keluarga_pindah_konfirmasi';
    const tableName = 'kartu_keluarga_pindah_konfirmasi';
    const image_folder = './assets/kependudukan/kartu_keluarga/pindah_konfirmasi';
    const image_default = './assets/kependudukan/kartu_keluarga/pindah_konfirmasi/default.png';
}
