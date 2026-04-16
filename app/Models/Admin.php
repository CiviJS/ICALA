<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use Notifiable;
      protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    
    public function Planilla()
    {
     return $this->hasMany(Planilla::class);

    }
    

}

