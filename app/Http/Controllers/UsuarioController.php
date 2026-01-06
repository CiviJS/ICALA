<?php

namespace App\Http\Controllers;

use App\Http\Requests\usuario\BuscarUsuarioRequest;
use App\Http\Requests\usuario\storeUsuarioRequest;
use Exception;
use App\Services\UsuarioService;
use App\Http\Requests\usuario\UpdateUsuarioRequest;



class UsuarioController extends Controller
{
    
    public function store(storeUsuarioRequest $request, UsuarioService $service)
    {   
        $request->validated();
        $data = $request->all();
        try{
            $service->store($data);
            return redirect('/')->with('message', 'Usuario creado exitosamente.');
        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect('/')->with('error','Algo salio mal');
        }
    }
    public function crear(){
        return view('usuario/crearUsuario');
    }

    public function editar($uuid,UsuarioService $service){
        try{
            $usuario = $service->buscarUUID($uuid);
        if(isset($usuario)){
            return view('usuario/editarUsuario', compact('usuario'));
        }
            return redirect('/')->with('error','Usuario No Existe');
        }catch(\Exception $e){
            return redirect('/')->with('error','Ups! Algo salio mal');
        }
    }

   public function update(UpdateUsuarioRequest $request, $uuid, UsuarioService $service){
        try{
        $data = $request->validated();
        $service->update($uuid,$data);
            return redirect('/Usuario/editar/'.$uuid)->with('message', 'Usuario actualizado exitosamente.');
        }catch(Exception){
            return redirect('/')->with('error','Ups! Algo salio mal');

        }
    }
    public function buscar(BuscarUsuarioRequest $request, UsuarioService $service){
        try{
            $data = $request -> validated();
            $campo = $data['campo'];
            $usuarios = $service->buscarPorCampo($campo);
            return view('home')->with( compact('usuarios')); 
        }catch(Exception){
            return redirect('')->with('error','Ups! Algo salio mal.');
        }
    }

    public function eliminar($uuid , UsuarioService $service){
        try{
        $service->eliminarUUID($uuid);
         return redirect('/')->with('message', 'Usuario eliminado exitosamente.');
        }catch(Exception){
            return redirect('/')->with('error','Ups! Algo salio mal');
        }
       
    }

}
