<?php

namespace App\Models\Kependudukan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RukunTetangga extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'rukun_tetanggas';
    const tableName = 'rukun_tetanggas';
    const image_folder = '/assets/rukun_tetanggas';
    const image_default = 'assets/image/anggota_default.png';
}
