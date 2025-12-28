<?php

namespace App\Services;

use App\Models\Usuario;

class UsuarioService
{
    public function update(string $uuid, array $data): Usuario
    {
        $usuario = Usuario::where('uuid', $uuid)->firstOrFail();

        $usuario->update([
            'nombre' => $data['nombre'],
            'fechanacimiento' => $data['fechanacimiento'],
            'fechaIngreso' => $data['fechaIngreso'],
            'telefono' => $data['telefono'],
        ]);

        return $usuario;
    }
}
