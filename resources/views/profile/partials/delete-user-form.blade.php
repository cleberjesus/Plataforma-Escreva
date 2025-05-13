<form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
    @csrf
    @method('delete')

    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
        <h3 class="text-lg font-medium text-red-800 mb-2">Excluir Conta</h3>
        <p class="text-sm text-red-600 mb-4">
            Depois que sua conta for excluída, todos os seus recursos e dados serão permanentemente excluídos. 
            Antes de excluir sua conta, faça o download de quaisquer dados ou informações que deseja manter.
        </p>

        <div class="form-group">
            <label for="password" class="form-label">Digite sua senha para confirmar</label>
            <input id="password" name="password" type="password" class="form-input" placeholder="Digite sua senha" />
            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
        </div>

        <button type="submit" class="btn-danger w-full">
            Excluir Conta
        </button>
    </div>
</form>
