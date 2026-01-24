<?php

namespace App\Services;

use App\Models\Planilla;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Database\Eloquent\Collection;

class PlanillasService
{

    public function __construct(
        protected UsuarioService $usuarioService
    ) {}

    public function store(array $data): Planilla
    {

        return Planilla::create([
            'fechacreacion'    => now(),
            'id_admin'    => $data['IdUsuario'],
            'tipodeactividad'  => $data['TipoServicio']
        ]);
    }
    public function obtenerPlanillas(): LengthAwarePaginator
    {
        $planillas = Planilla::orderBy('fechacreacion', 'desc')->paginate(10);
        return $planillas;
    }
    public function obtenerPlanillaUUID(string $uuid, string $campoUsuario): array
    {
        $planilla = Planilla::with('encargado', 'usuarios')->where('uuid', $uuid)->firstOrFail();
        $campoUsuario = trim($campoUsuario);
        if ($campoUsuario !== '') {
            $usuarios = $this->usuarioService->buscarPorCampo($campoUsuario);
        } else {
            $usuarios = $this->usuarioService->ObtenerUsuarios();
        }
        $asistieron = $planilla->usuarios->pluck('uuid')->toArray();

        foreach ($usuarios as $usuario) {
            $usuario->asistencia = in_array($usuario->uuid, $asistieron);
        }

        return [
            'planilla' => $planilla,
            'usuarios' => $usuarios
        ];
    }

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
