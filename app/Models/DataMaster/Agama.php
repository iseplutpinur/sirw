<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'agamas';
    const tableName = 'agamas';
    const image_folder = '/assets/agamas';
    const image_default = 'assets/image/anggota_default.png';
}
