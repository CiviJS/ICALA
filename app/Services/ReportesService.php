<?php
namespace App\Services;
use App\Models\Usuario;
use App\Models\Planilla;
use Carbon\Carbon;

class ReportesService{
    

public function usuariosAsistencia()
{
    $usuarios = Usuario::all();
    $usuarios->loadCount('planillas'); 
    foreach ($usuarios as $usuario) {
            $usuario->NoAsistidas = $this->NoAsistidas(
                $usuario->fechaingreso,
                $usuario->planillas_count
            );            
        }

    return $usuarios;
}
public function buscarPorCampo($campo){
        $usuarios = Usuario::where('nombre', 'LIKE', "%$campo%")
                    ->orWhere('telefono', 'LIKE', "%$campo%")
                    ->orWhere('fechanacimiento', 'LIKE', "%$campo%")
                    ->get();
        $usuarios->loadCount('planillas');
       foreach ($usuarios as $usuario) {
            $usuario->NoAsistidas = $this->NoAsistidas(
                $usuario->fechaingreso,
                $usuario->planillas_count
            );            
        }
    return $usuarios;
    }

public function noAsistidas($fechaIngresoUsuario, $numeroAsistencias)
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

    public function reportesUsuarios($fecha = null){
        $fechaActual = Carbon::now();
        $fecha = $fecha ? Carbon::parse($fecha) : $fechaActual;
        $Nusuarios = $this->integrantesNuevos($fecha);
        $cumpleAniosHoy = $this->cumpleAniosHoy($fechaActual);
        $cumpleAniosManana = $this->cumpleAniosManana($fechaActual);

        return [
            'Nusuarios' => $Nusuarios,
            'cumpleAniosHoy' => $cumpleAniosHoy,
            'cumpleAniosManana' => $cumpleAniosManana
        ]; 

    }

    public function integrantesNuevos(Carbon $fecha)
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