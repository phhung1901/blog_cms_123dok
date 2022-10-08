<?php

use App\Http\Controllers\Admin\LoginController;

Route::prefix('admin')
    ->group(function () {

        Route::group([], function () {
           Route::get('login', [LoginController::class, 'showLoginForm']);
        });

        Route::get('', function () {
           dd('ok');
        });
    });