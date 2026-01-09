<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Modelo Usuario
 *
 * Representa a un integrante de la iglesia ICALA.
 * Gestiona información personal y relaciones con planillas de asistencia.
 */
class Usuario extends Model
{
    use HasUuids;

    protected $table = 'usuario';
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Campos que pueden ser asignados masivamente
     */
    protected $fillable = [
        'nombre',
        'fechanacimiento',
        'telefono',
        'fechaingreso'
    ];

    /**
     * Atributos calculados que se incluyen en el array/JSON
     */
    protected $appends = ['edad'];

    /**
     * Indica que el modelo no usa timestamps automáticos
     */
    public $timestamps = false;

    /**
     * Relación muchos a muchos con Planilla
     * Un usuario puede asistir a múltiples planillas
     */
    public function planillas()
    {
        return $this->belongsToMany(
            Planilla::class,
            'usuario_planilla',
            'uuidusuario',
            'uuidplanilla'
        );
    }

    /**
     * Atributo calculado: edad del usuario
     * Se calcula basado en la fecha de nacimiento
     */
    public function getEdadAttribute()
    {
        return \Carbon\Carbon::parse($this->fechanacimiento)->age;
    }
}
