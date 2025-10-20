<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\EquipamentoController; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- ROTAS PÚBLICAS ---
// (Qualquer um pode acessar, mesmo sem logar)

Route::post('/login', [AuthenticatedSessionController::class, 'store']);


// --- ROTAS PROTEGIDAS ---
// (Apenas usuários logados com um token válido podem acessar)

Route::middleware('auth:sanctum')->group(function () {
    
    // Rota para buscar o usuário logado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // --- 2. ROTAS DE EQUIPAMENTO AQUI DENTRO ---
    
    // Rota para CRIAR um equipamento
    Route::post('/equipamentos', [EquipamentoController::class, 'store']);
    
    // Você também pode adicionar as outras rotas aqui:
    // Route::get('/equipamentos', [EquipamentoController::class, 'index']);      // Listar todos
    // Route::get('/equipamentos/{id}', [EquipamentoController::class, 'show']);     // Ver um específico
    // Route::put('/equipamentos/{id}', [EquipamentoController::class, 'update']);     // Atualizar
    // Route::delete('/equipamentos/{id}', [EquipamentoController::class, 'destroy']); // Deletar

});