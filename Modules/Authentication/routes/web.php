<?php

Route::get('profile', 'ProfileController@index')->name('profile');
Route::get('alterar_senha', 'ProfileController@edit')->name('alterar_senha');
Route::put('alterar_senha', 'ProfileController@update')->name('alterar_senha');

Route::resource('user', 'UsersController');
Route::resource('role', 'RolesController');
Route::get('role/{role}/permissions', 'PermissionsController@edit')->name('role.permission.edit');
Route::put('role/{role}/permissions', 'PermissionsController@update')->name('role.permission.update');