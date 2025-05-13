<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="current_password" class="form-label">Senha Atual</label>
            <input id="current_password" name="current_password" type="password" class="form-input" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Nova Senha</label>
            <input id="password" name="password" type="password" class="form-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">
                Atualizar Senha
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600">Senha atualizada com sucesso.</p>
            @endif
        </div>
    </form>
</section>
