<?php

use App\Livewire\Pages\Listagem;
use App\Livewire\Pages\ListagemItens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('logout', function () {
    Auth::logout(false);
    session()->flush();

    return redirect()->route('welcome');
})->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/listas', Listagem::class)
        ->name('listagem');

    Route::get('/{codigo}', ListagemItens::class)
        ->name('listagem-itens');
});
