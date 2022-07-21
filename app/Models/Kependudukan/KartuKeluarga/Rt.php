<?php

namespace App\Models\Kependudukan\KartuKeluarga;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'kartu_keluarga_rt';
    const tableName = 'kartu_keluarga_rt';
    const image_folder = './assets/kependudukan/kartu_keluarga/rt';
    const image_default = './assets/kependudukan/kartu_keluarga/rt/default.png';
}
