<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKawin extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'master_status_kawin';
    const tableName = 'master_status_kawin';
    const image_folder = '/assets/master/status_kawin';
    const image_default = '/assets/master/status_kawin/default.png';
}
