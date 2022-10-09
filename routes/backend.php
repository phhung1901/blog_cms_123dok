<?php
use App\Http\Controllers\Admin\DashboardController;

Route::prefix("admin")->group(function (){
    //Dashboard
    Route::get("/", [DashboardController::class, "index"])->name("admin.dashboard.index");
});
