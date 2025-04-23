@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Meu Cronograma</h2>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('cronograma.store') }}" method="POST">
        @csrf
        <div>
            <label>Título:</label>
            <input type="text" name="titulo" required>
        </div>

        <div>
            <label>Início:</label>
            <input type="date" name="inicio" required>
        </div>

        <div>
            <label>Fim (opcional):</label>
            <input type="date" name="fim">
        </div>

        <div>
            <label>Dias da Semana:</label><br>
            @foreach(['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo'] as $dia)
                <label><input type="checkbox" name="dias_da_semana[]" value="{{ $dia }}"> {{ ucfirst($dia) }}</label>
            @endforeach
        </div>

        <button type="submit">Criar Cronograma</button>
    </form>

    <hr>

    @if($cronogramas->count())
        <ul>
            @foreach($cronogramas as $cronograma)
                <li>
                    <strong>{{ $cronograma->titulo }}</strong><br>
                    Dias: {{ implode(', ', $cronograma->dias_da_semana) }}<br>
                    De {{ $cronograma->inicio->format('d/m/Y') }} até {{ $cronograma->fim?->format('d/m/Y') ?? 'sem fim' }}
                    <form action="{{ route('cronograma.destroy', $cronograma->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>Você ainda não tem cronogramas.</p>
    @endif
</div>
@endsection
