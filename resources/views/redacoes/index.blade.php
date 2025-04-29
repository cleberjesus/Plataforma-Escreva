@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Formulário de Nova Redação -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Nova Redação</h2>

            <form action="{{ route('redacoes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

<<<<<<< HEAD
                <div>
                    <label for="tema" class="block text-gray-700 mb-2 font-semibold">Tema</label>
                    <input type="text" id="tema" name="tema" class="w-full p-3 border rounded-lg" required value="{{ old('tema') }}">
                </div>

                <div>
                    <label for="modo_envio" class="block text-gray-700 mb-2 font-semibold">Modo de Envio</label>
                    <select id="modo_envio" name="modo_envio" class="w-full p-3 border rounded-lg" required>
                        <option value="digitado">Digitado</option>
                        <option value="imagem">Imagem</option>
                    </select>
                </div>

                <div id="texto_redacao_div">
                    <label for="texto_redacao" class="block text-gray-700 mb-2 font-semibold">Texto da Redação</label>
                    <textarea id="texto_redacao" name="texto_redacao" rows="5" class="w-full p-3 border rounded-lg"></textarea>
                </div>
=======
            <div class="mb-3">
                <label for="tema" class="form-label fw-bold text-white">Tema da Redação</label>
                <input type="text" class="form-control" id="tema" name="tema" required
                    value="{{ old('tema', $redacaoEditando->tema ?? '') }}" style="color: black;">
            </div>

            <div class="mb-3">
                <label for="modo_envio" class="form-label fw-bold text-white">Modo de Envio</label>
                <select class="form-select" id="modo_envio" name="modo_envio" required onchange="toggleFields(this.value)">
                    <option value="digitado" {{ old('modo_envio', $redacaoEditando->modo_envio ?? '') == 'digitado' ? 'selected' : '' }}>Digitado</option>
                    <option value="imagem" {{ old('modo_envio', $redacaoEditando->modo_envio ?? '') == 'imagem' ? 'selected' : '' }}>Imagem</option>
                </select>
            </div>

            <div class="mb-3" id="texto_redacao_div">
                <label for="texto_redacao" class="form-label fw-bold text-white">Texto da Redação</label>
                <textarea class="form-control" id="texto_redacao" name="texto_redacao" rows="5" style="color: black;">{{ old('texto_redacao', $redacaoEditando->texto_redacao ?? '') }}</textarea>
            </div>
>>>>>>> cac0721484d5fd264060065e2776b57af6aba838

                <div id="imagem_redacao_div" style="display: none;">
                    <label for="imagem_redacao" class="block text-gray-700 mb-2 font-semibold">Upload da Redação</label>
                    <input type="file" id="imagem_redacao" name="imagem_redacao" class="w-full p-3 border rounded-lg" accept="image/*">
                </div>

<<<<<<< HEAD
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                    Salvar Redação
                </button>
            </form>
        </div>
=======
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary text-white">
                    {{ isset($redacaoEditando) ? 'Atualizar Redação' : 'Salvar Redação' }}
                </button>

                <!-- Botão Cancelar Alteração, somente visível se editando -->
                @if (isset($redacaoEditando))
                    <a href="{{ route('redacoes.index') }}" class="btn btn-secondary text-white">
                        Cancelar Alteração
                    </a>
                @endif
            </div>
        </form>
    </div>
>>>>>>> cac0721484d5fd264060065e2776b57af6aba838

        <!-- Lista de Redações Salvas -->
        <div>
            <h3 class="text-2xl font-bold mb-6 text-center">Redações Armazenadas</h3>

<<<<<<< HEAD
            @if ($redacoes->isEmpty())
                <p class="text-center text-gray-500">Nenhuma redação cadastrada.</p>
            @else
                <div class="space-y-4">
                    @foreach ($redacoes as $redacao)
                        <div class="bg-white p-5 rounded-2xl shadow-md">
                            <h4 class="font-bold text-lg mb-2">{{ $redacao->tema }}</h4>
                            <p class="text-gray-500 text-sm mb-4">
                                Enviado em {{ $redacao->created_at->format('d/m/Y H:i') }}
                            </p>

                            @if ($redacao->modo_envio === 'digitado')
                                <p class="text-gray-700">{{ Str::limit($redacao->texto_redacao, 150) }}</p>
                            @else
                                <img src="{{ asset('storage/' . $redacao->imagem_redacao) }}" class="rounded-lg shadow-md max-h-48 mx-auto">
                            @endif

                            <div class="flex justify-between mt-4">
                                <button onclick="abrirModalEditar({{ $redacao->id }}, '{{ addslashes($redacao->tema) }}', '{{ $redacao->modo_envio }}', '{{ addslashes($redacao->texto_redacao ?? '') }}')" 
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                <form action="{{ route('redacoes.destroy', $redacao->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar esta redação?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-1">
                                        <i class="fa-solid fa-trash"></i> Apagar
                                    </button>
                                </form>
