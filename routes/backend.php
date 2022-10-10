<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::prefix("admin")->group(function (){
    //Login
    Route::get("/", [LoginController::class, "index"])->name("admin.auth.view");
    Route::post('/login', [LoginController::class, "store"])->name("admin.auth.login");

    //Register
    Route::get("/register", [UserController::class, "create"])->name("admin.register.view");
    Route::post("/register/submit", [UserController::class, "store"])->name("admin.register.submit");

    Route::middleware('auth_admin:backend')->group(function () {
//        Route::get("", function (){
//            dd("Oke");
//        });
        //Dashboard
        Route::get('', [DashboardController::class, "index"])->name('admin.dashboard.view');

        //Category
        Route::prefix("/category")->group(function (){
            Route::get("/table", [CategoryController::class, "index"])->name("admin.category.view");
            Route::get("/form", [CategoryController::class, "create"])->name("admin.category.create");
            Route::post("/form/submit", [CategoryController::class, "store"])->name("admin.category.store");
            Route::get("/action/delete/{id}", [CategoryController::class, "destroy"])->name("admin.category.destroy");
            Route::get("/action/update/{id}", [CategoryController::class, "edit"])->name("admin.category.edit");
            Route::post("form/update/{id}", [CategoryController::class, "update"])->name("admin.category.update");
        });

        //Tag
        Route::prefix("/tag")->group(function (){
            Route::get("/form", [TagController::class, "create"])->name("admin.tag.create");
            Route::post("/form/submit", [TagController::class, "store"])->name("admin.tag.store");
            Route::get("/table", [TagController::class, "index"])->name("admin.tag.view");
            Route::get("/action/delete/{id}", [TagController::class, "destroy"])->name("admin.tag.destroy");
            Route::get("/action/update/{id}", [TagController::class, "edit"])->name("admin.tag.edit");
            Route::post("/form/update/{id}", [TagController::class, "update"])->name("admin.tag.update");
        });

        //Role
        Route::prefix("/role")->group(function (){
            Route::get("/form", [RoleController::class, "create"])->name("admin.role.create");
            Route::post("/form/submit", [RoleController::class, "store"])->name("admin.role.store");
            Route::get("/table", [RoleController::class, "index"])->name("admin.role.view");
            Route::get("/action/delete/{id}", [RoleController::class, "destroy"])->name("admin.role.destroy");
            Route::get("/action/update/{id}", [RoleController::class, "edit"])->name("admin.role.edit");
            Route::post("/form/update/{id}", [RoleController::class, "update"])->name("admin.role.update");
        });

        //User
        Route::prefix("/user")->group(function (){
            Route::get("/table", [UserController::class, "index"])->name("admin.user.view");
        });

        //Logout
        Route::get("/logout", [LoginController::class, "destroy"])->name("admin.logout");
    });
});
