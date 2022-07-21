<?php

namespace App\Models\Import;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelPendudukList extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'excel_penduduk_lists';
    const tableName = 'excel_penduduk_lists';
    const folder = 'assets/excel';
}
