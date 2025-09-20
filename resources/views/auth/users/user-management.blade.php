<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Usuários - Hidro Monitoring</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/assets/ICON/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ Vite::asset('resources/assets/ICON/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ Vite::asset('resources/assets/ICON/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/assets/ICON/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ Vite::asset('resources/assets/ICON/site.webmanifest') }}" />
    @vite(['resources/css/user-management.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0px;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #ffff;
            color: #1e293b;
        }

        header {
            width: 100%; 
            height: 64px;
            padding: 15px 30px;
            display: flex;
            justify-content: right;
            gap: 5px;
            align-items: center;
            background-color: #EBF7F7;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            box-sizing: border-box; 
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
            margin-top: 30px;
        }

        .users-filters {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .users-filters h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .filters {
            background: white;
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .filters-row {
            display: grid;
            grid-template-columns: 1fr 200px 200px auto;
            gap: 1rem;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #374151;
        }

        .form-control {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        .users-table {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background-color: #f8fafc;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .role-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .role-admin {
            background-color: #ddd6fe;
            color: #5b21b6;
        }

        .role-user {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.75rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s;
        }

        .btn-edit {
            background-color: #f59e0b;
            color: white;
        }

        .btn-edit:hover {
            background-color: #d97706;
        }

        .btn-delete {
            background-color: #ef4444;
            color: white;
        }

        .btn-delete:hover {
            background-color: #dc2626;
        }

        .btn-toggle {
            background-color: #10b981;
            color: white;  
        }

        .btn-toggle:hover {
            background-color: #059669;
        }

        .btn-toggle.inactive {
            background-color: #6b7280;
        }

        .btn-toggle.inactive:hover {
            background-color: #4b5563;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }

        .empty-state img {
            width: 120px;
            height: 120px;
            margin: 0 auto 1rem;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .filters-row {
                grid-template-columns: 1fr;
            }
            
            .table {
                font-size: 0.875rem;
            }
            
            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header>
        <button class="return-btn mr-auto">
            <img src="{{ Vite::asset('resources/assets/ICON/returnICON.svg') }}" alt="Return">
        </button>

        <img src="{{ Vite::asset('resources/assets/ICON/contrasteICON.svg') }}" alt="Contraste">
        <p>Alto Contraste</p>
    </header>
    <div class="container">
        <div class="users-filters">
            <h1>Listagem de Usuários</h1>
            <a href="{{ route('users.create') }}" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Cadastrar Usuário
            </a>
        </div>

        <div class="filters">
            <form method="GET" action="{{ route('users.index') }}">
                <div class="filters-row">
                    <div class="form-group">
                        <label for="search">Pesquisar Usuário</label>
                        <input 
                            type="text" 
                            id="search" 
                            name="search" 
                            class="form-control" 
                            placeholder="Digite o nome ou email do usuário..."
                            value="{{ request('search') }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="role">Função</label>
                        <select id="role" name="role" class="form-control">
                            <option value="">Todas as funções</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Usuário Padrão</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="">Todos os status</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Ativo</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inativo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-secondary">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="users-table">
            @if($users->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome do Usuário</th>
                            <th>Email</th>
                            <th>Função</th>
                            <th>Status</th>
                            <th>Data de Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <div style="width: 40px; height: 40px; background-color: #e5e7eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; color: #6b7280;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <span style="font-weight: 600;">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="role-badge {{ $user->role == 'admin' ? 'role-admin' : 'role-user' }}">
                                        {{ $user->role == 'admin' ? 'Administrador' : 'Usuário Padrão' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge {{ $user->status ? 'status-active' : 'status-inactive' }}">
                                        {{ $user->status ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn-sm btn-edit">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                <path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                            </svg>
                                            Editar
                                        </a>
                                        <form method="POST" action="{{ route('users.toggle', $user->id) }}" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-sm btn-toggle {{ !$user->status ? 'inactive' : '' }}">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="3"/>
                                                    <path d="M12 1v6m0 6v6"/>
                                                </svg>
                                                {{ $user->status ? 'Desativar' : 'Ativar' }}
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-delete">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3,6 5,6 21,6"/>
                                                    <path d="m19,6v14a2,2 0 0,1 -2,2H7a2,2 0 0,1 -2,-2V6m3,0V4a2,2 0 0,1 2,-2h4a2,2 0 0,1 2,2v2"/>
                                                </svg>
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <img src="{{ Vite::asset('resources/assets/ICON/signal.png') }}" alt="Nenhum usuário encontrado">
                    <h3>Nenhum usuário encontrado</h3>
                    <p>Não há usuários cadastrados ou que correspondam aos filtros aplicados.</p>
                    <a href="{{ route('users.create') }}" class="btn-primary" style="margin-top: 1rem;">
                        Cadastrar Primeiro Usuário
                    </a>
                </div>
            @endif
        </div>

        @if($users->hasPages())
            <div style="margin-top: 1.5rem; display: flex; justify-content: center;">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</body>
</html>