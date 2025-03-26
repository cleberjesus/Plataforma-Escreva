<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimuladoCoringaController;
use App\http\Controllers\SimuladoComumController;
use App\Http\Controllers\RedacaoController;
use App\Http\Controllers\RankingController;

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
    Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');
    Route::get('/minhas-conquistas', [AchievementsController::class, 'index'])->name('achievements.index');
    
});


Route::get('/simulado-coringa', [SimuladoCoringaController::class, 'index'])->name('simulado-coringa');
Route::get('/simulado-coringa/gerar-tema', [SimuladoCoringaController::class, 'gerarTema'])->name('simulado-coringa.gerarTema');

Route::get('/simulado/finalizar', [SimuladoCoringaController::class, 'finalizarSimulado'])->name('simulado.finalizar');
Route::get('/simulado-comum', [SimuladoComumController::class, 'index'])->name('simulado-comum');


Route::get('/redacoes', [RedacaoController::class, 'index'])->name('redacoes.index');
Route::post('/redacoes', [RedacaoController::class, 'store'])->name('redacoes.store');

require __DIR__.'/auth.php';
