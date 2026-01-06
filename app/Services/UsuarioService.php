<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;


class UsuarioService
{
<<<<<<< HEAD

    public function store(array $data): Usuario
    {
        return Usuario::create($data);
    }

    public function obtenerUsuarios(): Collection
    {
        return Usuario::all();
    }

    public function update(string $uuid, array $data): void
=======
    public function __construct(
        protected ReportesService $reportesService
    ){}

    public function store(array $data):Usuario
    { 
        return Usuario::create($data);
    }

    public function obtenerUsuarios(): Collection{
        return Usuario::all();
    }
    
    public function update(string $uuid, array $data): Usuario
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
    {
        $usuario = $this->buscarUUID($uuid);
        $usuario->update([
            'nombre' => $data['nombre'],
            'fechanacimiento' => $data['fechanacimiento'],
            'fechaingreso' => $data['fechaingreso'],
            'telefono' => $data['telefono'],
        ]);
<<<<<<< HEAD
=======
        return $usuario;
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
    }

    public function buscarUUID(string $uuid): Usuario
    {
        $usuario = Usuario::where('uuid', $uuid)->firstOrFail();
        return $usuario;
    }
<<<<<<< HEAD
    public function eliminarUUID(string $uuid): void
    {
        $this->buscarUUID($uuid)->delete();
    }

    public function buscarPorCampo($campo): Usuario
    {
        $usuarios = Usuario::where('nombre', 'LIKE', "%$campo%")
            ->orWhere('telefono', 'LIKE', "%$campo%")
            ->orWhere('fechanacimiento', 'LIKE', "%$campo%")
            ->get();
        return $usuarios;
    }
=======
   public function eliminarUUID(string $uuid): void
    {
        $this->buscarUUID($uuid)->delete();
    }
    public function buscarPorCampo($campo){
        return $this->reportesService->buscarPorCampo($campo);
    }
    
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
}
