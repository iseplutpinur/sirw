<?php

namespace App\Models\Kependudukan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'kartu_keluargas';
    const tableName = 'kartu_keluargas';
    const image_folder = '/assets/kartu_keluargas';
    const image_default = 'assets/image/anggota_default.png';
}
