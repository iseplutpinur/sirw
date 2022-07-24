<?php

namespace App\Models\Kependudukan\KartuKeluarga;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'kartu_keluarga_negara';
    const tableName = 'kartu_keluarga_negara';
    const image_folder = 'assets/kependudukan/kartu_keluarga/negara';
    const image_default = 'assets/kependudukan/kartu_keluarga/negara/default.png';
}
