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
        <button class="return-btn mr-auto" onclick="window.location.href='{{ route('users.index') }}'">
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
                                        <form method="POST" action="{{ route('users.toggle', $user->id) }}" style="display: inline;" onsubmit="return confirmToggle(event, '{{ $user->name }}', {{ $user->status ? 'true' : 'false' }})">
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
                                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline;" onsubmit="return confirmDelete(event, '{{ $user->name }}')">
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


    <!-- Modal de Confirmação de Exclusão -->
    <div id="deleteModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirmar Exclusão de Usuário</h3>
                <span class="close" onclick="closeDeleteModal()">&times;</span>
            </div>
            <div class="modal-body">
                <p>Você está prestes a excluir o usuário <strong id="deleteUserName"></strong>.</p>
                <p>Esta ação é <strong>irreversível</strong> e removerá permanentemente todos os dados do usuário.</p>
                
                <div class="confirmation-input">
                    <label for="deleteConfirmation">Para confirmar, digite a frase abaixo:</label>
                    <p class="confirmation-phrase">"Estou ciente e desejo remover este usuário!"</p>
                    <input 
                        type="text" 
                        id="deleteConfirmation" 
                        placeholder="Digite a frase de confirmação..."
                        autocomplete="off"
                        onpaste="return false"
                        ondrop="return false"
                        style="width: 100%; padding: 10px; margin-top: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    >
                    <div id="deleteError" style="color: red; margin-top: 5px; display: none;">
                        A frase digitada não confere. Digite exatamente como mostrado acima.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeDeleteModal()">Cancelar</button>
                <button type="button" class="btn-danger" onclick="confirmDeleteAction()" id="confirmDeleteBtn" disabled>
                    Excluir Usuário
                </button>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Desativação -->
    <div id="toggleModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="toggleModalTitle">Confirmar Ação</h3>
                <span class="close" onclick="closeToggleModal()">&times;</span>
            </div>
            <div class="modal-body">
                <p id="toggleModalMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeToggleModal()">Cancelar</button>
                <button type="button" class="btn-primary" onclick="confirmToggleAction()" id="confirmToggleBtn">
                    Confirmar
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteForm = null;
        let currentToggleForm = null;
        const requiredPhrase = "Estou ciente e desejo remover este usuário!";

        function confirmDelete(event, userName) {
            event.preventDefault();
            currentDeleteForm = event.target;
            
            document.getElementById('deleteUserName').textContent = userName;
            document.getElementById('deleteConfirmation').value = '';
            document.getElementById('deleteError').style.display = 'none';
            document.getElementById('confirmDeleteBtn').disabled = true;
            document.getElementById('deleteModal').style.display = 'block';
            
            return false;
        }

        function confirmToggle(event, userName, isActive) {
            event.preventDefault();
            currentToggleForm = event.target;
            
            const action = isActive ? 'desativar' : 'ativar';
            const title = isActive ? 'Desativar Usuário' : 'Ativar Usuário';
            const message = `Tem certeza que deseja ${action} o usuário ${userName}?`;
            
            document.getElementById('toggleModalTitle').textContent = title;
            document.getElementById('toggleModalMessage').textContent = message;
            document.getElementById('toggleModal').style.display = 'block';
            
            return false;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
            currentDeleteForm = null;
        }

        function closeToggleModal() {
            document.getElementById('toggleModal').style.display = 'none';
            currentToggleForm = null;
        }

        function confirmDeleteAction() {
            const inputValue = document.getElementById('deleteConfirmation').value;
            const errorDiv = document.getElementById('deleteError');
            
            if (inputValue === requiredPhrase) {
                if (currentDeleteForm) {
                    currentDeleteForm.submit();
                }
                closeDeleteModal();
            } else {
                errorDiv.style.display = 'block';
            }
        }

        function confirmToggleAction() {
            if (currentToggleForm) {
                currentToggleForm.submit();
            }
            closeToggleModal();
        }

        // Verificar se a frase está correta em tempo real
        document.addEventListener('DOMContentLoaded', function() {
            const deleteInput = document.getElementById('deleteConfirmation');
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            const errorDiv = document.getElementById('deleteError');
            
            if (deleteInput) {
                deleteInput.addEventListener('input', function() {
                    const inputValue = this.value;
                    
                    if (inputValue === requiredPhrase) {
                        confirmBtn.disabled = false;
                        errorDiv.style.display = 'none';
                        this.style.borderColor = '#28a745';
                    } else {
                        confirmBtn.disabled = true;
                        this.style.borderColor = '#dc3545';
                        
                        if (inputValue.length > 0) {
                            errorDiv.style.display = 'block';
                        } else {
                            errorDiv.style.display = 'none';
                        }
                    }
                });
            }
        });

        // Fechar modais ao clicar fora
        window.onclick = function(event) {
            const deleteModal = document.getElementById('deleteModal');
            const toggleModal = document.getElementById('toggleModal');
            
            if (event.target == deleteModal) {
                closeDeleteModal();
            }
            if (event.target == toggleModal) {
                closeToggleModal();
            }
        }
    </script>

    <style>
        .modal {
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 0;
            border: none;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            margin: 0;
            color: #333;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
        }

        .confirmation-phrase {
            background-color: #f8f9fa;
            padding: 10px;
            border-left: 4px solid #007bff;
            margin: 10px 0;
            font-style: italic;
            font-weight: bold;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-danger:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
)
            <div style="margin-top: 1.5rem; display: flex; justify-content: center;">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</body>
</html>

te('users.create') }}" class="btn-primary" style="margin-top: 1rem;">
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