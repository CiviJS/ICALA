<?php

namespace App\Http\Controllers;

use App\Http\Requests\eventos\EventoRequest;
use App\Services\AdminsService;
use App\Services\EventosService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ControlEventosController extends Controller
{
    public function __construct( protected AdminsService $admService)
    {
       
    }
    public function store(EventosService $service, EventoRequest $request)
    {
        $request->validated();
        $data = $request->all();
        try {
            $service->store($data);
            return redirect('/Eventos')->with('message', 'Evento creado exitosamente.');
        } catch (Exception $e) {
            return redirect('/Eventos')->with('error', 'Ups! algo salio mal' );
        }
    }

    public function index(EventosService $service)
    {
        try {
            $eventos = $service->obtenerEventos();
            $admins = $this->admService->obtenerAdmins();
            return view('eventos/verEventos', compact('eventos','admins'));
        } catch (\Exception) {
            return view('eventos/verEventos')->with('eventos', []);
        }
    }
    public function editar(EventosService $service, $uuid) {
         try {
        $evento = $service->obtenerEvento($uuid);
        $admins = $admins = $this->admService->obtenerAdmins();
        return view('/eventos/editarEventos', compact('evento','admins'));
         } catch (Exception) {
            return redirect('eventos/verEventos')->with('error', 'Ups Algo ocurrio Mal');

         }

    }

    public function actualizarEvento(EventosService $service, EventoRequest $request,$uuid)
    {
        $request->validated();
        $data = $request->all();
        try {
            $service->actualizarEvento($uuid,$data);
            return redirect('/Eventos')->with('message', 'evento actualizado correcta mente');
        } catch (Exception) {
            return  redirect('/Eventos')->with('error', 'ups Ocurrio un error ');
        }
    }

    public function eliminarEvento(EventosService $service, $uuid) 
    {
        try{
            $service->eliminarEvento($uuid);
              return  redirect('/Eventos')->with('message', 'evento eliminado correctamente');
        }catch(ModelNotFoundException){
             return  redirect('/Eventos')->with('error', 'el evento que se desea eliminar ya fue eliminado o no existe');
        }
    }
}
