<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    AssinaturaController,
    SimuladoCoringaController,
    SimuladoComumController,
    RedacaoController,
    LeiaController,
    CronogramaController,
    CronogramaAtividadeController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Páginas públicas
Route::get('/', fn () => view('welcome'));
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
});

// Simulado Coringa
Route::prefix('simulado-coringa')->group(function () {
    Route::get('/', [SimuladoCoringaController::class, 'index'])->name('simulado-coringa');
    Route::get('/gerar-tema', [SimuladoCoringaController::class, 'gerarTema'])->name('simulado-coringa.gerarTema');
    Route::get('/finalizar', [SimuladoCoringaController::class, 'finalizarSimulado'])->name('simulado-coringa.finalizar');
    Route::post('/iniciar', [SimuladoCoringaController::class, 'iniciar'])->name('simulado.iniciar');
});

// Simulado Comum
Route::get('/simulado-comum', [SimuladoComumController::class, 'index'])->name('simulado-comum');
Route::get('/simulado/{tema}', [SimuladoComumController::class, 'mostrarTema'])->name('simulado.tema');

// Redações
Route::prefix('redacoes')->group(function () {
    Route::get('/', [RedacaoController::class, 'index'])->name('redacoes.index');
    Route::post('/', [RedacaoController::class, 'store'])->name('redacoes.store');
    Route::get('/{id}/edit', [RedacaoController::class, 'edit'])->name('redacoes.edit');
    Route::put('/{id}', [RedacaoController::class, 'update'])->name('redacoes.update');
    Route::delete('/{id}', [RedacaoController::class, 'destroy'])->name('redacoes.destroy');
});

// Leituras
Route::get('/leituras', [LeiaController::class, 'mostrarLeituras'])->name('leituras');

// Auth scaffolding
require __DIR__ . '/auth.php';
