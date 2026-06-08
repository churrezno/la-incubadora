<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSlateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'productor' => 'required',
            'fecha_nac_productor' => 'required|date',
            'sexo_productor' => 'required',
            'tel_productor' => 'required',
            'cod_postal_productor' => 'required',
            'ciudad_productor' => 'required',
            'pais_productor' => 'required',
            'email_productor' => 'required|email',
            'pdf_documentacion' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'productor' => 'El nombre del productor/a es obligatorio.',
            'fecha_nac_productor' => 'Debes especificar la fecha de nacimiento del productor/a.',
            'tel_productor' => 'El nº de teléfono de la productora es obligatorio.',
            'cod_postal_productor' => 'El código postal de la productora es obligatorio.',
            'ciudad_productor' => 'Debes especificar la ciudad de la productora.',
            'pais_productor' => 'Debes especificar el país de la productora.',
            'email_productor' => 'El email de la productora es obligatorio.',
        ];
    }
}