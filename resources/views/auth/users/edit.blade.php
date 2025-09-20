<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hidro Monitoring - Editar Usuário</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/assets/ICON/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ Vite::asset('resources/assets/ICON/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ Vite::asset('resources/assets/ICON/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/assets/ICON/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ Vite::asset('resources/assets/ICON/site.webmanifest') }}" />
    @vite(['resources/css/edit.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <button class="return-btn mr-auto" onclick="window.location.href='{{ route('users.index') }}'">
            <img src="{{ Vite::asset('resources/assets/ICON/returnICON.svg') }}" alt="Return">
        </button>

        <img src="{{ Vite::asset('resources/assets/ICON/contrasteICON.svg') }}" alt="Contraste">
        <p>Alto Contraste</p>
    </header>

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

    <div class="container">
        <div class="left-panel">
            <img src="{{ Vite::asset('resources/assets/ICON/logo2.svg') }}" alt="Hidro Monitoring Logo">
        </div>
        <div class="right-panel">
            <div class="edit-card">
                <h2>Editar Usuário</h2>
                <form method="POST" action="{{ route('users.update', $user->id) }}" id="userForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-row">
                        <div class="input-group">
                            <label for="name">Nome Completo</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="form-control {{ $errors->has('name') ? 'error' : '' }}" 
                                placeholder="Seu nome completo"
                                value="{{ old('name', $user->name) }}"
                                required
                            >
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="cpf">CPF</label>
                            <input 
                                type="text" 
                                id="cpf" 
                                name="cpf" 
                                class="form-control {{ $errors->has('cpf') ? 'error' : '' }}" 
                                placeholder="000.000.000-00"
                                value="{{ old('cpf', $user->cpf) }}"
                                required
                            >
                            @error('cpf')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="input-group">
                            <label for="birth_date">Data de nascimento</label>
                            <input 
                                type="date" 
                                id="birth_date" 
                                name="birth_date" 
                                class="form-control {{ $errors->has('birth_date') ? 'error' : '' }}"
                                value="{{ old('birth_date', $user->birth_date) }}"
                                required
                            >
                            @error('birth_date')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="email">E-mail</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-control {{ $errors->has('email') ? 'error' : '' }}" 
                                placeholder="seu@email.com"
                                value="{{ old('email', $user->email) }}"
                                required
                            >
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="input-group">
                            <label for="company">Empresa</label>
                            <input 
                                type="text" 
                                id="company" 
                                name="company" 
                                class="form-control {{ $errors->has('company') ? 'error' : '' }}" 
                                placeholder="Nome da empresa"
                                value="{{ old('company', $user->company) }}"
                                required
                            >
                            @error('company')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="role">Permissões</label>
                            <select 
                                id="role" 
                                name="role" 
                                class="form-control {{ $errors->has('role') ? 'error' : '' }}"
                                required
                            >
                                <option value="">Selecione as permissões</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Usuário</option>
                                <option value="viewer" {{ old('role', $user->role) == 'viewer' ? 'selected' : '' }}>Visualizador</option>
                            </select>
                            @error('role')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-group">
                            <label for="equipment">Equipamentos</label>
                            <button type="button" class="equipment-btn" onclick="openEquipmentModal()">
                                Gerenciar Equipamentos
                            </button>
                            <div id="selectedEquipments" class="selected-equipment-list">
                                <!-- Equipamentos já vinculados serão exibidos aqui -->
                                <span class="equipment-tag">Sensor de Temperatura - ST001</span>
                                <span class="equipment-tag">Medidor de pH - MP003</span>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="status">Status da Conta</label>
                            <div class="status-toggle">
                                <div class="toggle-switch {{ $user->status ? 'active' : '' }}" id="statusToggle">
                                </div>
                                <span id="statusLabel">{{ $user->status ? 'Ativo' : 'Inativo' }}</span>
                                <input type="hidden" name="status" id="statusInput" value="{{ $user->status ? '1' : '0' }}">
                            </div>
                        </div>
                    </div>

                    <div class="password-section">
                        <div class="checkbox-group">
                            <input type="checkbox" id="changePassword">
                            <label for="changePassword">Quero alterar a senha</label>
                        </div>
                        
                        <div class="password-fields" id="passwordFields">
                            <div class="form-row">
                                <div class="input-group">
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
                                <div class="input-group">
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
                    </div>

                    <button type="submit" class="edit-btn" id="submitBtn">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Equipamentos -->
    <div id="equipmentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Gerenciar Equipamentos</h3>
                <span class="close" onclick="closeEquipmentModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="equipment-list">
                    <!-- Lista de equipamentos será carregada aqui -->
                    <div class="equipment-item">
                        <input type="checkbox" id="eq1" name="equipment[]" value="1" checked>
                        <label for="eq1">Sensor de Temperatura - ST001</label>
                        <span class="equipment-status active">Ativo</span>
                    </div>
                    <div class="equipment-item">
                        <input type="checkbox" id="eq2" name="equipment[]" value="2">
                        <label for="eq2">Sensor de Umidade - SU002</label>
                        <span class="equipment-status inactive">Inativo</span>
                    </div>
                    <div class="equipment-item">
                        <input type="checkbox" id="eq3" name="equipment[]" value="3" checked>
                        <label for="eq3">Medidor de pH - MP003</label>
                        <span class="equipment-status active">Ativo</span>
                    </div>
                    <div class="equipment-item">
                        <input type="checkbox" id="eq4" name="equipment[]" value="4">
                        <label for="eq4">Sensor de Pressão - SP004</label>
                        <span class="equipment-status active">Ativo</span>
                    </div>
                    <div class="equipment-item">
                        <input type="checkbox" id="eq5" name="equipment[]" value="5">
                        <label for="eq5">Turbidímetro - TB005</label>
                        <span class="equipment-status inactive">Inativo</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeEquipmentModal()">Cancelar</button>
                <button type="button" class="btn-primary" onclick="saveEquipmentSelection()">Confirmar Seleção</button>
            </div>
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
            const passwordInput = document.getElementById('password');
            
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
                if (/[A-Z]/.test(password)) {
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
                if (/[0-9]/.test(password)) {
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
                if (changePasswordCheckbox.checked) {
                    const password = document.getElementById('password').value;
                    const confirmPassword = document.getElementById('password_confirmation').value;
                    
                    // Check password requirements
                    const hasMinLength = password.length >= 8;
                    const hasUppercase = /[A-Z]/.test(password);
                    const hasLowercase = /[a-z]/.test(password);
                    const hasNumber = /[0-9]/.test(password);
                    
                    if (!hasMinLength || !hasUppercase || !hasLowercase || !hasNumber) {
                        e.preventDefault();
                        alert('Por favor, atenda a todos os requisitos de senha.');
                        return false;
                    }
                    
                    if (password !== confirmPassword) {
                        e.preventDefault();
                        alert('As senhas não coincidem. Por favor, verifique e tente novamente.');
                        return false;
                    }
                }
                
                // Disable submit button to prevent double submission
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Salvando...';
            });

            // CPF mask
            document.getElementById('cpf').addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
            });
        });

        function openEquipmentModal() {
            document.getElementById('equipmentModal').style.display = 'block';
        }

        function closeEquipmentModal() {
            document.getElementById('equipmentModal').style.display = 'none';
        }

        function saveEquipmentSelection() {
            const selectedEquipments = [];
            const checkboxes = document.querySelectorAll('#equipmentModal input[type="checkbox"]:checked');
            
            checkboxes.forEach(checkbox => {
                const label = checkbox.nextElementSibling.textContent;
                selectedEquipments.push({
                    id: checkbox.value,
                    name: label
                });
            });

            const selectedList = document.getElementById('selectedEquipments');
            selectedList.innerHTML = '';
            
            if (selectedEquipments.length > 0) {
                selectedEquipments.forEach(equipment => {
                    const equipmentTag = document.createElement('span');
                    equipmentTag.className = 'equipment-tag';
                    equipmentTag.textContent = equipment.name;
                    selectedList.appendChild(equipmentTag);
                });
            } else {
                selectedList.innerHTML = '<span class="no-equipment">Nenhum equipamento selecionado</span>';
            }

            closeEquipmentModal();
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('equipmentModal');
            if (event.target == modal) {
                closeEquipmentModal();
            }
        }
    </script>
</body>
</html>

