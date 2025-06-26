<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    AssinaturaController,
    CorrecaoController,
    SimuladoCoringaController,
    SimuladoComumController,
    RedacaoController,
    LeiaController,
    CronogramaController,
    CronogramaAtividadeController,
    QuizController,
    GraficoController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Páginas públicas
Route::get('/', fn () => view('welcome'));
Route::get('/termos-de-servico', fn () => view('terms'))->name('terms');
Route::get('/dashboard', fn () => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

// Autenticado
Route::middleware('auth')->group(function () {
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Assinatura
    Route::get('/assinar', [AssinaturaController::class, 'assinar'])->name('assinar.premium');

    // Cronograma e atividades
    Route::prefix('cronograma')->group(function () {
        Route::get('/', [CronogramaController::class, 'index'])->name('cronograma.index');
        Route::post('/', [CronogramaController::class, 'store'])->name('cronograma.store');
        Route::delete('/{cronograma}', [CronogramaController::class, 'destroy'])->name('cronograma.destroy');

        Route::get('{cronograma}/atividades', [CronogramaAtividadeController::class, 'index'])->name('cronograma.atividades.index');
        Route::post('{cronograma}/atividades', [CronogramaAtividadeController::class, 'store'])->name('cronograma.atividades.store');
        Route::delete('{cronograma}/atividades/{atividade}', [CronogramaAtividadeController::class, 'destroy'])->name('cronograma.atividades.destroy');
    });

    // Redações (apenas resource, sem duplicidade)
    Route::resource('redacoes', RedacaoController::class);
    Route::post('/redacoes/{id}/correcao', [CorrecaoController::class, 'resultado'])->name('redacoes.correcao');
    Route::post('/resultado', [CorrecaoController::class, 'store'])->name('resultado.store');

    // Gráficos
    Route::get('/graficos/redacoes-por-mes', [GraficoController::class, 'redacoesPorMes'])->name('graficos.redacoes');

    // Quiz
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
});

// Simulado Coringa
Route::prefix('simulado-coringa')->group(function () {
    Route::get('/', [SimuladoCoringaController::class, 'index'])->name('simulado-coringa');
    Route::get('/gerar-tema', [SimuladoCoringaController::class, 'gerarTema'])->name('simulado-coringa.gerarTema');
    Route::post('/salvar-redacao', [SimuladoCoringaController::class, 'salvarRedacao'])->name('simulado-coringa.salvarRedacao');
    Route::post('/finalizar', [SimuladoCoringaController::class, 'finalizarSimulado'])->name('simulado-coringa.finalizar');
    Route::post('/iniciar', [SimuladoCoringaController::class, 'iniciar'])->name('simulado.iniciar');
});

// Simulado Comum
Route::get('/simulado-comum', [SimuladoComumController::class, 'index'])->name('simulado-comum');

// Página de um tema específico
Route::get('/simulado/{slug}', [SimuladoComumController::class, 'mostrarTema'])->name('simulado.tema');

Route::get('/assinatura/sucesso', [AssinaturaController::class, 'sucesso'])->name('assinatura.sucesso');

// Auth scaffolding
require __DIR__ . '/auth.php';
