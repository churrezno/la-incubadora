<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InscripcionStepOneRequest extends FormRequest
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
            'titulo' => 'required',
            'director' => 'required',
            'fecha_nac_director' => 'required|date',
            'sexo_director' => 'required',
            'largometrajes' => 'required_unless:switch_largometrajes,1',
            'codirector' => 'required_if_accepted:switch_codirector',
            'guionista' => 'required_unless:switch_guionista,1',
            'coguionista' => 'required_if_accepted:switch_coguionista',
        ];
    }

    public function messages() {
        return [
            'director' => 'El nombre del director/a es obligatorio.',
            'fecha_nac_director' => 'Debes especificar la fecha de nacimiento del director/a.',
            'largometrajes.required_unless' => 'Debes especificar otros largometrajes si marcas que no es su primer largo.',
            'codirector.required_if_accepted' => 'Debes especificar el nombre del codirector/a si marcas que existe.',
            'guionista.required_unless' => 'Debes especificar el nombre del guionista si marcas que no es el director.',
            'coguionista.required_if_accepted' => 'Debes especificar el nombre del coguionista/a si marcas que existe.',
        ];
    }
}
