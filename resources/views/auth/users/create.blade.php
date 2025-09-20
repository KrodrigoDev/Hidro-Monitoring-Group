<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário - Hidro Monitoring</title>
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
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            margin-top: 30px;
        }

        .form-card {
            width: 1200px;
            background: white;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .info-newuser {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 700;
        }

        .info-newuser h1 {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .info-newuser p {
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
            background-color: #3b82f6;
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
            background-color: #2563eb;
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

        .password-requirements {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-top: 0.5rem;
        }

        .password-requirements h4 {
            font-size: 0.75rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .password-requirements ul {
            list-style: none;
            font-size: 0.75rem;
            color: #6b7280;
        }

        .password-requirements li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.25rem;
        }

        .password-requirements li.valid {
            color: #059669;
        }

        .password-requirements li.invalid {
            color: #dc2626;
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
            <div class="info-newuser">
                <div class="logo">
                    <img src="{{ Vite::asset('resources/assets/ICON/logo.svg') }}" alt="Hidro Monitoring" style="width: 40px; height: 40px;">
                </div>
                <h1>Cadastrar Usuário</h1>
                <p>Preencha os dados para criar uma nova conta</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <strong>Erro ao cadastrar usuário:</strong>
                    <ul style="margin-top: 0.5rem; margin-left: 1rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('users.store') }}" id="userForm">
                @csrf
                
                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-control {{ $errors->has('name') ? 'error' : '' }}" 
                        placeholder="Digite o nome completo"
                        value="{{ old('name') }}"
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
                        value="{{ old('email') }}"
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
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuário Padrão</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                    @error('role')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control {{ $errors->has('password') ? 'error' : '' }}" 
                        placeholder="Digite uma senha segura"
                        required
                    >
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    
                    <div class="password-requirements">
                        <h4>Requisitos da senha:</h4>
                        <ul id="passwordRequirements">
                            <li id="length" class="invalid">
                                <span>✗</span> Mínimo de 8 caracteres
                            </li>
                            <li id="uppercase" class="invalid">
                                <span>✗</span> Pelo menos uma letra maiúscula
                            </li>
                            <li id="lowercase" class="invalid">
                                <span>✗</span> Pelo menos uma letra minúscula
                            </li>
                            <li id="number" class="invalid">
                                <span>✗</span> Pelo menos um número
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Senha</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-control {{ $errors->has('password_confirmation') ? 'error' : '' }}" 
                        placeholder="Digite a senha novamente"
                        required
                    >
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-primary" id="submitBtn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    Cadastrar Usuário
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
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const submitBtn = document.getElementById('submitBtn');
            
            // Password validation
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                
                // Length check
                const lengthCheck = document.getElementById('length');
                if (password.length >= 8) {
                    lengthCheck.classList.remove('invalid');
                    lengthCheck.classList.add('valid');
                    lengthCheck.querySelector('span').textContent = '✓';
                } else {
                    lengthCheck.classList.remove('valid');
                    lengthCheck.classList.add('invalid');
                    lengthCheck.querySelector('span').textContent = '✗';
                }
                
                // Uppercase check
                const uppercaseCheck = document.getElementById('uppercase');
                if ([A-Z].test(password)) {
                    uppercaseCheck.classList.remove('invalid');
                    uppercaseCheck.classList.add('valid');
                    uppercaseCheck.querySelector('span').textContent = '✓';
                } else {
                    uppercaseCheck.classList.remove('valid');
                    uppercaseCheck.classList.add('invalid');
                    uppercaseCheck.querySelector('span').textContent = '✗';
                }
                
                // Lowercase check
                const lowercaseCheck = document.getElementById('lowercase');
                if (/[a-z]/.test(password)) {
                    lowercaseCheck.classList.remove('invalid');
                    lowercaseCheck.classList.add('valid');
                    lowercaseCheck.querySelector('span').textContent = '✓';
                } else {
                    lowercaseCheck.classList.remove('valid');
                    lowercaseCheck.classList.add('invalid');
                    lowercaseCheck.querySelector('span').textContent = '✗';
                }
                
                // Number check
                const numberCheck = document.getElementById('number');
                if ([0-9].test(password)) {
                    numberCheck.classList.remove('invalid');
                    numberCheck.classList.add('valid');
                    numberCheck.querySelector('span').textContent = '✓';
                } else {
                    numberCheck.classList.remove('valid');
                    numberCheck.classList.add('invalid');
                    numberCheck.querySelector('span').textContent = '✗';
                }
            });
            
            // Form validation
            document.getElementById('userForm').addEventListener('submit', function(e) {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('As senhas não coincidem. Por favor, verifique e tente novamente.');
                    return false;
                }
                
                // Disable submit button to prevent double submission
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v6m0 6v6"/></svg> Cadastrando...';
            });
        });
    </script>
</body>
</html>