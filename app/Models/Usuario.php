<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Usuario extends Model
{
    use HasUuids;
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
