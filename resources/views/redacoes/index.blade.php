@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-4">
        <h2 class="mb-4 text-center fw-bold">Minhas Redações</h2>
        <form action="{{ route('redacoes.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="tema" class="form-label fw-bold">Tema da Redação</label>
                <input type="text" class="form-control" id="tema" name="tema" required>
            </div>

            <div class="mb-3">
                <label for="modo_envio" class="form-label fw-bold">Modo de Envio</label>
                <select class="form-select" id="modo_envio" name="modo_envio" required>
                    <option value="digitado">Digitado</option>
                    <option value="imagem">Imagem</option>
                </select>
            </div>

            <div class="mb-3" id="texto_redacao_div">
                <label for="texto_redacao" class="form-label fw-bold">Texto da Redação</label>
                <textarea class="form-control" id="texto_redacao" name="texto_redacao" rows="5"></textarea>
            </div>

            <div class="mb-3" id="imagem_redacao_div" style="display: none;">
                <label for="imagem_redacao" class="form-label fw-bold">Upload da Redação</label>
                <input type="file" class="form-control" id="imagem_redacao" name="imagem_redacao" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary w-100">Salvar Redação</button>
        </form>
    </div>

    <hr>

    <div class="mt-4">
        <h3 class="text-center mb-4 fw-bold">Redações Salvas</h3>
        @if ($redacoes->isEmpty())
            <p class="text-muted text-center">Nenhuma redação cadastrada.</p>
        @else
            <div class="row">
                @foreach ($redacoes as $redacao)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-lg p-3 rounded-4">
                            <div class="card-body">
                                <h5 class="fw-bold">Tema: {{ $redacao->tema }}</h5>
                                <p class="text-muted">Enviado em: {{ \Carbon\Carbon::parse($redacao->created_at)->format('d/m/Y H:i') }}</p>
                                @if ($redacao->modo_envio === 'digitado')
                                    <p class="text-dark">{{ $redacao->texto_redacao }}</p>
                                @else
                                    <img src="{{ asset('storage/' . $redacao->imagem_redacao) }}" alt="Redação enviada" class="img-fluid rounded-3 shadow-sm" style="max-width: 100%;">
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
    document.getElementById('modo_envio').addEventListener('change', function () {
        document.getElementById('texto_redacao_div').style.display = this.value === 'digitado' ? 'block' : 'none';
        document.getElementById('imagem_redacao_div').style.display = this.value === 'imagem' ? 'block' : 'none';
    });
</script>
@endsection
