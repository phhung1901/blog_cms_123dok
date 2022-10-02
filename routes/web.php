<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Admin
Route::prefix('admin')->group(function (){
    //Login
    Route::get("/", [LoginController::class, "index"])->name("admin.login.view");
    Route::post('/login', [LoginController::class, "store"])->name("admin.login.submit");


    //Main
    Route::middleware(['auth'])->group(function (){
        //Dashboard
        Route::get("/dashboard", [MainController::class, "index"])->name('admin.dashboard.view');

        //Logout
        Route::get("/logout", [LoginController::class, "destroy"])->name("admin.logout");
    });
});

//User
//Route::prefix('/')->group(function (){
//    //Login
//    Route::get()->name("user.login.view");
//    Route::post()->name("user.login.submit);
//
//});
