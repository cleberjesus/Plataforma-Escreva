@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Minhas Redações</h2>

    <!-- Formulário para envio de redação -->
    <form action="{{ route('redacoes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="tema" class="form-label">Tema da Redação</label>
            <input type="text" class="form-control" id="tema" name="tema" required>
        </div>

        <div class="mb-3">
            <label for="modo_envio" class="form-label">Modo de Envio</label>
            <select class="form-select" id="modo_envio" name="modo_envio" required>
                <option value="digitado">Digitado</option>
                <option value="imagem">Imagem</option>
            </select>
        </div>

        <div class="mb-3" id="texto_redacao_div">
            <label for="texto_redacao" class="form-label">Texto da Redação</label>
            <textarea class="form-control" id="texto_redacao" name="texto_redacao" rows="4"></textarea>
        </div>

        <div class="mb-3" id="imagem_redacao_div" style="display: none;">
            <label for="imagem_redacao" class="form-label">Upload da Redação</label>
            <input type="file" class="form-control" id="imagem_redacao" name="imagem_redacao" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Redação</button>
    </form>

    <hr>

    <!-- Listagem das redações salvas -->
    <h3>Redações Salvas</h3>
    @if ($redacoes->isEmpty())
        <p>Nenhuma redação cadastrada.</p>
    @else
        <ul class="list-group">
            @foreach ($redacoes as $redacao)
                <li class="list-group-item">
                    <strong>Tema:</strong> {{ $redacao->tema }} <br>
                    <strong>Enviado em:</strong>
                    <span>{{ \Carbon\Carbon::parse($redacao->created_at)->format('d/m/Y H:i') }}</span>
                    <br>

                    @if ($redacao->modo_envio === 'digitado')
                        <p>{{ $redacao->texto_redacao }}</p>
                    @else
                        <img src="{{ asset('storage/' . $redacao->imagem_redacao) }}" alt="Redação enviada" class="img-fluid" style="max-width: 400px;">
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>

<script>
    document.getElementById('modo_envio').addEventListener('change', function () {
        if (this.value === 'digitado') {
            document.getElementById('texto_redacao_div').style.display = 'block';
            document.getElementById('imagem_redacao_div').style.display = 'none';
        } else {
            document.getElementById('texto_redacao_div').style.display = 'none';
            document.getElementById('imagem_redacao_div').style.display = 'block';
        }
    });
</script>
@endsection
