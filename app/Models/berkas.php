<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class berkas extends Model
{
    use HasFactory;
    protected $table = "berkas";
    protected $primaryKey = "id_berkas";
    protected $fillable = [
        "id_berkas",
        "id_kategori_berkas",
        "id_sub_berkas",
        "id_lembaga",
        "id_fakultas",
        "id_prodi",
        "nama_berkas",
        "keterangan_berkas",
        "berkas",
        "status_berkas"
    ];
    public $timestamps = false;
}
