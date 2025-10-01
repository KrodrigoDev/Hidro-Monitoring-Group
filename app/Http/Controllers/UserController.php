<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    /**
     * Retorna uma lista de usuários em formato JSON.
     */
    public function index()
    {
        // Para fins de demonstração, estamos simulando alguns usuários.
        // Por enquanto que não há implementação do banco de dados (MANDA BRASA CAIO).
        // Ex: $users = User::all();
        $users = collect([
            (object) ["id" => 1, "name" => "Alice Silva", "email" => "alice@example.com", "role" => "admin", "status" => true, "created_at" => now()->subDays(10)->toIso8601String()],
            (object) ["id" => 2, "name" => "Bruno Costa", "email" => "bruno@example.com", "role" => "user", "status" => true, "created_at" => now()->subDays(5)->toIso8601String()],
            (object) ["id" => 3, "name" => "Carla Dias", "email" => "carla@example.com", "role" => "user", "status" => false, "created_at" => now()->subDays(20)->toIso8601String()],
        ]);

        // Retorna os dados como JSON.
        return response()->json($users);
    }

    /**
     * Salva um novo usuário.
     */
    public function store(Request $request)
    {
        // Lógica de validação e armazenamento (backend) deve ser implementada aqui.
        // Por enquanto, apenas retorna uma mensagem de sucesso em JSON.
        return response()->json(['message' => 'Usuário cadastrado com sucesso (simulado)!'], 201); // 201 = Created
    }

    /**
     * Atualiza um usuário existente.
     */
    public function update(Request $request, string $id)
    {
        // Lógica de validação e atualização (backend) deve ser implementada aqui.
        return response()->json(['message' => "Usuário {$id} atualizado com sucesso (simulado)!"]);
    }

    /**
     * Exclui um usuário.
     */
    public function destroy(string $id)
    {
        // Lógica de exclusão (backend) deve ser implementada aqui.
        return response()->json(['message' => "Usuário {$id} excluído com sucesso (simulado)!"]);
    }

    /**
     * Alterna o status de um usuário.
     */
    public function toggle(string $id)
    {
        // Lógica de alternância de status (backend) deve ser implementada aqui.
        return response()->json(['message' => "Status do usuário {$id} alterado com sucesso (simulado)!"]);
    }

    // OBS: Os métodos create() e edit() que retornavam views de formulário
    // não são mais necessários em uma API, pois os formulários agora
    // são componentes do seu frontend Vue.
}