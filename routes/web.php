<?php

use App\Http\Controllers\Api\{
    HabilidadesController,
    CurriculoWebController as ApiCurriculoController,
    CidadeController as ApiCidadeController,
    EscolaridadeController as ApiEscolaridadeController,
    EstadoCivilController as ApiEstadoCivilController,
    EstadoController as ApiEstadoController,
    SexoController as ApiSexoController
};

require __DIR__ . '/admin.php';

Auth::routes();

Route::view('/', 'home');
Route::get('curriculo', [\App\Http\Controllers\CurriculoController::class, 'create'])->name('curriculo.create');

Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
});

Route::prefix('api')->as('api.')->middleware('verify_json')->group(function () {
    Route::get('sexo', [ApiSexoController::class, 'index']);
    Route::get('estado', [ApiEstadoController::class, 'index']);
    Route::get('estado_civil', [ApiEstadoCivilController::class, 'index']);
    Route::get('escolaridade', [ApiEscolaridadeController::class, 'index']);
    Route::get('habilidade', [HabilidadesController::class, 'index']);
    Route::post('cidade', [ApiCidadeController::class, 'index']);

    Route::apiResource('curriculo', ApiCurriculoController::class)->only('store')->parameters(['curriculo' => 'dados']);
});
