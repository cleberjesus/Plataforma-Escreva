@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Minhas Conquistas</h1>
    @if($achievements->isEmpty())
        <p>Você ainda não desbloqueou nenhuma conquista.</p>
    @else
        <div class="row">
            @foreach($achievements as $achievement)
            <div class="col-md-4">
                <div class="card mb-3">
                    @if($achievement->icon)
                        <img src="{{ asset($achievement->icon) }}" class="card-img-top" alt="{{ $achievement->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $achievement->name }}</h5>
                        <p class="card-text">{{ $achievement->description }}</p>
                        @if($achievement->pivot->achieved_at)
                            <p class="card-text">
                                <small class="text-muted">
                                    Desbloqueada em: {{ \Carbon\Carbon::parse($achievement->pivot->achieved_at)->format('d/m/Y') }}
                                </small>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
