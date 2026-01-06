<?php

namespace App\Models;
use App\Models\Usuario;
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
        'usuarioacargo',
        'tiposervicio',
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
