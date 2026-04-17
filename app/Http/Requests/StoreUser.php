<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUser extends FormRequest
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
            'name' =>'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::defaults()],
            'rol' => 'required'
        ];
    }

    // Personalizar mensaje de error
    // public function messages(): array {
    //     return [
    //         'name.required' => '¡El nombre es obligatorio!'
    //     ];
    // }

    // Personalizar autotraducción del atributo del campo
    // public function attributes(): array {
    //     return [
    //         'name' => 'nombre de usuario'
    //     ];
    // }
}
