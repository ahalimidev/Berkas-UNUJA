<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $table = "master_prodi";
    protected $primaryKey = "prodi_id";
    protected $fillable = [
        "prodi_id",
        "id_fakultas",
        "program_studi",
        "singkatan",
    ];

    public $timestamps = false;
}
