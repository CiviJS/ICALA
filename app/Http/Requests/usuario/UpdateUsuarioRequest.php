<?php

namespace App\Http\Requests\usuario;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\usuario\BaseUsuarioRules;
use App\Http\Requests\usuario\usuarioMessages;
class UpdateUsuarioRequest extends FormRequest
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
           'nombre' => BaseUsuarioRules::nombre(),
            'fechanacimiento' => BaseUsuarioRules::fecha(),
            'fechaingreso' => BaseUsuarioRules::fecha(),
            'telefono' => BaseUsuarioRules::telefono(),
        ];
    }

    public function messages(): array
    {
        return usuarioMessages::common();
    }
}
