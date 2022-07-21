<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'master_pekerjaan';
    const tableName = 'master_pekerjaan';
    const image_folder = '/assets/master/pekerjaan';
    const image_default = '/assets/master/pekerjaan/default.png';
}
