<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HubunganDenganKK extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'hubungan_dengan_k_k_s';
    const tableName = 'hubungan_dengan_k_k_s';
    const image_folder = '/assets/hubungan_dengan_k_k_s';
    const image_default = 'assets/image/anggota_default.png';
}
