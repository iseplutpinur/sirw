<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTamu extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'master_status_tamu';
    const tableName = 'master_status_tamu';
    const image_folder = '/assets/master/status_tamu';
    const image_default = '/assets/master/status_tamu/default.png';
}