=======
    <div class="mt-4">
        <h3 class="text-center mb-4 fw-bold text-white">Redações Salvas</h3>
        @if ($redacoes->isEmpty())
            <p class="text-muted text-center text-white">Nenhuma redação cadastrada.</p>
        @else
            <div class="row">
                @foreach ($redacoes as $redacao)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-lg p-3 rounded-4 bg-dark text-white">
                            <div class="card-body">
                                <h5 class="fw-bold text-white">Tema: {{ $redacao->tema }}</h5>
                                <p class="text-muted text-white">Enviado em: {{ $redacao->created_at->format('d/m/Y H:i') }}</p>

                                @if ($redacao->modo_envio === 'digitado')
                                    <p class="text-white">{{ $redacao->texto_redacao }}</p>
                                @else
                                    <img src="{{ asset('storage/' . $redacao->imagem_redacao) }}" class="img-fluid rounded-3 shadow-sm" alt="Redação imagem">
                                @endif

                                <!-- Botões -->
                                <div class="d-flex justify-content-between mt-3">
                                    <!-- Editar -->
                                    <a href="{{ route('redacoes.index', ['edit' => $redacao->id]) }}" class="btn btn-sm btn-warning d-flex align-items-center gap-1 text-white">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </a>

                                    <!-- Apagar -->
                                    <form action="{{ route('redacoes.destroy', $redacao->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar esta redação?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center gap-1 text-white">
                                            <i class="fa-solid fa-trash"></i> Apagar
                                        </button>
                                    </form>
                                </div>
>>>>>>> cac0721484d5fd264060065e2776b57af6aba838
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal de Edição -->
<div id="modal-editar" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
''''''''''''''''''''''''''''''    <div class="bg-white p-6 rounded-2xl shadow-md w-full max-w-2xl relative">
        <button onclick="fecharModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        
        <h2 class="text-2xl font-bold mb-6 text-center">Editar Redação</h2>

        <form id="form-editar" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <input type="hidden" id="editar_redacao_id" name="redacao_id">

            <div>
                <label for="editar_tema" class="block text-gray-700 mb-2 font-semibold">Tema</label>
                <input type="text" id="editar_tema" name="tema" class="w-full p-3 border rounded-lg" required>
            </div>

            <div>
                <label for="editar_modo_envio" class="block text-gray-700 mb-2 font-semibold">Modo de Envio</label>
                <select id="editar_modo_envio" name="modo_envio" class="w-full p-3 border rounded-lg" required onchange="toggleEditarFields(this.value)">
                    <option value="digitado">Digitado</option>
                    <option value="imagem">Imagem</option>
                </select>
            </div>

            <div id="editar_texto_redacao_div">
                <label for="editar_texto_redacao" class="block text-gray-700 mb-2 font-semibold">Texto da Redação</label>
                <textarea id="editar_texto_redacao" name="texto_redacao" rows="5" class="w-full p-3 border rounded-lg"></textarea>
            </div>

            <div id="editar_imagem_redacao_div" style="display: none;">
                <label for="editar_imagem_redacao" class="block text-gray-700 mb-2 font-semibold">Upload da Redação</label>
                <input type="file" id="editar_imagem_redacao" name="imagem_redacao" class="w-full p-3 border rounded-lg" accept="image/*">
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                Atualizar Redação
            </button>
        </form>
    </div>
</div>

<!-- Scripts -->
<script>
    function toggleFields(value) {
        // Mostrar/esconder campos dependendo do modo de envio
        document.getElementById('texto_redacao_div').style.display = value === 'digitado' ? 'block' : 'none';
        document.getElementById('imagem_redacao_div').style.display = value === 'imagem' ? 'block' : 'none';
    }

<<<<<<< HEAD
    function toggleEditarFields(value) {
        document.getElementById('editar_texto_redacao_div').style.display = value === 'digitado' ? 'block' : 'none';
        document.getElementById('editar_imagem_redacao_div').style.display = value === 'imagem' ? 'block' : 'none';
    }

=======
    // Iniciar com a seleção do modo de envio atual
>>>>>>> cac0721484d5fd264060065e2776b57af6aba838
    const selectModoEnvio = document.getElementById('modo_envio');
    if (selectModoEnvio) {
        toggleFields(selectModoEnvio.value);
        selectModoEnvio.addEventListener('change', function () {
            toggleFields(this.value);
        });
    }

    function abrirModalEditar(id, tema, modo_envio, texto_redacao) {
        document.getElementById('modal-editar').classList.remove('hidden');

        document.getElementById('editar_redacao_id').value = id;
        document.getElementById('editar_tema').value = tema;
        document.getElementById('editar_modo_envio').value = modo_envio;
        document.getElementById('editar_texto_redacao').value = texto_redacao;

        toggleEditarFields(modo_envio);

        document.getElementById('form-editar').action = `/redacoes/${id}`;
    }

    function fecharModal() {
        document.getElementById('modal-editar').classList.add('hidden');
    }
</script>
@endsection
