<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use App\Services\ReportesService;
<<<<<<< HEAD
use App\Services\EventosService;
=======
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
<<<<<<< HEAD
    public function index(EventosService $service)
    {
        $eventos = $service->obtenerEventos();
        return view('home/homeUsuarios', compact('eventos'));
=======
    public function index()
    {
        return view('home/homeUsuarios');
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
    }
    public function login()
    {
        return view('auth/login');
<<<<<<< HEAD

=======
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
    }

    public function admin(ReportesService $service)
    {
        $usuarios = $service->usuariosAsistencia();
        return view('home', compact('usuarios'));
    }

    public function auth(AuthService $service, AuthRequest $request)
    {
        
        $credentials = $request->validated();
        try {
            if($service->authenticate($credentials)){
                return redirect('/')->with('message' ,'Autenticado correctamente.');
            }
        
            return redirect('/login')->with('error', 'Correo o contraseña invalidos.');

        } catch(Exception $e){
             return redirect('/logout')->with('error' ,'Ups! algo salio mal.');
        }
    }

    public function logout(AuthService $service, Request $request)
    {
        $service->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
