<?php

namespace App\Http\Controllers;

use App\Http\Requests\authRequest;
use App\Services\authService;
use App\Services\ReportesService;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home/homeUsuarios');
    }
    public function login()
    {
        return view('auth/login');
    }

    public function admin(ReportesService $service)
    {
        $usuarios = $service->usuariosAsistencia();
        return view('home', compact('usuarios'));
    }

    public function auth(authService $service, authRequest $request)
    {
        
        $credentials = $request->validated();
        try {
        
            if($service->authenticate($credentials)){
                return redirect('/')->with('message' ,'Autenticado correctamente.');
            }
        
            return redirect('/')->with('error', 'Correo o contraseña invalidos.');

        } catch(Exception $e){
             return redirect('/logout')->with('error' ,'Ups! algo salio mal.');
        }
    }

    public function logout(authService $service, Request $request)
    {
        $service->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
