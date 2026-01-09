<?php

namespace App\Http\Requests\eventos;


class EventosMessages
{

    public static function common(): array
    {
        return [
            'nombre.required'=>'El nombre del evento es obligatorio',
            'nombre.string'=>'El nombre del evento debe ser una cadena de texto',
            'nombre.max'=>'El nombre del evento no debe exceder los 100 caracteres',
            'fecha_inicio.date'=>'La fecha de inicio debe ser una fecha válida',
            'fecha_inicio.after_or_equal'=>'La fecha de inicio no puede ser pasada',
            'descripcion.required'=>'La descripción es obligatoria',
            'descripcion.string'=>'La descripción debe ser una cadena de texto',
            'descripcion.max'=>'La descripción no debe exceder los 300 caracteres',
            'admin_encargado.required'=>'El administrador encargado es obligatorio',
            'admin_encargado.integer'=>'El administrador encargado debe ser un número entero',
        ];
    }
}
