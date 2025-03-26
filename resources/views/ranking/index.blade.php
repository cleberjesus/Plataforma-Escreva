@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">🏆 Ranking dos Usuários 🏆</h2>

    @if($users->isEmpty())
        <p class="text-center text-muted">Ainda não há redações suficientes para um ranking.</p>
    @else
        <div class="table-responsive">
            <table class="table table-dark table-striped text-center">
                <thead class="thead-light">
                    <tr>
                        <th>🏅 Posição</th>
                        <th>👤 Nome</th>
                        <th>✍️ Redações Enviadas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td class="fw-bold">
                                @if($index == 0) 🥇 @elseif($index == 1) 🥈 @elseif($index == 2) 🥉 @else {{ $index + 1 }}° @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->redacoes_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
