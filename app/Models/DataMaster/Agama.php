<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'master_agama';
    const tableName = 'master_agama';
    const image_folder = '/assets/master/agama';
    const image_default = '/assets/master/agama/default.png';
}
