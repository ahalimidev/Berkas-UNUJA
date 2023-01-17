<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBerkas extends Model
{
    use HasFactory;
    protected $table = "jenis_berkas";
    protected $primaryKey = "id_jenis_berkas";
    protected $fillable = [
        "id_jenis_berkas",
        "nama_jenis_berkas",
        "status_spmi",
        "create_by",
        "create_date",
        "update_by",
        "update_date",
        "status",
    ];

    public $timestamps = false;
}
