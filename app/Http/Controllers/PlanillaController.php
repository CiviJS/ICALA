<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearPlanillaRequest;
use Illuminate\Support\Str;
use App\Services\PlanillasService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class PlanillaController extends Controller
{
    public function store(CrearPlanillaRequest $request, PlanillasService $service)
    {   
        try {
            $data = $request->validated();
            $planilla = $service->store($data);
            return redirect("/planillas/ver/{$planilla->uuid}")
                ->with('message', 'Planilla creada exitosamente.');
        }catch (\Exception $e) {
            return redirect('/')
                ->with('error', 'Error al crear la planilla: ' . $e->getMessage());
        }
    }
    public function index(PlanillasService $service)
    {   
        $data = $service->obtenerPlanillas();

        return view('planilla.planilla', compact('data'));
    }
    public function asistencia(PlanillasService $service, string $planillaUUID, string $usuarioUUID)
    {
        try {
            $this->validarUUID($planillaUUID);
            $this->validarUUID($usuarioUUID);
            $service->marcarAsistencia($planillaUUID, $usuarioUUID);
            return redirect("/planillas/ver/{$planillaUUID}")->with('message', 'Usuario agregado a la planilla exitosamente.');
        } catch(InvalidArgumentException $e){
            return redirect('/')->with('error', $e->getMessage()); 
        } catch(ModelNotFoundException){
            return redirect('/')->with('error', 'La planilla no existe.'); 
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Error al agregar usuario a la planilla: ' . $e->getMessage());
        }
    }

    public function ver(PlanillasService $service, string $uuid)
    {
        try {
           $this->validarUUID($uuid);
            $data = $service->obtenerPlanillasUUID($uuid);
            return view('planilla.verPlanilla', compact('data'));
        }catch(InvalidArgumentException $e){
            return redirect('/')->with('error', $e->getMessage()); 

        }catch(ModelNotFoundException){
            return redirect('/')->with('error', 'La planilla no existe.'); 
        } 
        catch (\Exception $e) {
            return redirect('/')->with('error', 'Ups! algo salio mal.');
        }
    }

    public function eliminar(PlanillasService $service, string $planillaUUID)
    {
        try {
            $this->validarUUID($planillaUUID);
            $service->eliminar($planillaUUID);
            return redirect('/planillas')->with('message', 'Planilla eliminada exitosamente.');
        } catch (ModelNotFoundException $e) {
            return redirect('/')->with('error', 'La planilla no existe.');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Ups! algo salio mal.');
        }
    }

    private function validarUUID(string $uuid): void {
        if (!$uuid) {
            throw new \InvalidArgumentException('UUID es obligatorio.');
            }
        if (!Str::isUuid($uuid)) {
            throw new \InvalidArgumentException('UUID inválido.');
        }
    }
}
