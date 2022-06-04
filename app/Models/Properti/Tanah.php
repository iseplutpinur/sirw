<?php

namespace App\Models\Properti;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanah extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'tanahs';
    const tableName = 'tanahs';
    const image_folder = '/assets/tanahs';
    const image_default = 'assets/image/anggota_default.png';
}
