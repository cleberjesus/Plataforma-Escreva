@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Meu Cronograma</h2>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif

    {{-- Formulário de criação de cronograma --}}
    <form action="{{ route('cronograma.store') }}" method="POST" style="margin-bottom: 30px; padding: 15px; border: 1px solid #ccc; border-radius: 10px;">
        @csrf
        <div style="margin-bottom: 10px;">
            <label><strong>Título:</strong></label><br>
            <input type="text" name="titulo" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 10px;">
            <label><strong>Início:</strong></label><br>
            <input type="date" name="inicio" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label><strong>Fim (opcional):</strong></label><br>
            <input type="date" name="fim">
        </div>

        <div style="margin-bottom: 10px;">
            <label><strong>Dias da Semana:</strong></label><br>
            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                @foreach(['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo'] as $dia)
                    <label>
                        <input type="checkbox" name="dias_da_semana[]" value="{{ $dia }}"> {{ ucfirst($dia) }}
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit">Criar Cronograma</button>
    </form>

    <hr>

    {{-- Listagem dos cronogramas --}}
    @if($cronogramas->count())
        @foreach($cronogramas as $cronograma)
            <div style="margin-bottom: 40px; border-bottom: 1px solid #ddd; padding-bottom: 20px;">
                <h4>{{ $cronograma->titulo }}</h4>
                <p>
                    <strong>Dias:</strong> {{ implode(', ', $cronograma->dias_da_semana) }}<br>
                    <strong>De:</strong> {{ \Carbon\Carbon::parse($cronograma->inicio)->format('d/m/Y') }} 
                    <strong>até</strong> {{ $cronograma->fim ? \Carbon\Carbon::parse($cronograma->fim)->format('d/m/Y') : 'sem fim' }}
                </p>

                {{-- Botão excluir cronograma --}}
                <form action="{{ route('cronograma.destroy', $cronograma->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Deseja excluir este cronograma?')">Excluir</button>
                </form>

                {{-- Formulário de marcação de dias concluídos com checkbox --}}
                <form action="{{ route('cronograma.atividades.store', $cronograma->id) }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    <label><strong>Marcar dias concluídos:</strong></label><br>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                        @php
                            $inicio = \Carbon\Carbon::parse($cronograma->inicio);
                            $fim = $cronograma->fim ? \Carbon\Carbon::parse($cronograma->fim) : \Carbon\Carbon::now()->addMonths(1);
                            $diasSelecionados = $cronograma->dias_da_semana;
                            $diasJaMarcados = $cronograma->atividades->pluck('data')->toArray();
                            $mapaSemana = [
                                'domingo' => 0,
                                'segunda' => 1,
                                'terca' => 2,
                                'quarta' => 3,
                                'quinta' => 4,
                                'sexta' => 5,
                                'sabado' => 6
                            ];
                            $diasParaMarcar = [];
                        @endphp

                        @for ($data = $inicio->copy(); $data <= $fim; $data->addDay())
                            @php
                                $diaSemana = $data->dayOfWeek;
                                $nomeDia = array_search($diaSemana, $mapaSemana);
                            @endphp
                            @if(in_array($nomeDia, $diasSelecionados) && !in_array($data->toDateString(), $diasJaMarcados))
                                <label>
                                    <input type="checkbox" name="datas[]" value="{{ $data->toDateString() }}">
                                    {{ $data->format('d/m/Y') }} ({{ ucfirst($nomeDia) }})
                                </label>
                            @endif
                        @endfor
                    </div>

                    <button type="submit" style="margin-top: 10px;">Salvar Concluídos</button>
                </form>

                {{-- Dias concluídos --}}
                @if($cronograma->atividades->count())
                    <div style="margin-top: 15px;">
                        <strong>Dias concluídos:</strong>
                        <ul style="margin-left: 20px;">
                            @foreach($cronograma->atividades as $atividade)
                                @if($atividade->concluido)
                                    <li>
                                        {{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y') }}
                                        <form action="{{ route('cronograma.atividades.destroy', [$cronograma->id, $atividade->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Remover este dia?')">Remover</button>
                                        </form>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <p>Você ainda não tem cronogramas.</p>
    @endif
</div>
@endsection
