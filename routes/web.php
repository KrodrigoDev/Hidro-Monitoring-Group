<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Rota para a página de login
Route::get("/", function () {
    return view("auth.login");
})->name("login");

// Rotas para gerenciamento de usuários
Route::resource("users", UserController::class);

// Rota adicional para o toggle de status
Route::patch("users/{user}/toggle", [UserController::class, "toggle"])->name("users.toggle");

// Rota para recuperação de senha
Route::get('/esqueci-senha', function () {
    return view('auth.forgot-password');
});

// Rota para redefinição de senha
Route::get('/redefinir-senha', function () {
    return view('auth.reset-password');
});