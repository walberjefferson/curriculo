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

Route::prefix('api')->as('api.')->middleware('auth')->group(function () {
    Route::get('sexo', [\App\Http\Controllers\Api\SexoController::class, 'index']);
    Route::get('estado', [\App\Http\Controllers\Api\EstadoController::class, 'index']);
    Route::get('estado_civil', [\App\Http\Controllers\Api\EstadoCivilController::class, 'index']);
    Route::get('escolaridade', [\App\Http\Controllers\Api\EscolaridadeController::class, 'index']);
    Route::post('cidade', [\App\Http\Controllers\Api\CidadeController::class, 'index']);
});
