<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário - Hidro Monitoring</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/assets/ICON/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ Vite::asset('resources/assets/ICON/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ Vite::asset('resources/assets/ICON/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/assets/ICON/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ Vite::asset('resources/assets/ICON/site.webmanifest') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: \'Inter\', -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            margin: 0;
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
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            display: flex;
            margin-top: 30px;
  
        }

        .form-card {
            background: white;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .user-profile {
            text-align: center;
            margin-bottom: 2rem;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 700;
        }

        .user-profile h1 {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .user-profile p {
            color: #64748b;
            font-size: 0.875rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #374151;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.2s;
            background-color: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-control.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .btn-primary {
            width: 100%;
            background-color: #f59e0b;
            color: white;
            padding: 0.875rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background-color: #d97706;
        }

        .btn-primary:disabled {
            background-color: #9ca3af;
            cursor: not-allowed;
        }

        .btn-secondary {
            width: 100%;
            background-color: #6b7280;
            color: white;
            padding: 0.875rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: background-color 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        .password-section {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .password-section h3 {
            font-size: 1rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .password-section p {
            font-size: 0.75rem;
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .checkbox-group input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            accent-color: #f59e0b;
        }

        .checkbox-group label {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0;
        }

        .password-fields {
            display: none;
        }

        .password-fields.show {
            display: block;
        }

        .status-section {
            background-color: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .status-section h3 {
            font-size: 1rem;
            font-weight: 600;
            color: #0369a1;
            margin-bottom: 0.5rem;
        }

        .status-toggle {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .toggle-switch {
            position: relative;
            width: 3rem;
            height: 1.5rem;
            background-color: #d1d5db;
            border-radius: 9999px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .toggle-switch.active {
            background-color: #10b981;
        }

        .toggle-switch::after {
            content: \'\';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 1.25rem;
            height: 1.25rem;
            background-color: white;
            border-radius: 50%;
            transition: transform 0.2s;
        }

        .toggle-switch.active::after {
            transform: translateX(1.5rem);
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        @media (max-width: 640px) {
            .container {
                margin: 1rem;
            }
            
            .form-card {
                padding: 1.5rem;
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
        <div class="form-card">
            <div class="user-profile">
                <div class="user-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h1>Editar Usuário</h1>
                <p>Atualize as informações de {{ $user->name }}</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <strong>Erro ao atualizar usuário:</strong>
                    <ul style="margin-top: 0.5rem; margin-left: 1rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('users.update', $user->id) }}" id="userForm">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-control {{ $errors->has('name') ? 'error' : '' }}" 
                        placeholder="Digite o nome completo"
                        value="{{ old('name', $user->name) }}"
                        required
                    >
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-control {{ $errors->has('email') ? 'error' : '' }}" 
                        placeholder="Digite o endereço de email"
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Função</label>
                    <select 
                        id="role" 
                        name="role" 
                        class="form-control {{ $errors->has('role') ? 'error' : '' }}"
                        required
                    >
                        <option value="">Selecione uma função</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Usuário Padrão</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                    @error('role')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="status-section">
                    <h3>Status da Conta</h3>
                    <div class="status-toggle">
                        <div class="toggle-switch {{ $user->status ? 'active' : '' }}" id="statusToggle">
                        </div>
                        <span id="statusLabel">{{ $user->status ? 'Ativo' : 'Inativo' }}</span>
                        <input type="hidden" name="status" id="statusInput" value="{{ $user->status ? '1' : '0' }}">
                    </div>
                </div>

                <div class="password-section">
                    <h3>Alterar Senha</h3>
                    <p>Deixe em branco se não desejar alterar a senha atual</p>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="changePassword">
                        <label for="changePassword">Quero alterar a senha</label>
                    </div>
                    
                    <div class="password-fields" id="passwordFields">
                        <div class="form-group">
                            <label for="password">Nova Senha</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-control {{ $errors->has('password') ? 'error' : '' }}" 
                                placeholder="Digite uma nova senha"
                            >
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Nova Senha</label>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="form-control {{ $errors->has('password_confirmation') ? 'error' : '' }}" 
                                placeholder="Digite a nova senha novamente"
                            >
                            @error('password_confirmation')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary" id="submitBtn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    Salvar Alterações
                </button>

                <a href="{{ route('users.index') }}" class="btn-secondary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Voltar para Listagem
                </a>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const changePasswordCheckbox = document.getElementById('changePassword');
            const passwordFields = document.getElementById('passwordFields');
            const statusToggle = document.getElementById('statusToggle');
            const statusLabel = document.getElementById('statusLabel');
            const statusInput = document.getElementById('statusInput');
            const submitBtn = document.getElementById('submitBtn');
            
            // Password fields toggle
            changePasswordCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    passwordFields.classList.add('show');
                    document.getElementById('password').required = true;
                    document.getElementById('password_confirmation').required = true;
                } else {
                    passwordFields.classList.remove('show');
                    document.getElementById('password').required = false;
                    document.getElementById('password_confirmation').required = false;
                    document.getElementById('password').value = '';
                    document.getElementById('password_confirmation').value = '';
                }
            });
            
            // Status toggle
            statusToggle.addEventListener('click', function() {
                const isActive = this.classList.contains('active');
                
                if (isActive) {
                    this.classList.remove('active');
                    statusLabel.textContent = 'Inativo';
                    statusInput.value = '0';
                } else {
                    this.classList.add('active');
                    statusLabel.textContent = 'Ativo';
                    statusInput.value = '1';
                }
            });
            
            // Form validation
            document.getElementById('userForm').addEventListener('submit', function(e) {
                if (changePasswordCheckbox.checked) {
                    const password = document.getElementById('password').value;
                    const confirmPassword = document.getElementById('password_confirmation').value;
                    
                    if (password !== confirmPassword) {
                        e.preventDefault();
                        alert('As senhas não coincidem. Por favor, verifique e tente novamente.');
                        return false;
                    }
                }
                
                // Disable submit button to prevent double submission
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v6m0 6v6"/></svg> Salvando...';
            });
        });
    </script>
</body>
</html>