<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;
    protected $table = "berkas";
    protected $primaryKey = "id_berkas";
    protected $fillable = [
        "id_berkas",
        "id_unit",
        "id_jenis_berkas",
        "nama_berkas",
        "keterangan_berkas",
        "berkas",
        "status_berkas",
        "create_by",
        "create_date",
        "update_by",
        "update_date",
        "status",
    ];

    public $timestamps = false;
}
