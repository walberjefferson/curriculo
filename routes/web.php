<?php

require __DIR__ . '/admin.php';

Auth::routes();

Route::middleware('auth')->get('/', function () {
    return view('dashboard');
});
