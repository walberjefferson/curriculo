<?php


use App\Http\Controllers\Api\{
    HabilidadesController,
    CurriculoFotoController,
    CurriculoController as ApiCurriculoController,
    CidadeController as ApiCidadeController,
    EscolaridadeController as ApiEscolaridadeController,
    EstadoCivilController as ApiEstadoCivilController,
    EstadoController as ApiEstadoController,
    SexoController as ApiSexoController
};

use App\Http\Controllers\Admin\{
    SexoController,
    EscolaridadeController,
    HabilidadeController,
    EstadoCivilController,
    EstadoController,
    CidadeController,
    CurriculoController
};

Route::prefix('admin')->as('admin.')->middleware(['auth'])->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');
    Route::resource('sexo', SexoController::class)->except('show')->parameters(['sexo' => 'dados']);
    Route::resource('escolaridade', EscolaridadeController::class)->except('show')->parameters(['escolaridade' => 'dados']);
    Route::resource('habilidade', HabilidadeController::class)->except('show')->parameters(['habilidade' => 'dados']);
    Route::resource('estado_civil', EstadoCivilController::class)->except('show')->parameters(['estado_civil' => 'dados']);
    Route::resource('estado', EstadoController::class)->only('index')->parameters(['estado' => 'dados']);
    Route::resource('cidade', CidadeController::class)->only('index')->parameters(['cidade' => 'dados']);
    Route::resource('curriculo', CurriculoController::class)->only('index', 'create', 'edit', 'show', 'destroy')->parameters(['curriculo' => 'dados']);
});

Route::prefix('api')->as('api.')->middleware('auth')->group(function () {
    Route::get('sexo', [ApiSexoController::class, 'index']);
    Route::get('estado', [ApiEstadoController::class, 'index']);
    Route::get('estado_civil', [ApiEstadoCivilController::class, 'index']);
    Route::get('escolaridade', [ApiEscolaridadeController::class, 'index']);
    Route::get('habilidade', [HabilidadesController::class, 'index']);
    Route::post('cidade', [ApiCidadeController::class, 'index']);

    Route::post('curriculo_foto/{dados}', [CurriculoFotoController::class, 'destroy'])->name('curriculo_foto.destroy');
    Route::put('curriculo_foto/{dados}', [CurriculoFotoController::class, 'update'])->name('curriculo_foto.update');

    Route::apiResource('curriculo', ApiCurriculoController::class)->only('store', 'show', 'update')->parameters(['curriculo' => 'dados']);
//    Route::apiResource('curriculo_foto', CurriculoFotoController::class)->only('destroy', 'update')->parameters(['curriculo_foto' => 'dados']);
});
