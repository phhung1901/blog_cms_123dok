<?php

use App\Http\Controllers\Admin\LoginController;

Route::prefix('admin')
    ->group(function () {

        Route::group([], function () {
           Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.auth.login');
           Route::post('login', [LoginController::class, 'login']);
        });

        Route::middleware('auth_admin:backend')
            ->group(function () {

                Route::get('', function () {
                    dd('ok');
                })->name('admin.dashboard');



            });
    });