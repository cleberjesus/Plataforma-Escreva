<?php

use App\Http\Controllers\AssinaturaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimuladoCoringaController;
use App\Http\Controllers\SimuladoComumController;
use App\Http\Controllers\RedacaoController;
use App\Http\Controllers\LeiaController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\CronogramaAtividadeController;




Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
});


Route::get('/simulado-coringa', [SimuladoCoringaController::class, 'index'])->name('simulado-coringa');

Route::get('/simulado', [SimuladoCoringaController::class, 'index'])->name('simulado.index');

Route::get('/simulado-coringa/gerar-tema', [SimuladoCoringaController::class, 'gerarTema'])->name('simulado-coringa.gerarTema');
Route::get('/simulado-coringa/finalizar', [SimuladoCoringaController::class, 'finalizarSimulado'])->name('simulado-coringa.finalizar');


Route::get('/simulado-comum', [SimuladoComumController::class, 'index'])->name('simulado-comum');

Route::get('/redacoes', [RedacaoController::class, 'index'])->name('redacoes.index');
Route::post('/redacoes', [RedacaoController::class, 'store'])->name('redacoes.store');


Route::post('/simulado/iniciar', [SimuladoCoringaController::class, 'iniciar'])->name('simulado.iniciar');

Route::middleware(['auth'])->group(function () {
    Route::get('/assinar', [AssinaturaController::class, 'assinar'])->name('assinar.premium');
});

require __DIR__.'/auth.php';

Route::get('/redacoes', [RedacaoController::class, 'index'])->name('redacoes.index');
Route::post('/redacoes', [RedacaoController::class, 'store'])->name('redacoes.store');
Route::delete('/redacoes/{id}', [RedacaoController::class, 'destroy'])->name('redacoes.destroy');

Route::get('/redacoes/{id}/edit', [RedacaoController::class, 'edit'])->name('redacoes.edit');
Route::put('/redacoes/{id}', [RedacaoController::class, 'update'])->name('redacoes.update');


Route::get('/leituras', [LeiaController::class, 'mostrarLeituras'])
     ->name('leituras');

     Route::middleware('auth')->prefix('cronograma')->group(function () {
        // CRUD do cronograma
        Route::get('/', [CronogramaController::class, 'index'])->name('cronograma.index');
        Route::post('/', [CronogramaController::class, 'store'])->name('cronograma.store');
        Route::delete('/{cronograma}', [CronogramaController::class, 'destroy'])->name('cronograma.destroy');
    
        // Atividades relacionadas
        Route::get('{cronograma}/atividades', [CronogramaAtividadeController::class, 'index'])
            ->name('cronograma.atividades.index');
        Route::post('{cronograma}/atividades', [CronogramaAtividadeController::class, 'store'])
            ->name('cronograma.atividades.store');
        Route::delete('{cronograma}/atividades/{atividade}', [CronogramaAtividadeController::class, 'destroy'])
            ->name('cronograma.atividades.destroy');
    });
    