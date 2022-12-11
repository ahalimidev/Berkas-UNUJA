<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    use HasFactory;
    protected $table = "struktur";
    protected $primaryKey = "id_struktur";
    protected $fillable = [
        "id_struktur",
        "nama_struktur",
    ];

    public $timestamps = false;
}
