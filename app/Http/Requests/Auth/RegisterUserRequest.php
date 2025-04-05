<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    /**
     * Autoriza o request (mantém true).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação do formulário de registro.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()     // Letra maiúscula e minúscula
                    ->letters()       // Pelo menos uma letra
                    ->numbers()       // Pelo menos um número
                    ->symbols()       // Pelo menos um caractere especial
                    ->uncompromised() // Evita senhas vazadas
            ],
        ];
    }

    /**
     * Mensagens de erro personalizadas (opcional).
     */
    public function messages(): array
    {
        return [
            'password.min' => '• A senha deve ter no mínimo 8 caracteres.',
            'password.mixed_case' => '• A senha deve conter letras maiúsculas e minúsculas.',
            'password.letters' => '• A senha deve conter pelo menos uma letra.',
            'password.numbers' => '• A senha deve conter pelo menos um número.',
            'password.symbols' => '• A senha deve conter pelo menos um caractere especial.',
            'password.uncompromised' => '• Essa senha já apareceu em um vazamento de dados. Escolha outra.',
        ];
    }
}
