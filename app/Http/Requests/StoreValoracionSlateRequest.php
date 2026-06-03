<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreValoracionSlateRequest extends FormRequest
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
            'comentarios' => 'required',
            'puntos' => 'required',
        ];
    }

    public function messages(): array {
        return [
            'puntos.required' => 'Debes puntuar la documentación del perfil',
        ];
    }
}
