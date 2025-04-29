@extends('layouts.app')

@section('content')
    <!-- Exibindo mensagem de erro ou sucesso -->
    @if(isset($mensagem))
        <div class="alert alert-info">
            {{ $mensagem }}
        </div>
    @endif

    <!-- Exibindo notícias -->
    @if(count($noticias) > 0)
        @foreach ($noticias as $noticia)
            <div class="noticia">
                <h3>{{ $noticia['title'] }}</h3>
                <p>{{ $noticia['description'] }}</p>
                <a href="{{ $noticia['url'] }}" target="_blank">Leia mais</a>
            </div>
        @endforeach
    @else
        <div class="alert alert-warning">
            Não há notícias disponíveis no momento.
        </div>
    @endif
@endsection
