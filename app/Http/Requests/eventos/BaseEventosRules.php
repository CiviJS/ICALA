<?php

namespace App\Http\Requests\eventos;

class BaseEventosRules
{

    public static function nombre(): array
    {
        return ['required', 'string', 'max:100'];
    }
    public static function fecha(): array
    {
        return  ['date', 'after_or_equal:today'];
    }
    public static function descripcion(): array
    {
        return ['required', 'string', 'max:300'];
    }
    public static function adminEncargado(): array
    {
        return ['required', 'integer'];
    }
}
