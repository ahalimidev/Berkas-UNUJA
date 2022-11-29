<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori_berkas extends Model
{
    use HasFactory;
    protected $table = "kategori_berkas";
    protected $primaryKey = "id_kategori_berkas";
    protected $fillable = [
        "id_kategori_berkas",
        "nama_kategori_berkas",
        "create_by",
        "create_date",
        "update_by",
        "update_date",
    ];
    public $timestamps = false;
}
