<?php

Route::prefix('admin')->as('admin.')->middleware(['auth'])->group(function() {
    Route::redirect('/', '/admin/user')->name('dashboard');
});
