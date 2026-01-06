<?php 

namespace App\Http\Requests\usuario;
class BaseUsuarioRules {

    public static function nombre(): array
        {
            return ['required', 'string', 'max:30', 'alpha_spaces'];
        }

    public static function fecha(): array
        {
            return ['required','date', 'before_or_equal:today'];
        }
    public static function telefono(): array
        {
            return ['required', 'regex:/^\d{7,12}$/', 'integer'];
        }
    public static function campo(): array
        {
            return ['required' ,'max:30'];
        }

}
