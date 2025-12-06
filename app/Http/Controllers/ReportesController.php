<?php

namespace App\Http\Controllers;

use App\Models\Planilla;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index($fecha = null)
    {
        $fechaActual = Carbon::now();
        $fecha = $fecha ? Carbon::parse($fecha) : $fechaActual;
        $Nusuarios = $this->IntegrantesNuevos($fecha);
        $cumpleAniosHoy = $this->cumpleAniosHoy($fechaActual);
        $cumpleAniosManana = $this->cumpleAniosManana($fechaActual);

        return view('reportes.reportes', compact(
            'Nusuarios',
            'cumpleAniosHoy',
            'cumpleAniosManana'
        ));
    }

    public function Fecha(Request $request){
        $request->validate(
            ['fecha' => 'required|date|before_or_equal:today'],
            ['fecha.required' =>'El Campo Fecha',
             'fecha.date' => 'formato de fecha Invalido',
             'fecha.before_or_equal' => 'Fecha no puede ser futura']
        );
        $fecha = $request->input('fecha');
     
        return $this->index($fecha);
    }

    public function IntegrantesNuevos(Carbon $fecha)
    {
        return Usuario::whereYear('fechaingreso', $fecha->year)
                      ->whereMonth('fechaingreso', $fecha->month)
                      ->get();
    }

    public function cumpleAniosHoy(Carbon $fecha)
    {
        return Usuario::whereMonth('fechanacimiento', $fecha->month)
                      ->whereDay('fechanacimiento', $fecha->day)
                      ->get();
    }

    public function cumpleAniosManana(Carbon $fecha)
    {   
        $manana = $fecha->copy()->addDay();
        return Usuario::whereMonth('fechanacimiento', $manana->month)
                      ->whereDay('fechanacimiento', $manana->day)
                      ->get();
    }
}
