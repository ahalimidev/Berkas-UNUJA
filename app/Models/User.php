<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "user";
    protected $primaryKey = "id_user";
    protected $fillable = [
        "id_user",
        "id_unit",
        "nama",
        "username",
        "password",
        "create_by",
        "create_date",
        "update_by",
        "update_date",
        "status",
    ];

    public $timestamps = false;
}
