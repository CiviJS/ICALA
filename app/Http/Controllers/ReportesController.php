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
        $fecha = $request->input('Fecha');
     
        return $this->index($fecha);
    }

    public function IntegrantesNuevos(Carbon $fecha)
    {
        return Usuario::whereYear('fechaIngreso', $fecha->year)
                      ->whereMonth('fechaIngreso', $fecha->month)
                      ->get();
    }

    public function cumpleAniosHoy(Carbon $fecha)
    {
        return Usuario::whereMonth('fechaNacimiento', $fecha->month)
                      ->whereDay('fechaNacimiento', $fecha->day)
                      ->get();
    }

    public function cumpleAniosManana(Carbon $fecha)
    {   
        $manana = $fecha->copy()->addDay();
        return Usuario::whereMonth('fechaNacimiento', $manana->month)
                      ->whereDay('fechaNacimiento', $manana->day)
                      ->get();
    }
}
