<?php

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PostController;

Route::prefix("/")->group(function () {

//    Route::get("", function (){
//        dd("Oke");
//    });

    Route::get("", [HomeController::class, "index"])->name("user.home");
    Route::get("/list/{slug}", [PostController::class, "index"])->name("user.list");
    Route::get("/detail/{slug}", [PostController::class, "show"])->name("user.detail.post");
});
