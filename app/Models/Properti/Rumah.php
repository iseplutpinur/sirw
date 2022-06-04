<?php

namespace App\Models\Properti;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'rumahs';
    const tableName = 'rumahs';
    const image_folder = '/assets/rumahs';
    const image_default = 'assets/image/anggota_default.png';
}
