<?php

namespace App\Models\Properti;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahPenghuni extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'rumah_penghunis';
    const tableName = 'rumah_penghunis';
    const image_folder = '/assets/rumah_penghunis';
    const image_default = 'assets/image/anggota_default.png';
}
