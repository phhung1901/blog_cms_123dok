<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CategoryController;

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

    //Register
    Route::get("/register", [UserController::class, "create"])->name("admin.register.view");
    Route::post("/register/submit", [UserController::class, "store"])->name("admin.register.submit");


    //Main
    Route::middleware(['auth'])->group(function (){
        //Dashboard
        Route::get("/dashboard", [MainController::class, "index"])->name('admin.dashboard.view');

        //Category
        Route::prefix("/category")->group(function (){
            Route::get("/form", [CategoryController::class, "create"])->name("admin.category.create");
        });

        //Logout
        Route::get("/logout", [LoginController::class, "destroy"])->name("admin.logout");
    });
});

//User
Route::prefix('/')->group(function (){
    //Login
    Route::get("/", [HomeController::class, "index"])->name("user.login.view");

    Route::get("/society", [PostController::class, "societyPost"])->name("user.society.view");

    Route::get("/detail", [PostController::class, "show"])->name("user.detail.view");
//    Route::post()->name("user.login.submit);

});
