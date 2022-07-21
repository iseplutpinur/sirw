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
    protected $table = 'rukun_tetangga_ketua';
    const tableName = 'rukun_tetangga_ketua';
    const image_folder = './assets/kependudukan/rukun_tetangga_ketua';
    const image_default = './assets/kependudukan/rukun_tetangga_ketua/default.png';
}
