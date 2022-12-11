<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;
    protected $table = "master_fakultas";
    protected $primaryKey = "id_fakultas";
    protected $fillable = [
        "id_fakultas",
        "nama_fakultas",
        "singkatan_fakultas",
    ];

    public $timestamps = false;
}
