<?php

namespace App\Http\Requests\usuario;

class usuarioMessages{

    public static function common(): array{
        return[
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.alpha_spaces' => 'El nombre solo puede contener letras y espacios.',
            'fechanacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fechanacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'fechanacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser futura.',
            'fechaingreso.date' => 'La fecha de ingreso debe ser una fecha válida.',
            'fechaingreso.before_or_equal' => 'La fecha de ingreso no puede ser futura.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono solo debe tener 12 dígitos.',
            'campo.required' => 'el campo es obligatorio.',
            'campo.max' => 'Solo se permiten un maximo de 30 caracteres.'
        ];
    }

}