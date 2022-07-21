<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'master_pendidikan';
    const tableName = 'master_pendidikan';
    const image_folder = '/assets/master/pendidikan';
    const image_default = '/assets/master/pendidikan/default.png';
}
