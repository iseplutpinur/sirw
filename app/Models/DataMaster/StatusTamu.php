<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTamu extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'status_tamus';
    const tableName = 'status_tamus';
    const image_folder = '/assets/status_tamus';
    const image_default = 'assets/image/anggota_default.png';
}
