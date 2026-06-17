<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InscripcionStepThreeRequest extends FormRequest
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
        if($this->input('accion') == 'guardar')
            $rules = [
                'otros_programas' => 'required_if_accepted:switch_otros_programas'
            ];

        elseif ($this->input('accion') == 'enviar') {
            $rules = [
                'biofilmografia_director' => 'required',
                'link_1' => 'nullable|url',
                'link_2' => 'nullable|url',
                'link_3' => 'nullable|url',
                'nota_director' => 'required',
                'biofilmografia_productora' => 'required',
                'nota_productor' => 'required',
                'idioma' => 'required',
                'duracion' => 'required|numeric',
                'genero' => 'required',
                'logline' => 'required',
                'sinopsis' => 'required',
                'presupuesto' => 'required',
                'plan_financiacion' => 'required',
                'plan_promocion' => 'required',
                'otros_programas' => 'required_if_accepted:switch_otros_programas',
                'status' => 'required',
                'otros_proyectos' => 'required',
                'motivaciones' => 'required',
                'conocido' => 'required',
                'switch_acepta_bases' => 'required|boolean',
                'switch_acepta_politica' => 'required|boolean'
            ];

            if ($this->route('inscripcion')->archivos()->where('archivo_tipo_id', 2)->exists()) {
                $rules['pdf_guion'] = 'nullable';
            } else {
                $rules['pdf_guion'] = 'required';
            }
        }


        return $rules;
    }

    public function messages() {
        return [
            'biofilmografia_director' => 'La biofilmografía del director/a es obligatoria.',
            'link_1.url' => 'Debes introducir un enlace válido (http://ejemplo.com).',
            'link_2.url' => 'Debes introducir un enlace válido (http://ejemplo.com).',
            'link_3.url' => 'Debes introducir un enlace válido (http://ejemplo.com).',
            'nota_director' => 'La nota del director/a es obligatoria.',
            'biofilmografia_productora' => 'La biofilmografía de la productora es obligatoria.',
            'nota_productor' => 'La nota de la productora es obligatoria.',
            'idioma' => 'Debes especificar el idioma.',
            'duracion' => 'Debes especificar la duración.',
            'genero' => 'Selecciona el género al que pertenece la inscripción.',
            'logline' => 'El logline es obligatorio.',
            'sinopsis' => 'La sinopsis es obligatoria.',
            'presupuesto' => 'Debes especificar el presupuesto.',
            'plan_financiacion' => 'El plan de financiación es obligatorio.',
            'plan_promocion' => 'El plan de promoción es obligatorio.',
            'otros_programas.required_if_accepted' => 'Debes especificar en qué otros programas ha participado tu proyecto si marcas esta opción.',
            'status' => 'El estado del proyecto es obligatorio.',
            'otros_proyectos' => 'Debes especificar en qué otros proyectos está trabajando la productora.',
            'motivaciones' => 'Debes especificar cuáles son tus motivaciones y objetivos.',
            'conocido' => 'Debes especificar cómo nos has conocido.',
            'pdf_guion' => 'Debes subir el guion en pdf.',
            'switch_acepta_bases' => 'Debes aceptar las condiciones.',
            'switch_acepta_politica' => 'Debes aceptar las condiciones.' 
        ];
    }
}
