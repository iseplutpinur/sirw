<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKawin extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'status_kawins';
    const tableName = 'status_kawins';
    const image_folder = '/assets/status_kawins';
    const image_default = 'assets/image/anggota_default.png';
}
