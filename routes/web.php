<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\PontoController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui você pode registrar as rotas do sistema. Estas rotas são carregadas
| pelo RouteServiceProvider dentro de um grupo que contém o middleware "web".
|
*/

// Página inicial (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// Rota para o dashboard (apenas usuários autenticados e verificados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    
    // Rotas de Perfil do Usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rotas de Ponto
    Route::post('/pontos/entrada', [PontoController::class, 'registrarEntrada'])->name('pontos.entrada');
    Route::post('/pontos/saida', [PontoController::class, 'registrarSaida'])->name('pontos.saida');
    Route::get('/pontos/historico', [PontoController::class, 'historico'])->name('pontos.historico');

    // Rotas de Usuários (restrito a administradores)
    Route::middleware('role:admin')->group(function () {
        Route::resource('/users', UserController::class);

        // Rotas de Funcionários 
        Route::resource('/funcionarios', FuncionarioController::class);

        //Rotas de Relatórios
        Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
        Route::post('/relatorios/gerar', [RelatorioController::class, 'gerarRelatorio'])->name('relatorios.gerar');
        Route::get('/relatorios/exportar', [RelatorioController::class, 'exportarRelatorio'])->name('relatorios.exportar');
    });
});

require __DIR__ . '/auth.php';
