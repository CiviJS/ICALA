<?php
<<<<<<< HEAD

namespace App\Services;

use App\Models\Planilla;


class PlanillasService
{

    public function __construct(
        protected UsuarioService $usuarioService
    ) {}

    public function store(array $data): Planilla
    {
        return Planilla::create([
            'fechacreacion'    => now(),
            'usuarioacargo'    => $data['IdUsuario'],
            'tipodeactividad'  => $data['TipoServicio']
        ]);
    }
    public function obtenerPlanillas(): array
    {
        $planilla = Planilla::select('uuid', 'fechacreacion', 'usuarioacargo', 'tipodeactividad')->get();
=======
namespace App\Services;
use App\Models\Planilla;


class PlanillasService{

    public function __construct(
        protected UsuarioService $usuarioService
    ){}
    
        public function store(array $data):Planilla
    {
        return Planilla::create([
                'fechacreacion'    => now(),
                'usuarioacargo'    => $data['IdUsuario'],
                'tipodeactividad'  => $data['TipoServicio']
            ]);

    }
    public function obtenerPlanillas():array {
        $planilla = Planilla::select('uuid', 'fechacreacion','usuarioacargo','tipodeactividad')->get();
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
        $usuarios = $this->usuarioService->ObtenerUsuarios();
        return [
            'planillas' => $planilla,
            'usuarios' => $usuarios
        ];
    }
<<<<<<< HEAD
    public function obtenerPlanillasUUID(string $uuid): array
    {
        $planilla = Planilla::with('encargado', 'usuarios')->where('uuid', $uuid)->firstOrFail();
        $usuarios = $this->usuarioService->ObtenerUsuarios();
        $asistieron = $planilla->usuarios->pluck('uuid')->toArray();

        foreach ($usuarios as $usuario) {
            $usuario->asistencia = in_array($usuario->uuid, $asistieron);
        }
        return [
=======
    public function obtenerPlanillasUUID(string $uuid): array{
            $planilla = Planilla::with('encargado', 'usuarios')->where('uuid', $uuid)->firstOrFail();
            $usuarios = $this->usuarioService->ObtenerUsuarios();
            $asistieron = $planilla->usuarios->pluck('uuid')->toArray();

            foreach ($usuarios as $usuario) {
                $usuario->asistencia = in_array($usuario->uuid, $asistieron);
            }
            return[
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
            'planilla' => $planilla,
            'usuarios' => $usuarios
        ];
    }
<<<<<<< HEAD

    public function marcarAsistencia(string $planillaUUID, string $usuarioUUID): void
    {

        $planilla = Planilla::where('uuid', $planillaUUID)->firstOrFail();

        $usuario = $this->usuarioService->buscarUUID($usuarioUUID);
        if ($planilla->fechacreacion < $usuario->fechaingreso) {
            throw new \InvalidArgumentException('No se puede agregar usuario con fecha de ingreso posterior.');
        }
        $planilla->usuarios()->toggle($usuarioUUID);
    }

    public function eliminar(string $planillaUUID): void
    {
        $planilla = Planilla::where('uuid', $planillaUUID)->firstOrFail();
        $planilla->usuarios()->detach();
        $planilla->delete();
    }
}
=======
    
    public function marcarAsistencia(string $planillaUUID,string $usuarioUUID):void{
         
            $planilla = Planilla::where('uuid', $planillaUUID)->firstOrFail();
    
            $usuario = $this->usuarioService->buscarUUID($usuarioUUID);
            if ($planilla->fechacreacion < $usuario->fechaingreso) {
                throw new \InvalidArgumentException('No se puede agregar usuario con fecha de ingreso posterior.');
            }
            $planilla->usuarios()->toggle($usuarioUUID);

    }

    public function eliminar(string $planillaUUID):void{
            $planilla = Planilla::where('uuid', $planillaUUID)->firstOrFail();
            $planilla->usuarios()->detach();
            $planilla->delete();
    }

}
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
