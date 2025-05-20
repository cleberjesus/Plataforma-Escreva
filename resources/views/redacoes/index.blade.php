@extends('layouts.app')

@section('title', 'Minhas Redações')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-back-button />

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="min-h-screen bg-gray-50 p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Formulário de Nova Redação -->
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all">
                        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Nova Redação</h2>

                        <form action="{{ route('redacoes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            <div>
                                <label for="tema" class="block text-gray-700 mb-2 font-semibold">Tema</label>
                                <input type="text" id="tema" name="tema" class="w-full p-3 border border-gray-300 rounded-lg" required value="{{ old('tema') }}">
                            </div>

                            <div>
                                <label for="modo_envio" class="block text-gray-700 mb-2 font-semibold">Modo de Envio</label>
                                <select id="modo_envio" name="modo_envio" class="w-full p-3 border border-gray-300 rounded-lg" required>
                                    <option value="digitado">Digitado</option>
                                    <option value="imagem">Imagem</option>
                                </select>
                            </div>

                            <div id="texto_redacao_div">
                                <label for="texto_redacao" class="block text-gray-700 mb-2 font-semibold">Texto da Redação</label>
                                <textarea id="texto_redacao" name="texto_redacao" rows="5" class="w-full p-3 border border-gray-300 rounded-lg"></textarea>
                            </div>

                            <div id="imagem_redacao_div" style="display: none;">
                                <label for="imagem_redacao" class="block text-gray-700 mb-2 font-semibold">Upload da Redação</label>
                                <label for="imagem_redacao" class="flex items-center justify-center gap-2 cursor-pointer w-full p-3 border-dashed border-2 border-gray-400 rounded-lg bg-gray-100 hover:bg-gray-200">
                                    <i class="fa-solid fa-upload text-blue-600"></i>
                                    <span id="imagem_redacao_label_text">Selecionar Arquivo</span>
                                </label>
                                <input type="file" id="imagem_redacao" name="imagem_redacao" class="hidden" accept="image/*">
                                <p id="imagem_redacao_filename" class="text-sm text-gray-600 mt-2"></p>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg">
                                Salvar Redação
                            </button>
                        </form>
                    </div>

                    <!-- Lista de Redações Salvas -->
                    <div>
                        <h3 class="text-2xl font-bold mb-6 text-center text-gray-800">Redações Armazenadas</h3>

                        @if ($redacoes->isEmpty())
                            <p class="text-center text-gray-500">Nenhuma redação cadastrada.</p>
                        @else
                            <div class="space-y-6">
                                @foreach ($redacoes as $redacao)
                                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all">
                                        <h4 class="font-bold text-xl text-gray-800">{{ $redacao->tema }}</h4>
                                        <p class="text-gray-500 text-sm mb-4">
                                            Enviado em {{ $redacao->created_at->format('d/m/Y H:i') }}
                                        </p>

                                        @if ($redacao->modo_envio === 'digitado')
                                            <p class="text-gray-700">{{ Str::limit($redacao->texto_redacao, 150) }}</p>
                                        @else
                                            <img src="{{ asset('storage/' . $redacao->imagem_redacao) }}" class="rounded-lg shadow-md max-h-48 mx-auto mb-4">
                                        @endif

                                        <div class="flex justify-between items-center mt-4">
                                            <button onclick="abrirModalEditar({{ $redacao->id }}, '{{ addslashes($redacao->tema) }}', '{{ $redacao->modo_envio }}', '{{ addslashes($redacao->texto_redacao ?? '') }}')" 
                                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-1">
                                                <i class="fa-solid fa-pen-to-square"></i> Editar
                                            </button>

                                            <form id="form-apagar-{{ $redacao->id }}" action="{{ route('redacoes.destroy', $redacao->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="abrirModalApagar({{ $redacao->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-1">
                                                    <i class="fa-solid fa-trash"></i> Apagar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Modal de Edição -->
                <div id="modal-editar" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
                    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md relative">
                        <button onclick="fecharModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
                        
                        <h2 class="text-2xl font-bold mb-6 text-center">Editar Redação</h2>

                        <form id="form-editar" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="editar_redacao_id" name="redacao_id">

                            <div>
                                <label for="editar_tema" class="block text-gray-700 mb-2 font-semibold">Tema</label>
                                <input type="text" id="editar_tema" name="tema" class="w-full p-3 border border-gray-300 rounded-lg" required>
                            </div>

                            <div>
                                <label for="editar_modo_envio" class="block text-gray-700 mb-2 font-semibold">Modo de Envio</label>
                                <select id="editar_modo_envio" name="modo_envio" class="w-full p-3 border border-gray-300 rounded-lg" required onchange="toggleEditarFields(this.value)">
                                    <option value="digitado">Digitado</option>
                                    <option value="imagem">Imagem</option>
                                </select>
                            </div>

                            <div id="editar_texto_redacao_div">
                                <label for="editar_texto_redacao" class="block text-gray-700 mb-2 font-semibold">Texto da Redação</label>
                                <textarea id="editar_texto_redacao" name="texto_redacao" rows="5" class="w-full p-3 border border-gray-300 rounded-lg"></textarea>
                            </div>

                            <div id="editar_imagem_redacao_div" style="display: none;">
                                <label for="editar_imagem_redacao" class="block text-gray-700 mb-2 font-semibold">Upload da Redação</label>
                                <input type="file" id="editar_imagem_redacao" name="imagem_redacao" class="w-full p-3 border border-gray-300 rounded-lg" accept="image/*">
                            </div>

                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg">
                                Atualizar Redação
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Modal de Exclusão -->
                <div id="modal-apagar" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
                    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md text-center relative">
                        <button onclick="fecharModalApagar()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
                        
                        <h2 class="text-xl font-bold mb-4">Confirmar Exclusão</h2>
                        <p class="text-gray-700 mb-6">Tem certeza que deseja apagar esta redação? Essa ação não poderá ser desfeita.</p>
                        
                        <div class="flex justify-center gap-4">
                            <button onclick="fecharModalApagar()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                                Cancelar
                            </button>
                            <button onclick="confirmarExclusao()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                                Apagar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // Manter os scripts que já foram fornecidos anteriormente aqui
    
    // Alterna campos com base no modo de envio selecionado
    document.getElementById('modo_envio').addEventListener('change', function () {
        const modo = this.value;
        document.getElementById('texto_redacao_div').style.display = modo === 'digitado' ? 'block' : 'none';
        document.getElementById('imagem_redacao_div').style.display = modo === 'imagem' ? 'block' : 'none';
    });

    // Mostrar nome do arquivo selecionado
    document.getElementById('imagem_redacao').addEventListener('change', function () {
        const fileName = this.files[0]?.name || 'Selecionar Arquivo';
        document.getElementById('imagem_redacao_label_text').innerText = fileName;
        document.getElementById('imagem_redacao_filename').innerText = fileName;
    });

    // Modal de edição
    function abrirModalEditar(id, tema, modo_envio, texto_redacao) {
        document.getElementById('modal-editar').classList.remove('hidden');
        document.getElementById('editar_redacao_id').value = id;
        document.getElementById('editar_tema').value = tema;
        document.getElementById('editar_modo_envio').value = modo_envio;
        document.getElementById('editar_texto_redacao').value = texto_redacao;

        toggleEditarFields(modo_envio);

        document.getElementById('form-editar').action = `/redacoes/${id}`;
    }

    function toggleEditarFields(modo) {
        document.getElementById('editar_texto_redacao_div').style.display = modo === 'digitado' ? 'block' : 'none';
        document.getElementById('editar_imagem_redacao_div').style.display = modo === 'imagem' ? 'block' : 'none';
    }

    function fecharModal() {
        document.getElementById('modal-editar').classList.add('hidden');
    }

    // Modal de exclusão
    let redacaoIdParaExcluir = null;

    function abrirModalApagar(id) {
        redacaoIdParaExcluir = id;
        document.getElementById('modal-apagar').classList.remove('hidden');
    }

    function fecharModalApagar() {
        redacaoIdParaExcluir = null;
        document.getElementById('modal-apagar').classList.add('hidden');
    }

    function confirmarExclusao() {
        if (redacaoIdParaExcluir) {
            document.getElementById(`form-apagar-${redacaoIdParaExcluir}`).submit();
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Principal
        const modoEnvio = document.getElementById('modo_envio');
        const textoDiv = document.getElementById('texto_redacao_div');
        const imagemDiv = document.getElementById('imagem_redacao_div');
        const inputImagem = document.getElementById('imagem_redacao');
        const labelTexto = document.getElementById('imagem_redacao_label_text');
        const fileNameOutput = document.getElementById('imagem_redacao_filename');

        function toggleCamposPrincipal() {
            if (modoEnvio.value === 'imagem') {
                textoDiv.style.display = 'none';
                imagemDiv.style.display = 'block';
            } else {
                textoDiv.style.display = 'block';
                imagemDiv.style.display = 'none';
            }
        }

        modoEnvio.addEventListener('change', toggleCamposPrincipal);
        toggleCamposPrincipal();

        inputImagem.addEventListener('change', function () {
            const fileName = this.files[0] ? this.files[0].name : 'Selecionar Arquivo';
            labelTexto.textContent = fileName;
            fileNameOutput.textContent = fileName;
        });

        // Modal editar
        const editarModoEnvio = document.getElementById('editar_modo_envio');
        const editarTextoDiv = document.getElementById('editar_texto_redacao_div');
        const editarImagemDiv = document.getElementById('editar_imagem_redacao_div');

        function toggleEditarFields(value) {
            if (value === 'imagem') {
                editarTextoDiv.style.display = 'none';
                editarImagemDiv.style.display = 'block';
            } else {
                editarTextoDiv.style.display = 'block';
                editarImagemDiv.style.display = 'none';
            }
        }

        window.abrirModalEditar = function (id, tema, modoEnvioValue, texto) {
            const modal = document.getElementById('modal-editar');
            modal.style.display = 'flex';

            document.getElementById('editar_redacao_id').value = id;
            document.getElementById('editar_tema').value = tema;
            document.getElementById('editar_modo_envio').value = modoEnvioValue;
            document.getElementById('editar_texto_redacao').value = texto;

            toggleEditarFields(modoEnvioValue);

            const form = document.getElementById('form-editar');
            form.action = `/redacoes/${id}`;
        }

        window.fecharModal = function () {
            document.getElementById('modal-editar').style.display = 'none';
        }

        // Modal apagar
        let idParaExcluir = null;

        window.abrirModalApagar = function (id) {
            idParaExcluir = id;
            document.getElementById('modal-apagar').style.display = 'flex';
        }

        window.fecharModalApagar = function () {
            document.getElementById('modal-apagar').style.display = 'none';
            idParaExcluir = null;
        }

        window.confirmarExclusao = function () {
            if (idParaExcluir) {
                document.getElementById(`form-apagar-${idParaExcluir}`).submit();
            }
        }
    });
</script>
@endsection
