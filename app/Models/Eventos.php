<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Admin;

class Eventos extends Model
{   
    use HasUuids;
    protected $primaryKey = 'uuid'; 
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'descripcion',
        'admin_encargado'
    ];

    public function admins(): BelongsTo
    {
        return $this->BelongsTo(Admin::class,'admin_encargado','id');
    }






}
