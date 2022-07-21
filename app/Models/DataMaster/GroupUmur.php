<?php

namespace App\Models\DataMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUmur extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'master_group_umur';
    const tableName = 'master_group_umur';
    const image_folder = '/assets/master/group_umur';
    const image_default = '/assets/master/group_umur/default.png';
}
