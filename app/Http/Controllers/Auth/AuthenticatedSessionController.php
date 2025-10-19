<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->authenticate();

        // Pega o usuário que acabou de ser autenticado
        $user = Auth::user();

        // Cria um novo token para esse usuário
        $token = $user->createToken('auth_token')->plainTextToken;

        // Retorna o token como JSON
        return response()->json([
            'message' => 'Login com sucesso',
            'token' => $token,
            'user' => $user // Opcional, mas bom para o front-end
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
