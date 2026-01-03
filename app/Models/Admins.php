<?php

namespace App\Models;

use Illuminate\Foundation\Auth\admin as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admins extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token'

    ];

}
