<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPenduduk extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'master_status_penduduk';
    const tableName = 'master_status_penduduk';
    const image_folder = '/assets/master/status_penduduk';
    const image_default = '/assets/master/status_penduduk/default.png';
}
