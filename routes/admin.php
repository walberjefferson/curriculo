<?php

Route::prefix('admin')->as('admin.')->middleware(['auth', 'auth.resource'])->group(function() {
    Route::redirect('/', '/admin/user')->name('dashboard');
});
