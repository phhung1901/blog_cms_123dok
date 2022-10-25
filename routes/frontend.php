<?php

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\UserLoginController;

Route::prefix("/")->group(function () {
    //Auth

    //Login
    Route::get("/login", [UserLoginController::class, "showLoginForm"])->name("user.login.view");
    Route::post("/login/submit", [UserLoginController::class, "login"])->name("user.login.submit");
    Route::get("/logout", [UserLoginController::class, "logout"])->name("user.logout");
    //Register
    Route::get("/register", [UserLoginController::class, "create"])->name("user.register.view");
    Route::post("/register/submit", [UserLoginController::class, "store"])->name("user.register.store");

    //GG login
    Route::get("/google/login/{driver}", [UserLoginController::class, 'redirectToProvider'])->name("user.google.login");
    Route::get("/google/callback/", [UserLoginController::class, "handleProviderCallback"]);
    //Post
    Route::get("", [HomeController::class, "index"])->name("user.home");
    Route::get("/list/{slug}", [PostController::class, "index"])->name("user.list");
    Route::get("/detail/{slug}", [PostController::class, "show"])->name("user.detail.post");
});
