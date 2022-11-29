<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guard = 'user';
    protected $table = "user";
    protected $primaryKey = "id_user";
    protected $fillable = [
        "id_user",
        "nama",
        "username",
        "password",
        "status",
        "id_lembaga",
        "id_fakultas",
    ];

    public $timestamps = false;
}
