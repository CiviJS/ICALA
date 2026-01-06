<?php

namespace App\Services;
use App\Models\Evento;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class EventosService
{

    public function store(array $request):void {

          $request['fecha_inicio'] = \Carbon\Carbon::parse($request['fecha_inicio']);

        Evento::create($request);    
    }
    public function obtenerEventos():Collection {
    $eventos = Cache::remember('eventos_todo',600, function(){
        return Evento::with('admin')->get();
    });    
    return $eventos;         
    }
    public function actualizarEvento(array $data):void {
        Evento::update($data);
    }
    public function eliminarEvento(string $uuid):void 
    {
       $evento=Evento::findOrFail($uuid);
       $evento->delete();
    }
}
