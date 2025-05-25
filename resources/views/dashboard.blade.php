@extends('layouts.app')

@section('title', 'Painel')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Header com boas-vindas --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Bem-vindo(a), {{ Auth::user()->name }}! 👋</h1>
            <p class="mt-2 text-gray-600">Acompanhe seu progresso e continue melhorando suas redações.</p>
        </div>

      
        {{-- Seção de Plano Premium --}}
        <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl shadow-xl overflow-hidden">
            <div class="px-8 py-12 sm:px-12 lg:px-16">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-8 md:mb-0 md:mr-8">
                        <h3 class="text-3xl font-bold text-white mb-4">Escreva PLUS</h3>
                        <p class="text-lg text-indigo-100 mb-6">Desbloqueie todo o potencial da plataforma com recursos exclusivos:</p>
                        <ul class="space-y-3 text-indigo-100">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Correção ilimitada de redações
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Sugestões personalizadas
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Acesso a todos os temas
                            </li>
                        </ul>
                    </div>
                    <div class="text-center md:text-right">
                        <p class="text-4xl font-bold text-white mb-2">R$ 9,90</p>
                        <p class="text-indigo-100 mb-6">/ mês</p>
                        <a href="{{ route('assinar.premium') }}"
                           class="inline-block bg-white text-indigo-600 font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300">
                            Assinar agora
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Seção de Dicas Rápidas --}}
        <div class="mt-8 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Dicas Rápidas</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="p-4 bg-blue-50 rounded-lg">
                    <h4 class="font-medium text-blue-900 mb-2">Estrutura da Redação</h4>
                    <p class="text-sm text-blue-700">Lembre-se de incluir introdução, desenvolvimento e conclusão em suas redações.</p>
                </div>
                <div class="p-4 bg-green-50 rounded-lg">
                    <h4 class="font-medium text-green-900 mb-2">Tempo</h4>
                    <p class="text-sm text-green-700">Reserve 5 minutos para planejar sua redação antes de começar a escrever.</p>
                </div>
                <div class="p-4 bg-purple-50 rounded-lg">
                    <h4 class="font-medium text-purple-900 mb-2">Argumentação</h4>
                    <p class="text-sm text-purple-700">Use dados e exemplos concretos para fortalecer seus argumentos.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

