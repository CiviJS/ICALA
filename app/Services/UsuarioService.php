<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UsuarioService
{

    public function __construct(protected ReportesService $reporteService) {}
    public function store(array $data): Usuario
    {
        return Usuario::create($data);
    }

    public function obtenerUsuarios(): LengthAwarePaginator
    {
        return Usuario::orderBy('nombre','desc')->paginate(10);
    }

    public function update(string $uuid, array $data): void
    {
        $usuario = $this->buscarUUID($uuid);
        $usuario->update([
            'nombre' => $data['nombre'],
            'fechanacimiento' => $data['fechanacimiento'],
            'fechaingreso' => $data['fechaingreso'],
            'telefono' => $data['telefono'],
        ]);
    }

    public function buscarUUID(string $uuid): Usuario
    {
        $usuario = Usuario::where('uuid', $uuid)->firstOrFail();
        return $usuario;
    }
    public function eliminarUUID(string $uuid): void
    {
        $this->buscarUUID($uuid)->delete();
    }

    public function buscarPorCampo($campo): LengthAwarePaginator
    {
        $usuarios = Usuario::where('nombre', 'ILIKE', "%{$campo}%")
            ->orWhere('telefono', 'ILIKE', "%{$campo}%")
            ->orWhere('fechanacimiento', 'ILIKE', "%{$campo}%")
            ->orderBy('nombre', 'desc')
            ->paginate(10);

        $usuarios->loadCount('planillas');

        $usuarios->getCollection()->transform(function ($usuario) {
            $usuario->noAsistidas = $this->reporteService->noAsistidas(
                $usuario->fechaingreso,
                $usuario->planillas_count
            );
            return $usuario;
        });

        return $usuarios;
    }
}
