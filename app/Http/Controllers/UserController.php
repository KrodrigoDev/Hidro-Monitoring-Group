<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Para fins de demonstração do frontend, estou simulando alguns usuários.
        $users = collect([
            (object) ["id" => 1, "name" => "Alice Silva", "email" => "alice@example.com", "cpf" => "123.456.789-00", "birth_date" => "1990-01-01", "company" => "Empresa Exemplo", "role" => "admin", "status" => true, "created_at" => now()->subDays(10)],
            (object) ["id" => 2, "name" => "Bruno Costa", "email" => "bruno@example.com", "cpf" => "987.654.321-00", "birth_date" => "1985-05-15", "company" => "Empresa Exemplo", "role" => "user", "status" => true, "created_at" => now()->subDays(5)],
            (object) ["id" => 3, "name" => "Carla Dias", "email" => "carla@example.com", "cpf" => "111.222.333-44", "birth_date" => "2000-12-30", "company" => "Empresa Exemplo", "role" => "user", "status" => false, "created_at" => now()->subDays(20)],
        ]);

        // Simular paginação para a view
        $perPage = 10;
        $currentPage = request()->get("page", 1);
        $pagedData = $users->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $users = new \Illuminate\Pagination\LengthAwarePaginator($pagedData, $users->count(), $perPage, $currentPage, [
            "path" => request()->url(), "query" => request()->query()
        ]);

        return view("auth.users.user-management", compact("users"));
    }

    public function create()
    {
        return view("auth.users.create");
    }

    public function store(Request $request)
    {
        // Lógica de armazenamento (backend) deve ser implementada aqui.
        // Por enquanto, apenas redireciona com uma mensagem de sucesso.
        return redirect()->route("users.index")->with("success", "Usuário cadastrado com sucesso (simulado)!");
    }

    public function edit(string $id)
    {
        // Simular a busca de um usuário para edição.
        $user = (object) [
            "id" => $id,
            "name" => "Usuário de Teste",
            "email" => "teste@example.com",
            "cpf" => "000.000.000-00",
            "birth_date" => "2000-01-01",
            "company" => "Empresa Teste",
            "role" => "user",
            "status" => true
        ];
        return view("auth.users.edit", compact("user"));
    }

    public function update(Request $request, string $id)
    {
        // Lógica de atualização (backend) deve ser implementada aqui.
        // Por enquanto, apenas redireciona com uma mensagem de sucesso.
        return redirect()->route("users.index")->with("success", "Usuário atualizado com sucesso (simulado)!");
    }

    public function destroy(string $id)
    {
        // Lógica de exclusão (backend) deve ser implementada aqui.
        // Por enquanto, apenas redireciona com uma mensagem de sucesso.
        return redirect()->route("users.index")->with("success", "Usuário excluído com sucesso (simulado)!");
    }

    public function toggle(string $id)
    {
        // Lógica de alternância de status (backend) deve ser implementada aqui.
        // Por enquanto, apenas redireciona com uma mensagem de sucesso.
        return redirect()->route("users.index")->with("success", "Status do usuário alterado com sucesso (simulado)!");
    }
}