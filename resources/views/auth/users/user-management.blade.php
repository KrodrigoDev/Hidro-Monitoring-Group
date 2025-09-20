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
                            placeholder="Digite o nome ou CPF do usuário..."
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
                            <th>Nome Completo do Usuário</th>
                            <th>CPF</th>
                            <th>Função</th>
                            <th>Status</th>
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
                                        <div>
                                            <div style="font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 250px;" title="{{ $user->name }}">
                                                {{ $user->name }}
                                            </div>
                                            <div style="font-size: 0.75rem; color: #6b7280;">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="font-family: monospace;">
                                        {{ $user->cpf ?? 'Não informado' }}
                                    </span>
                                </td>
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

