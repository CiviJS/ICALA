<?php

namespace App\Models;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    protected $table = 'planilla';
    
    public $timestamps = false;
    protected $primaryKey = 'uuid';  // <- le dices que la PK es UUID
    public $incrementing = false;    // <- no es autoincremental
    protected $keyType = 'string';   // <- tipo de la llave es string
    protected $fillable = ['uuid','FechaCreacion','UsuarioAcargo','TipoDeActividad'];

    public function usuarios()
    {
        return $this->belongsToMany(
            Usuario::class,
            'usuario_planilla',
            'UUIDplanilla',    // FK local en pivote
            'UUIDusuario'      // FK del otro modelo
        );
    }
   public function encargado()
    {
        return $this->belongsTo(Usuario::class, 'UsuarioAcargo', 'UUID');
    }



    public function getDiaSemanaAttribute(){
        Carbon::setLocale('es');
        return carbon::parse($this->attributes['FechaCreacion'])->translatedFormat('l');
    }
    
    

}
