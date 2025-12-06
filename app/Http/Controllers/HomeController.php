<?php

namespace App\Http\Controllers;

use App\Models\Planilla;
use Illuminate\Http\Request;
use App\Models\Usuario;

class HomeController extends Controller
{

    public function index()
    {
        return view('home/homeUsuarios');
    }

    public function admin()
    {
        $usuarios = Usuario::all();
        $usuarios->loadCount('planillas'); 

        foreach ($usuarios as $usuario) {
            $usuario->NoAsistidas = $this->NoAsistidas(
                $usuario->fechaingreso,
                $usuario->planillas_count
            );            
        }

        return view('home', compact('usuarios'));
    }

    public function NoAsistidas($fechaIngresoUsuario, $numeroAsistencias)
    {
        if (empty($fechaIngresoUsuario)) {
            return 0;
        }

        $fechaComparacion = $fechaIngresoUsuario instanceof \DateTimeInterface
                            ? $fechaIngresoUsuario->format('Y-m-d H:i:s')
                            : $fechaIngresoUsuario;

        $planillasMayores = Planilla::where('fechacreacion', '>', $fechaComparacion)->count();
        
        return $planillasMayores - $numeroAsistencias;
    }
}
