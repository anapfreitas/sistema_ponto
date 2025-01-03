<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui você pode registrar as rotas do sistema.
|
*/

// Página inicial (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// Rota para o dashboard (acessível apenas para usuários autenticados e verificados)
Route::get('/dashboard', function () {
    return view('dashboard'); // Ajustado para o caminho correto
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Rotas de Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas de Usuários (apenas para administradores)
    Route::resource('/users', UserController::class)->middleware('role:admin');
});

require __DIR__ . '/auth.php';