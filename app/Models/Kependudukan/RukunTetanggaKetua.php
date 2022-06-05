<?php

namespace App\Models\Kependudukan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RukunTetanggaKetua extends Model
{
    use HasFactory;
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'rukun_tetangga_ketuas';
    const tableName = 'rukun_tetangga_ketuas';
    const image_folder = '/assets/rukun_tetangga_ketuas';
    const image_default = 'assets/image/anggota_default.png';
}
