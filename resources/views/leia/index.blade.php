@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-back-button />
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
        </div>
    </div>
</div>
@endsection
