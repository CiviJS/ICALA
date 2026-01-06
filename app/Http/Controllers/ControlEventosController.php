<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Http\Requests\eventos\EventoRequest;
use App\Services\AdminsService;
use App\Services\EventosService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ControlEventosController extends Controller
{

    public function store(EventosService $service, EventoRequest $request)
    {
        $request->validated();
        $data = $request->all();
        try {
            $service->store($data);
            return redirect('/Eventos')->with('message', 'Evento creado exitosamente.');
        } catch (Exception) {
            return redirect('/Eventos')->with('error', 'Ups! algo salio mal');
        }
    }

    public function index(EventosService $service,AdminsService $admService)
    {
        try {
            $eventos = $service->obtenerEventos();
            $admins = $admService->obtenerAdmins();
            return view('eventos/verEventos', compact('eventos','admins'));
        } catch (\Exception) {
            return view('eventos/verEventos')->with('eventos', []);
        }
    }

    public function actualizarEvento(EventosService $service, EventoRequest $request)
    {
        $request->validated();
        $data = $request->all();
        try {
            $service->actualizarEvento($data);
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
=======
use Illuminate\Http\Request;

class ControlEventosController extends Controller
{
    public function index()
    {
        return view('eventos/verEventos');

    }

    public function crear()
    {
        return view('eventos/crearEvento');

>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
    }
}
