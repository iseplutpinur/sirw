<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPenduduk extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'status_penduduks';
    const tableName = 'status_penduduks';
    const image_folder = '/assets/status_penduduks';
    const image_default = 'assets/image/anggota_default.png';
}
