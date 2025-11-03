@extends('layouts.app')

@section('title', 'Editar Redação')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-4 lg:px-8">
        <x-back-button url="{{ route('redacoes.index') }}" />

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 sm:p-10">
                <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Editar Redação</h2>

                <form action="{{ route('redacoes.update', $redacao->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="tema" class="block text-gray-700 mb-2 font-semibold">Tema</label>
                        <input type="text" id="tema" name="tema" class="w-full p-3 border border-gray-300 rounded-lg" required value="{{ old('tema', $redacao->tema) }}">
                    </div>

                    <div>
                        <label for="modo_envio" class="block text-gray-700 mb-2 font-semibold">Modo de Envio</label>
                        <select id="modo_envio" name="modo_envio" class="w-full p-3 border border-gray-300 rounded-lg" required>
                            <option value="digitado" {{ old('modo_envio', $redacao->modo_envio) == 'digitado' ? 'selected' : '' }}>Digitado</option>
                            <option value="imagem" {{ old('modo_envio', $redacao->modo_envio) == 'imagem' ? 'selected' : '' }}>Imagem</option>
                        </select>
                    </div>

                    <div id="texto_redacao_div">
                        <label for="texto_redacao" class="block text-gray-700 mb-2 font-semibold">Texto da Redação</label>
                        <textarea
                            id="texto_redacao"
                            name="texto_redacao"
                            rows="12"
                            class="w-full p-4 border border-gray-300 rounded-lg bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-base leading-relaxed resize-y transition"
                            placeholder="Escreva aqui sua redação. Lembre-se de organizar sua introdução, desenvolvimento e conclusão."
                        >{{ old('texto_redacao', $redacao->texto_redacao) }}</textarea>
                        <p class="text-sm text-gray-500 mt-2">Dica: organize seu texto com clareza e revise a gramática antes de salvar.</p>
                    </div>



                    <div id="imagem_redacao_div" style="display: none;">
                        <label for="imagem_redacao" class="block text-gray-700 mb-2 font-semibold">Upload da Redação</label>
                        @if ($redacao->imagem_redacao)
                            <div class="mb-2 flex justify-center">
                                <img src="{{ asset('storage/' . $redacao->imagem_redacao) }}" class="rounded-lg shadow-md max-h-48">
                                <p class="text-sm text-gray-600 mt-1">Imagem atual</p>
                            </div>
                        @endif
                        <label for="imagem_redacao" class="flex items-center justify-center gap-2 cursor-pointer w-full p-3 border-dashed border-2 border-gray-400 rounded-lg bg-gray-100 hover:bg-gray-200">
                            <i class="fa-solid fa-upload text-blue-600"></i>
                            <span id="imagem_redacao_label_text">Selecionar Arquivo</span>
                        </label>
                        <input type="file" id="imagem_redacao" name="imagem_redacao" class="hidden" accept="image/*">
                        <p id="imagem_redacao_filename" class="text-sm text-gray-600 mt-2"></p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="{{ route('redacoes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold w-full sm:w-auto text-center">Voltar</a>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold w-full sm:w-auto">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Alterna campos com base no modo de envio selecionado
    document.addEventListener('DOMContentLoaded', function () {
        const modoEnvio = document.getElementById('modo_envio');
        const textoDiv = document.getElementById('texto_redacao_div');
        const imagemDiv = document.getElementById('imagem_redacao_div');
        const inputImagem = document.getElementById('imagem_redacao');
        const labelTexto = document.getElementById('imagem_redacao_label_text');
        const fileNameOutput = document.getElementById('imagem_redacao_filename');

        function toggleCampos() {
            if (modoEnvio.value === 'imagem') {
                textoDiv.style.display = 'none';
                imagemDiv.style.display = 'block';
            } else {
                textoDiv.style.display = 'block';
                imagemDiv.style.display = 'none';
            }
        }

        modoEnvio.addEventListener('change', toggleCampos);
        toggleCampos();

        inputImagem.addEventListener('change', function () {
            const fileName = this.files[0] ? this.files[0].name : 'Selecionar Arquivo';
            labelTexto.textContent = fileName;
            fileNameOutput.textContent = fileName;
        });
    });
</script>
@endsection 