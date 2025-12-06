<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'UUID';  // Aquí le dices que la PK es UUID
    public $incrementing = false;     // Porque UUID no es autoincremental
    protected $keyType = 'string';    // Es un string, no un int
    protected $fillable = ['nombre', 'fechaNacimiento', 'telefono',  'fechaIngreso'];
    protected $appends = ['edad'];
    public $timestamps = false;

    public function planillas()
    {
        return $this->belongsToMany(
            Planilla::class,
            'usuario_planilla',
            'UUIDusuario',
            'UUIDplanilla'
        );
    }

    public function getEdadAttribute()
    {
        return \Carbon\Carbon::parse($this->fechaNacimiento)->age;
    }
    
}
