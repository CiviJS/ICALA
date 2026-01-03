<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;


class UsuarioService
{
    public function __construct(
        protected ReportesService $reportesService
    ){}

    public function store(array $data):Usuario
    { 
        return Usuario::create($data);
    }

    public function ObtenerUsuarios(): Collection{
        return Usuario::all();
    }
    
    public function update(string $uuid, array $data): Usuario
    {
        $usuario = $this->buscarUUID($uuid);
        $usuario->update([
            'nombre' => $data['nombre'],
            'fechanacimiento' => $data['fechanacimiento'],
            'fechaingreso' => $data['fechaingreso'],
            'telefono' => $data['telefono'],
        ]);
        return $usuario;
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
    public function buscarPorCampo($campo){
        return $this->reportesService->buscarPorCampo($campo);
    }
    
}
