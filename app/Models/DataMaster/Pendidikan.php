<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'pendidikans';
    const tableName = 'pendidikans';
    const image_folder = '/assets/pendidikans';
    const image_default = 'assets/image/anggota_default.png';
}
