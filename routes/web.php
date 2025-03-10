<?php

use App\Http\Controllers\UtilController;
use App\Livewire\Pages\Listagem;
use App\Livewire\Pages\ListagemItens;
use App\Models\ListaItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::get('logout', function () {
    Auth::logout(false);
    session()->flush();

    return redirect()->route('login');
})->name('logout');



Route::middleware('auth')->group(function () {

    Route::get('/listas', Listagem::class)
        ->name('listagem');

    Route::get('/{codigo}', ListagemItens::class)
        ->name('listagem-itens');

    Route::get('/pdf/{codigo}', [UtilController::class, 'visualizarPedido'])->name('pdf');
});
