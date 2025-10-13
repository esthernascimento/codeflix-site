<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FilmeController;
use App\Http\Controllers\MembroController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\DashboardController;


Route::get('/download-filmes-csv', 'App\Http\Controllers\FilmeController@download')->name('filmes.csv');
Route::get('/download-contatos-csv', 'App\Http\Controllers\ContatoController@download')->name('contatos.csv');

Route::get('/download-pdf', 'App\Http\Controllers\FilmeController@downloadPdf');


Route::get('/', [FilmeController::class, 'index'])->name('filmes.index');

Route::resource('filmes', FilmeController::class)->except(['show']);

Route::get('/sobre', [MembroController::class, 'index'])->name('sobre');
Route::resource('membros', MembroController::class)->except(['index', 'show']);

Route::get('/contato', [ContatoController::class, 'index'])->name('contatos.index');

Route::resource('contatos', ContatoController::class)->only(['index', 'store']);

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/sobre', [MembroController::class, 'index'])->name('sobre');

    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])
        ->name('logout');
});