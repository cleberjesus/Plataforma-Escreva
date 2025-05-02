<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Http;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'g-recaptcha-response' => ['required', function ($attribute, $value, $fail) {
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => config('services.recaptcha.secret'),
                    'response' => $value,
                    'remoteip' => request()->ip(),
                ]);

                // Log da resposta do reCAPTCHA para debug
                \Log::info('reCAPTCHA response', $response->json());

                if (!optional($response->json())['success']) {
                    $fail('A validação do reCAPTCHA falhou. Tente novamente.');
                }
            }],
        ];
    }

    public function messages(): array
    {
        return [
            'g-recaptcha-response.required' => '• Por favor, confirme que você não é um robô.',
            'password.min' => '• A senha deve ter no mínimo 8 caracteres.',
            'password.mixed_case' => '• A senha deve conter letras maiúsculas e minúsculas.',
            'password.letters' => '• A senha deve conter pelo menos uma letra.',
            'password.numbers' => '• A senha deve conter pelo menos um número.',
            'password.symbols' => '• A senha deve conter pelo menos um caractere especial.',
            'password.uncompromised' => '• Essa senha já apareceu em um vazamento de dados. Escolha outra.',
        ];
    }
}
