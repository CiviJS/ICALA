<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nombre',
        'fechanacimiento',
        'telefono',
        'fechaingreso'
    ];

    protected $appends = ['edad'];
    public $timestamps = false;

    public function planillas()
    {
        return $this->belongsToMany(
            Planilla::class,
            'usuario_planilla',
            'uuidusuario',
            'uuidplanilla'
        );
    }

    public function getEdadAttribute()
    {
        return \Carbon\Carbon::parse($this->fechanacimiento)->age;
    }
}
