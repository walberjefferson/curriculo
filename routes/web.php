<?php

require __DIR__ . '/admin.php';

Auth::routes();

Route::middleware('auth')->get('/', function () {
    return view('dashboard');
});

// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('pages.error.404');
})->where('page','.*');
