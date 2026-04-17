<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreValoracionRequest extends FormRequest
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
            'guion' => 'required',
            'puntos_guion' => 'required',
            'financiacion' => 'required',
            'puntos_financiacion' => 'required',
            'solicitante' => 'required',
            'puntos_solicitante' => 'required',
        ];
    }

    public function messages(): array {
        return [
            'puntos_guion.required' => 'Debes puntuar el guion',
            'puntos_financiacion.required' => 'Debes puntuar la financiación',
            'puntos_solicitante.required' => 'Debes puntuar al solicitante',
        ];
    }
}
