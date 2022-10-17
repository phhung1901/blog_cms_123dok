<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;

Route::prefix("admin")->group(function (){
    //Login
    Route::get("/login", [LoginController::class, "showLoginForm"])->name("admin.auth.view");
    Route::post('/login/submit', [LoginController::class, "login"])->name("admin.auth.login");

    //Register
    Route::get("/register", [UserController::class, "create"])->name("admin.register.view");
    Route::post("/register/submit", [UserController::class, "store"])->name("admin.register.submit");

    Route::middleware('auth_admin:backend')->group(function () {
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

        //Post
        Route::prefix("/post")->group(function (){
            Route::get("/form", [PostController::class, "create"])->name("admin.post.create");
            Route::post("/form/submit", [PostController::class, "store"])->name("admin.post.store");
            Route::get("/table", [PostController::class, "index"])->name("admin.post.view");
        });


        Route::group(['middleware' => ['role:super-admin']], function (){
            //Role
            Route::prefix("/role")->group(function (){
                Route::get("/form", [RoleController::class, "create"])->name("admin.role.create");
                Route::post("/form/submit", [RoleController::class, "store"])->name("admin.role.store");
                Route::get("/table", [RoleController::class, "index"])->name("admin.role.view");
                Route::get("/action/delete/{id}", [RoleController::class, "destroy"])->name("admin.role.destroy");
                Route::get("/action/update/{id}", [RoleController::class, "edit"])->name("admin.role.edit");
                Route::post("/form/update/{id}", [RoleController::class, "update"])->name("admin.role.update");
                Route::get("/add_role_permission/{id}", [RoleController::class, "getPermissionRole"])->name("admin.role.add_permission");
                Route::post("/add_role_permission/submit/{id}", [RoleController::class, "setPermissionRole"])->name("admin.role.add_permission.sub");
            });

            //Permission
            Route::prefix("/permission")->group(function (){
                Route::get("/form", [PermissionController::class, "create"])->name("admin.permission.create");
                Route::post("/form/submit", [PermissionController::class, "store"])->name("admin.permission.store");
                Route::get("/table", [PermissionController::class, "index"])->name("admin.permission.index");
                Route::get("/action/delete/{id}", [PermissionController::class, "destroy"])->name("admin.permission.destroy");
            });
        });

        //User
        Route::group(["middleware" => ["role:super-admin|admin"]], function (){
            Route::prefix("/user")->group(function (){
                Route::get("/table", [UserController::class, "index"])->name("admin.user.view");

                Route::group(["middleware" => ["role:super-admin"]], function (){
                    Route::get("/add_user_role/{id}", [UserController::class, "getRoleUser"])->name("admin.user.add_role");
                    Route::post("/add_user_role/submit/{id}", [UserController::class, "setRoleUser"])->name("admin.user.add_role.sub");
                    Route::get("/action/edit/{id}", [UserController::class, "edit"])->name("admin.user.edit");
                    Route::post("/action/update/{id}", [UserController::class, "update"])->name("admin.user.update");
                });
            });
        });

        //Logout
        Route::get("/logout", [LoginController::class, "logout"])->name("admin.logout");
    });
});
