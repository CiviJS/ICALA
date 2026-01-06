<?php

namespace App\Http\Requests\eventos;

use App\Http\Requests\eventos\BaseEventosRules;
use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
              'nombre' => BaseEventosRules::nombre(),
              'fecha_inicio'=> BaseEventosRules::fecha(), 
              'descripcion' => BaseEventosRules::descripcion(),
              'admin_encargado' => BaseEventosRules::adminEncargado()
        ];
    }
    public function messages(): array
    {
        return EventosMessages::common();
    }
}
