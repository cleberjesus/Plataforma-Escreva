@extends('layouts.app')

@section('title', 'Minhas Redações')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-4 lg:px-8">
        <x-back-button />

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 sm:p-10">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 gap-4">
                    <h3 class="text-2xl font-bold text-gray-800 text-center sm:text-left">Redações Armazenadas</h3>
                    <a href="{{ route('redacoes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow transition-all text-center">+ Nova Redação</a>
                </div>

                @if ($redacoes->isEmpty())
                    <p class="text-center text-gray-500">Nenhuma redação cadastrada.</p>
                @else
                    <div class="flex flex-col gap-6">
                        @foreach ($redacoes as $redacao)
                            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div class="flex-1">
                                    <h4 class="font-bold text-xl text-gray-800 mb-2">{{ $redacao->tema }}</h4>
                                    <p class="text-gray-500 text-sm mb-2">
                                        Enviado em {{ $redacao->created_at->format('d/m/Y H:i') }}
                                    </p>
                                    @if ($redacao->modo_envio === 'digitado')
                                        <p class="text-gray-700 mb-2">{{ Str::limit($redacao->texto_redacao, 150) }}</p>
                                    @else
                                        <img src="{{ asset('storage/' . $redacao->imagem_redacao) }}" class="rounded-lg shadow-md max-h-32 mb-2">
                                    @endif
                                </div>
                                <div class="flex flex-col sm:flex-row gap-2 sm:items-center sm:justify-end">
                                    <a href="{{ route('redacoes.show', $redacao->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-1 justify-center"><i class="fa-solid fa-eye"></i> Ver Redação</a>
                                    <a href="{{ route('redacoes.edit', $redacao->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-1 justify-center"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                    <form id="form-apagar-{{ $redacao->id }}" action="{{ route('redacoes.destroy', $redacao->id) }}" method="POST" class="form-apagar">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-1 w-full justify-center btn-apagar" data-id="{{ $redacao->id }}"><i class="fa-solid fa-trash"></i> Apagar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmação de exclusão -->
<div id="modal-confirmar-exclusao" class="fixed inset-0 z-50 hidden modal-bg flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-sm w-full text-center relative">
        <h2 class="text-xl font-bold mb-4">Confirmar Exclusão</h2>
        <p class="text-gray-700 mb-6">Tem certeza que deseja apagar esta redação? Essa ação não poderá ser desfeita.</p>
        <div class="flex justify-center gap-4">
            <button id="btn-cancelar-exclusao" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Cancelar</button>
            <button id="btn-confirmar-exclusao" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Apagar</button>
        </div>
        <button id="btn-fechar-modal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
    </div>
</div>
@endsection

@push('styles')
<style>
  .modal-bg {
    background: rgba(0,0,0,0.5);
  }
</style>
@endpush

@push('scripts')
<script>
    let formParaExcluir = null;
    document.querySelectorAll('.btn-apagar').forEach(btn => {
        btn.addEventListener('click', function() {
            formParaExcluir = document.getElementById('form-apagar-' + this.dataset.id);
            document.getElementById('modal-confirmar-exclusao').classList.remove('hidden');
        });
    });
    document.getElementById('btn-cancelar-exclusao').onclick = fecharModal;
    document.getElementById('btn-fechar-modal').onclick = fecharModal;
    function fecharModal() {
        document.getElementById('modal-confirmar-exclusao').classList.add('hidden');
        formParaExcluir = null;
    }
    document.getElementById('btn-confirmar-exclusao').onclick = function() {
        if (formParaExcluir) formParaExcluir.submit();
    };
    // Fechar modal com ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') fecharModal();
    });
    // Fechar modal ao clicar fora
    document.getElementById('modal-confirmar-exclusao').addEventListener('click', function(e) {
        if (e.target === this) fecharModal();
    });
</script>
@endpush
