@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-4">
        <h2 class="mb-4 text-center fw-bold text-white">
            {{ isset($redacaoEditando) ? 'Editar Redação' : 'Nova Redação' }}
        </h2>

        <form action="{{ route('redacoes.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            @if (isset($redacaoEditando))
                <input type="hidden" name="redacao_id" value="{{ $redacaoEditando->id }}">
            @endif

            <div class="mb-3">
                <label for="tema" class="form-label fw-bold text-white">Tema da Redação</label>
                <input type="text" class="form-control" id="tema" name="tema" required
                    value="{{ old('tema', $redacaoEditando->tema ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="modo_envio" class="form-label fw-bold text-white">Modo de Envio</label>
                <select class="form-select" id="modo_envio" name="modo_envio" required>
                    <option value="digitado" {{ old('modo_envio', $redacaoEditando->modo_envio ?? '') == 'digitado' ? 'selected' : '' }}>Digitado</option>
                    <option value="imagem" {{ old('modo_envio', $redacaoEditando->modo_envio ?? '') == 'imagem' ? 'selected' : '' }}>Imagem</option>
                </select>
            </div>

            <div class="mb-3" id="texto_redacao_div">
                <label for="texto_redacao" class="form-label fw-bold text-white">Texto da Redação</label>
                <textarea class="form-control" id="texto_redacao" name="texto_redacao" rows="5">{{ old('texto_redacao', $redacaoEditando->texto_redacao ?? '') }}</textarea>
            </div>

            <div class="mb-3" id="imagem_redacao_div">
                <label for="imagem_redacao" class="form-label fw-bold text-white">Upload da Redação</label>
                <input type="file" class="form-control" id="imagem_redacao" name="imagem_redacao" accept="image/*">
                @if (isset($redacaoEditando) && $redacaoEditando->imagem_redacao)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $redacaoEditando->imagem_redacao) }}" class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100">
                {{ isset($redacaoEditando) ? 'Atualizar Redação' : 'Salvar Redação' }}
            </button>
        </form>
    </div>

    <hr>

    <div class="mt-4">
        <h3 class="text-center mb-4 fw-bold text-white">Redações Salvas</h3>
        @if ($redacoes->isEmpty())
            <p class="text-muted text-center">Nenhuma redação cadastrada.</p>
        @else
            <div class="row">
                @foreach ($redacoes as $redacao)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-lg p-3 rounded-4 bg-dark text-white">
                            <div class="card-body">
                                <h5 class="fw-bold">Tema: {{ $redacao->tema }}</h5>
                                <p class="text-muted">Enviado em: {{ $redacao->created_at->format('d/m/Y H:i') }}</p>

                                @if ($redacao->modo_envio === 'digitado')
                                    <p>{{ $redacao->texto_redacao }}</p>
                                @else
                                    <img src="{{ asset('storage/' . $redacao->imagem_redacao) }}" class="img-fluid rounded-3 shadow-sm" alt="Redação imagem">
                                @endif

                                <!-- Botões -->
                                <div class="d-flex justify-content-between mt-3">
                                    <!-- Editar -->
                                    <a href="{{ route('redacoes.index', ['edit' => $redacao->id]) }}" class="btn btn-sm btn-warning d-flex align-items-center gap-1">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </a>

                                    <!-- Apagar -->
                                    <form action="{{ route('redacoes.destroy', $redacao->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar esta redação?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center gap-1">
                                            <i class="fa-solid fa-trash"></i> Apagar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Mostrar/esconder campos -->
<script>
    function toggleFields(value) {
        document.getElementById('texto_redacao_div').style.display = value === 'digitado' ? 'block' : 'none';
        document.getElementById('imagem_redacao_div').style.display = value === 'imagem' ? 'block' : 'none';
    }

    const selectModoEnvio = document.getElementById('modo_envio');
    if (selectModoEnvio) {
        toggleFields(selectModoEnvio.value);
        selectModoEnvio.addEventListener('change', function () {
            toggleFields(this.value);
        });
    }
</script>
@endsection
