<?php

namespace App\Http\Controllers;

use App\Models\Planilla;
use App\Models\Usuario;
use App\Http\Requests\CrearPlanillaRequest;
use Ramsey\Uuid\Uuid;

class PlanillaController extends Controller
{
    public function store(CrearPlanillaRequest  $request)
    {   
        try {
            $planilla = Planilla::create([
                'uuid'             => Uuid::uuid4()->toString(),
                'fechacreacion'    => now(),
                'usuarioacargo'    => $request->input('IdUsuario'),
                'tipodeactividad'  => $request->input('tiposervicio')
            ]);

            return redirect("/planillas/ver/{$planilla->uuid}")
                ->with('message', 'Planilla creada exitosamente.');
        } catch (\Exception $e) {
            return redirect('/')
                ->with('error', 'Error al crear la planilla: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $planillas = Planilla::select('uuid', 'fechacreacion','usuarioacargo','tipodeactividad')->get();
        $usuarios = Usuario::select('uuid','nombre')->get();
        return view('planilla.planilla', compact('planillas','usuarios'));
    }

    public function asistencia($planillaUUID, $usuarioUUID)
    {
        try {
            $planilla = Planilla::where('uuid', $planillaUUID)->firstOrFail();
            $usuario  = Usuario::where('uuid', $usuarioUUID)->firstOrFail();

            if ($planilla->fechacreacion < $usuario->fechaingreso) {
                return back()->with('error','No se puede agregar usuario con fecha de ingreso posterior.');
            }

            $yaAsistio = $planilla->usuarios()->where('uuidusuario', $usuarioUUID)->exists();

            if ($yaAsistio) {
                $planilla->usuarios()->detach($usuarioUUID);
            } else {
                $planilla->usuarios()->attach($usuarioUUID);
            }

            return redirect("/planillas/ver/{$planillaUUID}")
                ->with('message', 'Usuario agregado a la planilla exitosamente.');
        } catch (\Exception $e) {
            return redirect('/')
                ->with('error', 'Error al agregar usuario a la planilla: ' . $e->getMessage());
        }
    }

    public function ver($uuid)
    {
        try {
            $planilla = Planilla::where('uuid', $uuid)->first();
            if(!$planilla){
                return redirect('/')->with('error','Plantilla No Existe.');
            }

            $planilla->encargado->nombre;

            $usuarios = Usuario::all();
            $asistieron = $planilla->usuarios->pluck('uuid')->toArray();

            foreach ($usuarios as $usuario) {
                $usuario->asistencia = in_array($usuario->uuid, $asistieron);
            }

            return view('planilla.verPlanilla', compact('planilla', 'usuarios'));
        } catch (\Exception $e) {
            return redirect('/')
                ->with('error', 'Error al ver la planilla: ' . $e->getMessage());
        }
    }

    public function eliminar($uuid)
    {
        try {
            $planilla = Planilla::where('uuid', $uuid)->first();
            if(!$planilla){
                return redirect('/')->with('error','Plantilla No Existe.');
            }
            $planilla->usuarios()->detach();
            $planilla->delete();

            return redirect('/planillas')
                ->with('message', 'Planilla eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect('/')
                ->with('error', 'Error al eliminar la planilla: ' . $e->getMessage());
        }
    }
}
