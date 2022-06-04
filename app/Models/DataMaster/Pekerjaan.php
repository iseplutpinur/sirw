<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'pekerjaans';
    const tableName = 'pekerjaans';
    const image_folder = '/assets/pekerjaans';
    const image_default = 'assets/image/anggota_default.png';
}
