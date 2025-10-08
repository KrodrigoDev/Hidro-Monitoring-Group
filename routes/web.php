<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get("/", function () {
    return view("auth.login");
})->name("login");

Route::get("/register", function () {
    return view("auth.register");
})->name("register"); 

Route::resource("users", UserController::class);

// Rota adicional para o toggle de status
Route::patch("users/{user}/toggle", [UserController::class, "toggle"])->name("users.toggle");
// Rotas para as telas Vue.js
Route::get("/support", function () {
    return view("support");
})->name("support");

Route::get("/equipment-history", function () {
    return view("equipment-history");
})->name("equipment.history");

Route::get("/equipment-management", function () {
    return view("equipment-management");
})->name("equipment.management");


// Rotas para recuperação de senha
Route::get("/forgot-password", function () {
    return view("forgot-password");
})->name("password.request");

Route::get("/reset-password", function () {
    return view("reset-password");
})->name("password.reset");

Route::get("/password-reset-success", function () {
    return view("password-reset-success");
})->name("password.reset.success");

