<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get("/", function () {
    return view("auth.login");
})->name("login");

Route::resource("users", UserController::class);

// Rota adicional para o toggle de status
Route::patch("users/{user}/toggle", [UserController::class, "toggle"])->name("users.toggle");