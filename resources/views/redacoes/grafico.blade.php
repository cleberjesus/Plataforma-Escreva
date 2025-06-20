@extends('layouts.app')

@section('title', 'Gráfico de Redações - Escreva')

@section('header')
    {{-- Cabeçalho responsivo: empilha em telas pequenas e alinha em maiores --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-chart-line mr-2"></i>
            Gráfico de Redações por Mês
        </h2>
        {{-- Botão responsivo: ocupa a largura total em telas pequenas --}}
        <a href="{{ route('redacoes.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto text-center transition-all">
            <i class="fas fa-arrow-left mr-2"></i>
            Voltar
        </a>
    </div>
@endsection

@section('content')
{{-- Padding responsivo para o container principal --}}
<div class="py-8 sm:py-12">
    {{-- Adicionado padding horizontal em telas pequenas --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            {{-- Padding responsivo para o conteúdo do card --}}
            <div class="p-4 sm:p-6 text-gray-900">
                <!-- Card de estatísticas: já responsivo com grid-cols-1 md:grid-cols-3 -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-white bg-opacity-20">
                                <i class="fas fa-file-alt text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm opacity-90">Total de Redações</p>
                                <p class="text-2xl font-bold">{{ array_sum($dados) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg shadow-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-white bg-opacity-20">
                                <i class="fas fa-calendar-alt text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm opacity-90">Meses Ativos</p>
                                <p class="text-2xl font-bold">{{ count($dados) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-lg shadow-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-white bg-opacity-20">
                                <i class="fas fa-chart-bar text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm opacity-90">Média por Mês</p>
                                <p class="text-2xl font-bold">{{ count($dados) > 0 ? round(array_sum($dados) / count($dados), 1) : 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gráfico -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 sm:p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-chart-area mr-2 text-blue-500"></i>
                        Evolução de Redações por Mês
                    </h3>
                    
                    @if(count($dados) > 0)
                        {{-- Altura responsiva para o container do gráfico --}}
                        <div class="relative h-80 md:h-96">
                            <canvas id="redacoesChart"></canvas>
                        </div>
                        
                        <!-- Legenda -->
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-semibold text-gray-700 mb-2">Dados do Gráfico:</h4>
                            {{-- Grid da legenda com mais breakpoints para melhor responsividade --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                @foreach($labels as $index => $label)
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-2 flex-shrink-0"></div>
                                        <span class="text-sm text-gray-600">{{ $label }}: <strong>{{ $dados[$index] }}</strong></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        {{-- Conteúdo do estado de vazio com fontes responsivas --}}
                        <div class="text-center py-12">
                            <i class="fas fa-chart-line text-5xl sm:text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-500 mb-2">Nenhuma redação encontrada</h3>
                            <p class="text-gray-400 mb-6 px-4">Comece a escrever para ver seu progresso no gráfico!</p>
                            <a href="{{ route('redacoes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-all">
                                <i class="fas fa-plus mr-2"></i>
                                Criar Redação
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if(count($dados) > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('redacoesChart').getContext('2d');
    
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Redações por Mês',
                data: @json($dados),
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgb(59, 130, 246)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        title: function(context) {
                            return context[0].label;
                        },
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += context.parsed.y + ' redações';
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(200, 200, 200, 0.2)',
                        drawBorder: false
                    },
                    ticks: {
                        stepSize: 1,
                        color: '#6B7280'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6B7280'
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
});
</script>
@endif
@endpush 