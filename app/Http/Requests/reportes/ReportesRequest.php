<?php

namespace App\Http\Requests\reportes;

use Illuminate\Foundation\Http\FormRequest;

class ReportesRequest extends FormRequest
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
            'fecha' => ['date', 'before_or_equal:today']
        ];
    }
    public function messages(): array
    {
        return[
            'fecha.requiered' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no es válida.',
            'fecha.before_or_equal' => 'La fecha no puede ser futura.',
        ];
    }
}
