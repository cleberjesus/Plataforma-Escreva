<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimuladoCoringaController;
use App\Http\Controllers\SimuladoComumController;
use App\Http\Controllers\RedacaoController;

// Página inicial
Route::get('/', function () {
    return view('welcome');
});

// Dashboard com autenticação
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
});

// Rotas de Simulado Coringa
Route::get('/simulado-coringa', [SimuladoCoringaController::class, 'index'])->name('simulado-coringa');
// Rota para exibir o índice do simulado
Route::get('/simulado', [SimuladoCoringaController::class, 'index'])->name('simulado.index');

Route::get('/simulado-coringa/gerar-tema', [SimuladoCoringaController::class, 'gerarTema'])->name('simulado-coringa.gerarTema');
Route::get('/simulado-coringa/finalizar', [SimuladoCoringaController::class, 'finalizarSimulado'])->name('simulado-coringa.finalizar');

// Rotas de Simulado Comum
Route::get('/simulado-comum', [SimuladoComumController::class, 'index'])->name('simulado-comum');

// Rotas de Redação
Route::get('/redacoes', [RedacaoController::class, 'index'])->name('redacoes.index');
Route::post('/redacoes', [RedacaoController::class, 'store'])->name('redacoes.store');

// Iniciar o simulado (agora usando o controlador correto)
Route::post('/simulado/iniciar', [SimuladoCoringaController::class, 'iniciar'])->name('simulado.iniciar');

// Importação das rotas de autenticação
require __DIR__.'/auth.php';
