@extends('layouts.app')

@section('title', 'Quiz Interativo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/quiz.css') }}">
@endpush

@section('content')
<div class="quiz-container-bg">
    <div class="container mx-auto py-8">
        <div class="quiz-card">
            <div class="quiz-header">
                <h2 id="question-text">Carregando pergunta...</h2>
            </div>
            <div id="answer-buttons" class="quiz-body">
                {{-- Os botões de resposta serão inseridos aqui pelo JavaScript --}}
            </div>
            <div class="quiz-footer">
                <div id="feedback-text" class="feedback"></div>
                <button id="next-btn" class="next-button" style="display: none;">Próxima</button>
            </div>
            <div id="results-container" class="results-container" style="display: none;">
                <h3 id="score-text"></h3>
                <button id="restart-btn" class="restart-button">Tentar Novamente</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/quiz.js') }}"></script>
@endpush 