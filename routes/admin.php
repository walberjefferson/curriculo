<?php


use App\Http\Controllers\Admin\SexoController;

Route::prefix('admin')->as('admin.')->middleware(['auth'])->group(function() {
    Route::redirect('/', '/admin/user')->name('dashboard');
    Route::resource('sexo', SexoController::class)->except('show');
    Route::resource('escolaridade', \App\Http\Controllers\Admin\EscolaridadeController::class)->except('show');
    Route::resource('habilidade', \App\Http\Controllers\Admin\HabilidadeController::class)->except('show');
    Route::resource('estado_civil', \App\Http\Controllers\Admin\EstadoCivilController::class)->except('show');
    Route::resource('estado', \App\Http\Controllers\Admin\EstadoController::class)->only('index');
    Route::resource('cidade', \App\Http\Controllers\Admin\CidadeController::class)->only('index');
    Route::resource('curriculo', \App\Http\Controllers\Admin\CurriculoController::class);
});
