<?php

namespace App\Models;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class Planilla extends Model
{
    protected $table = 'planilla';
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'uuid',
        'fechacreacion',
        'usuarioacargo',
        'tipodeactividad',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(
            Usuario::class,
            'usuario_planilla',
            'uuidplanilla',
            'uuidusuario'
        );
    }

    public function encargado()
    {
        return $this->belongsTo(Usuario::class, 'usuarioacargo', 'uuid');
    }

    public function getDiaSemanaAttribute()
    {
        Carbon::setLocale('es');
        return Carbon::parse($this->attributes['fechacreacion'])->translatedFormat('l');
    }
}
