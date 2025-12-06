<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usuario_planilla extends Model
{
    protected $table = 'usuario_planilla';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [' UUIDplanilla',' UUIDusuario'];
}
