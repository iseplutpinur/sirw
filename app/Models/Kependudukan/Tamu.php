<?php

namespace App\Models\Kependudukan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'tamus';
    const tableName = 'tamus';
    const image_folder = '/assets/tamus';
    const image_default = 'assets/image/anggota_default.png';
}
