<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimuladoCoringaController;
use App\http\Controllers\SimuladoComumController;

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
Route::get('/simulado-coringa/gerar-tema', [SimuladoCoringaController::class, 'gerarTema'])->name('simulado-coringa.gerarTema');
Route::get('/simulado/finalizar', [SimuladoCoringaController::class, 'finalizarSimulado'])->name('simulado.finalizar');
Route::get('/simulado-comum', [SimuladoComumController::class, 'index'])->name('simulado-comum'); 


require __DIR__.'/auth.php';
