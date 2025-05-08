@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-100 ">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Mensagem padrão --}}
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
                <p class="text-lg font-medium text-gray-700 dark:text-gray-200">
                    {{ __("✅ Você está logado!") }}
                </p>
            </div>

            {{-- Seção de Plano Premium --}}
            <div class="bg-gradient-to-r from-indigo-700 to-blue-700 text-white shadow-xl rounded-xl p-8">
                <h3 class="text-3xl font-bold mb-3">Plano Premium</h3>
                <p class="mb-3 text-lg">Acesse a inteligência artificial de forma <strong>ilimitada</strong> para melhorar suas redações e desbloquear recursos exclusivos.</p>
                <p class="mb-6 text-xl font-semibold">R$ 9,90 <span class="text-base font-normal">/ mês</span></p>
                
                <a href="{{ route('assinar.premium') }}"
                   class="inline-block bg-white text-indigo-700 font-semibold px-6 py-2 rounded-lg shadow hover:bg-gray-100 transition duration-300">
                    Assinar agora
                </a>
            </div>

        </div>
    </div>
@endsection

