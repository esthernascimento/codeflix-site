<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\MembroController;


Route::get('/', [FilmeController::class, 'index']);


Route::get('/contato', function () {
    return view('contato');
});


Route::get('/sobre', [MembroController::class, 'index'])->name('sobre');


Route::resource('membros', MembroController::class);