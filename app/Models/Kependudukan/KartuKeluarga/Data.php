<?php

namespace App\Models\Kependudukan\KartuKeluarga;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'kartu_keluarga_lists';
    const tableName = 'kartu_keluarga_lists';
    const image_folder = './assets/kependudukan/kartu_keluarga/data';
    const image_default = './assets/kependudukan/kartu_keluarga/data/default.png';
}
