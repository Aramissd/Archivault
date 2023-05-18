<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Solo se permite la actualización si el usuario está autenticado
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Define las reglas de validación para el formulario de usuario
        return [
            'nombre' => 'required',
            'apellidos' => 'required',
            // 'email' => 'required|email|unique:usuarios,email,' . $this->route('usuario'),
            'rol' => 'required',
            'password' => 'nullable|min:6',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }

    /**
     * Hash the password field if it is present in the request.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->has('password')) {
            $this->merge([
                'password' => Hash::make($this->password),
            ]);
        }
    }
}
