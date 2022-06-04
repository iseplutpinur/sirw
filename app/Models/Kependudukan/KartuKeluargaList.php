<?php

namespace App\Models\Kependudukan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKeluargaList extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'kartu_keluarga_lists';
    const tableName = 'kartu_keluarga_lists';
    const image_folder = '/assets/kartu_keluarga_lists';
    const image_default = 'assets/image/anggota_default.png';
}
