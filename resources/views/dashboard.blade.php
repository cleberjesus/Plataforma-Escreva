@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Seja bem-vindo, ') }} {{ Auth::user()->name ?? 'Usuário' }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensagem padrão --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Você está logado!") }}
                </div>
            </div>

            {{-- Seção de Plano Premium --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Plano Premium</h3>
                    <p class="mb-4">Acesse a inteligência artificial de forma ilimitada para melhorar suas redações e desbloquear recursos exclusivos.</p>
                    <p class="mb-4 font-semibold">R$ 9,90 / mês</p>
                    
                    <a href="{{ route('assinar.premium') }}"
                       class="inline-block px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow">
                        Assinar agora
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
