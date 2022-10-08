<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;

Route::prefix('admin')
    ->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.auth.login');
        Route::post('login', [LoginController::class, 'login']);
        Route::get('logout', [LoginController::class, 'logout'])->name('admin.auth.logout');

        Route::middleware('auth_admin:backend')
            ->group(function () {

                Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard.index');

            });
    });