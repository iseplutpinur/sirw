<?php

namespace App\Models\Kependudukan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'tamu';
    const tableName = 'tamu';
    const image_folder = './assets/kependudukan/tamu';
    const image_default = './assets/kependudukan/tamu/default.png';
}
