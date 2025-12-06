<?php

namespace App\Http\Controllers;

use App\Models\Planilla;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        return view('home/homeUsuarios');
    }
    public function Admin()
    {
        $usuarios = Usuario::all();
        //Numero de asistencias o tablas asociadas
        $usuarios->loadCount('planillas'); 

        foreach ($usuarios as $usuario) {
            $usuario->NoAsistidas = $this->NoAsistidas($usuario->fechaIngreso,$usuario->planillas_count);            
        }
        return view('home', compact('usuarios'));
    }

    public function NoAsistidas($FechaIngresoUsuario,$NumeroDeAsistencias)
    {
       //por si los usuariios no tienen Fecha de Ingreso por algun error
        if (empty($FechaIngresoUsuario)) {
            return 0;
        }

        $fechaComparacion = $FechaIngresoUsuario instanceof \DateTimeInterface
                            ? $FechaIngresoUsuario->format('Y-m-d H:i:s')
                            : $FechaIngresoUsuario;

        $planillasMayores = Planilla::where('FechaCreacion', '>', $fechaComparacion)->count();
        
        return $planillasMayores - $NumeroDeAsistencias;
    }
}