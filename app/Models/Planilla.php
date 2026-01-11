<?php

namespace App\Models;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class Planilla extends Model
{
    use HasUuids;
    protected $table = 'planilla';
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'fechacreacion',
        'id_admin',
        'tipodeactividad',
    ];

    /**
     * Relación muchos a muchos con Usuario (asistentes)
     * Una planilla puede tener múltiples usuarios asistentes
     */
    public function usuarios()
    {
        return $this->belongsToMany(
            Usuario::class,
            'usuario_planilla',
            'uuidplanilla',
            'uuidusuario'
        );
    }

    /**
     * Relación uno a muchos inversa con Usuario (encargado)
     * Una planilla tiene un usuario encargado
     */
    public function encargado()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id');
    }

    /**
     * Atributo calculado: día de la semana en español
     * Se calcula basado en la fecha de creación
     */
    public function getDiaSemanaAttribute()
    {
        Carbon::setLocale('es');
        return Carbon::parse($this->attributes['fechacreacion'])->translatedFormat('l');
    }
}
