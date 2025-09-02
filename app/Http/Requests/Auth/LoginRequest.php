<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'O campo usuário é obrigatório.',
            'username.unique'   => 'Esse nome de usuário já está em uso.',
            'username.string'   => 'O nome de usuário deve ser um texto válido.',
            'username.max'      => 'O nome de usuário não pode ter mais que 255 caracteres.',

            'password.required' => 'A senha é obrigatória.',
            'password.string'   => 'A senha deve ser um texto válido.',
            'password.min'      => 'A senha deve ter pelo menos :min caracteres.',
            'password.confirmed'=> 'As senhas não coincidem.',
        ];
    }
}
