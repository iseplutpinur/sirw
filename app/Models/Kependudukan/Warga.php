<?php

namespace App\Models\Kependudukan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'wargas';
    const tableName = 'wargas';
    const image_folder = '/assets/wargas';
    const image_default = 'assets/image/anggota_default.png';
}
