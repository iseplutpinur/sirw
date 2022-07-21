<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RukunTetangga extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'master_rukun_tetangga';
    const tableName = 'master_rukun_tetangga';
    const image_folder = '/assets/master/rukun_tetangga';
    const image_default = '/assets/master/rukun_tetangga/default.png';
}
