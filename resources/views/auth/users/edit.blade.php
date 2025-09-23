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
                                class="form-control" 
                                value="BRK AMBIENTAL"
                                readonly
                                style="background-color: #f5f5f5; cursor: not-allowed;"
                            >
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
                                <option value="1" {{ old('role', $user->role) == '1' ? 'selected' : '' }}>Nível 1 - Visualização</option>
                                <option value="2" {{ old('role', $user->role) == '2' ? 'selected' : '' }}>Nível 2 - Operacional</option>
                                <option value="3" {{ old('role', $user->role) == '3' ? 'selected' : '' }}>Nível 3 - Gestor</option>
                                <option value="3_extra" {{ old('role', $user->role) == '3_extra' ? 'selected' : '' }}>Nível 3 - Gestor com Permissão Extra</option>
                            </select>
                            @error('role')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-group">
                            <label for="estado">Estado</label>
                            <select 
                                id="estado" 
                                name="estado" 
                                class="form-control {{ $errors->has('estado') ? 'error' : '' }}"
                                required
                                onchange="loadMunicipios()"
                            >
                                <option value="">Selecione o estado</option>
                                <!-- Estados serão carregados dinamicamente -->
                            </select>
                            @error('estado')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="municipio">Município</label>
                            <select 
                                id="municipio" 
                                name="municipio" 
                                class="form-control {{ $errors->has('municipio') ? 'error' : '' }}"
                                required
                                onchange="loadUnidades()"
                                disabled
                            >
                                <option value="">Selecione o município</option>
                            </select>
                            @error('municipio')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-group">
                            <label for="unidades">Unidades de Acesso</label>
                            <button type="button" class="equipment-btn" onclick="openUnidadesModal()" id="unidadesBtn">
                                Gerenciar Unidades
                            </button>
                            <div id="selectedUnidades" class="selected-equipment-list">
                                <!-- Unidades já vinculadas serão exibidas aqui -->
                                <span class="equipment-tag">ETA Guarapiranga</span>
                                <span class="equipment-tag">ETA Cantareira</span>
                            </div>
                            @error('unidades')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
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

                    <!-- Alteração de senha removida - usar opção "Esqueci minha senha" no login -->

                    <button type="submit" class="edit-btn" id="submitBtn">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Unidades -->
    <div id="unidadesModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Gerenciar Unidades de Acesso</h3>
                <span class="close" onclick="closeUnidadesModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="filters-modal">
                    <div class="form-group">
                        <label for="filterMunicipio">Filtrar por Município:</label>
                        <select id="filterMunicipio" onchange="filterUnidadesByMunicipio()">
                            <option value="">Todos os municípios</option>
                        </select>
                    </div>
                </div>
                <div class="unidades-list" id="unidadesList">
                    <!-- Lista de unidades será carregada aqui dinamicamente -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeUnidadesModal()">Cancelar</button>
                <button type="button" class="btn-primary" onclick="saveUnidadesSelection()">Confirmar Seleção</button>
            </div>
        </div>
    </div>

    <script>
        let estados = [];
        let municipios = [];
        let unidades = [];
        let selectedUnidades = [1, 2]; // IDs das unidades já vinculadas ao usuário

        document.addEventListener('DOMContentLoaded', function() {
            const statusToggle = document.getElementById('statusToggle');
            const statusLabel = document.getElementById('statusLabel');
            const statusInput = document.getElementById('statusInput');
            const submitBtn = document.getElementById('submitBtn');
            
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

            // Carregar dados iniciais
            loadEstados();
            checkUserPermissions();
            loadUserUnidades();
        });

        function loadEstados() {
            // Simulação de dados - em produção, fazer requisição AJAX
            estados = [
                {id: 1, nome: 'São Paulo', uf: 'SP'},
                {id: 2, nome: 'Rio de Janeiro', uf: 'RJ'},
                {id: 3, nome: 'Minas Gerais', uf: 'MG'},
                {id: 4, nome: 'Bahia', uf: 'BA'}
            ];

            const estadoSelect = document.getElementById('estado');
            estadoSelect.innerHTML = '<option value="">Selecione o estado</option>';
            
            estados.forEach(estado => {
                const option = document.createElement('option');
                option.value = estado.id;
                option.textContent = `${estado.nome} (${estado.uf})`;
                estadoSelect.appendChild(option);
            });

            // Pré-selecionar estado do usuário (simulação)
            estadoSelect.value = 1;
            loadMunicipios();
        }

        function loadMunicipios() {
            const estadoId = document.getElementById('estado').value;
            const municipioSelect = document.getElementById('municipio');
            
            if (!estadoId) {
                municipioSelect.innerHTML = '<option value="">Selecione o município</option>';
                municipioSelect.disabled = true;
                return;
            }

            // Simulação de dados - em produção, fazer requisição AJAX
            municipios = [
                {id: 1, nome: 'São Paulo', estado_id: 1},
                {id: 2, nome: 'Campinas', estado_id: 1},
                {id: 3, nome: 'Santos', estado_id: 1},
                {id: 4, nome: 'Rio de Janeiro', estado_id: 2},
                {id: 5, nome: 'Niterói', estado_id: 2}
            ].filter(municipio => municipio.estado_id == estadoId);

            municipioSelect.innerHTML = '<option value="">Selecione o município</option>';
            municipios.forEach(municipio => {
                const option = document.createElement('option');
                option.value = municipio.id;
                option.textContent = municipio.nome;
                municipioSelect.appendChild(option);
            });

            municipioSelect.disabled = false;
            // Pré-selecionar município do usuário (simulação)
            municipioSelect.value = 1;
            loadUnidades();
        }

        function loadUnidades() {
            const municipioId = document.getElementById('municipio').value;
            
            if (!municipioId) {
                return;
            }

            // Simulação de dados - em produção, fazer requisição AJAX
            unidades = [
                {id: 1, nome: 'ETA Guarapiranga', municipio_id: 1},
                {id: 2, nome: 'ETA Cantareira', municipio_id: 1},
                {id: 3, nome: 'ETA Campinas Centro', municipio_id: 2},
                {id: 4, nome: 'ETA Santos Litoral', municipio_id: 3}
            ].filter(unidade => unidade.municipio_id == municipioId);
        }

        function loadUserUnidades() {
            // Carregar unidades já vinculadas ao usuário
            const selectedList = document.getElementById('selectedUnidades');
            selectedList.innerHTML = '';
            
            if (selectedUnidades.length > 0) {
                // Simulação - em produção, buscar nomes das unidades do backend
                const unidadeNames = ['ETA Guarapiranga', 'ETA Cantareira'];
                unidadeNames.forEach(nome => {
                    const unidadeTag = document.createElement('span');
                    unidadeTag.className = 'equipment-tag';
                    unidadeTag.textContent = nome;
                    selectedList.appendChild(unidadeTag);
                });
            } else {
                selectedList.innerHTML = '<span class="no-equipment">Nenhuma unidade vinculada</span>';
            }
        }

        function checkUserPermissions() {
            // Verificar permissões do usuário logado
            const userLevel = 3; // Simulação - pegar do backend
            const hasExtraAccess = true; // Simulação - pegar do backend

            const roleSelect = document.getElementById('role');
            
            if (userLevel === 3 && !hasExtraAccess) {
                // Usuário nível 3 normal só pode editar usuários nível 1 e 2
                roleSelect.innerHTML = `
                    <option value="">Selecione as permissões</option>
                    <option value="1">Nível 1 - Visualização</option>
                    <option value="2">Nível 2 - Operacional</option>
                `;
            }
        }

        function openUnidadesModal() {
            const modal = document.getElementById('unidadesModal');
            
            // Carregar unidades no modal
            const unidadesList = document.getElementById('unidadesList');
            unidadesList.innerHTML = '';

            unidades.forEach(unidade => {
                const unidadeItem = document.createElement('div');
                unidadeItem.className = 'equipment-item';
                unidadeItem.innerHTML = `
                    <input type="checkbox" id="unidade_${unidade.id}" name="unidades[]" value="${unidade.id}" 
                           ${selectedUnidades.includes(unidade.id) ? 'checked' : ''}>
                    <label for="unidade_${unidade.id}">${unidade.nome}</label>
                `;
                unidadesList.appendChild(unidadeItem);
            });

            // Carregar municípios no filtro
            const filterMunicipio = document.getElementById('filterMunicipio');
            filterMunicipio.innerHTML = '<option value="">Todos os municípios</option>';
            municipios.forEach(municipio => {
                const option = document.createElement('option');
                option.value = municipio.id;
                option.textContent = municipio.nome;
                filterMunicipio.appendChild(option);
            });

            modal.style.display = 'block';
        }

        function closeUnidadesModal() {
            document.getElementById('unidadesModal').style.display = 'none';
        }

        function filterUnidadesByMunicipio() {
            const filterValue = document.getElementById('filterMunicipio').value;
            const unidadeItems = document.querySelectorAll('#unidadesList .equipment-item');
            
            unidadeItems.forEach(item => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                const unidadeId = parseInt(checkbox.value);
                const unidade = unidades.find(u => u.id === unidadeId);
                
                if (!filterValue || unidade.municipio_id == filterValue) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function saveUnidadesSelection() {
            const checkboxes = document.querySelectorAll('#unidadesModal input[type="checkbox"]:checked');
            selectedUnidades = Array.from(checkboxes).map(cb => parseInt(cb.value));
            
            const selectedList = document.getElementById('selectedUnidades');
            selectedList.innerHTML = '';
            
            if (selectedUnidades.length > 0) {
                selectedUnidades.forEach(unidadeId => {
                    const unidade = unidades.find(u => u.id === unidadeId);
                    const unidadeTag = document.createElement('span');
                    unidadeTag.className = 'equipment-tag';
                    unidadeTag.textContent = unidade.nome;
                    selectedList.appendChild(unidadeTag);
                });
            } else {
                selectedList.innerHTML = '<span class="no-equipment">Nenhuma unidade selecionada</span>';
            }

            closeUnidadesModal();
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('unidadesModal');
            if (event.target == modal) {
                closeUnidadesModal();
            }
        }
    </script>
</body>
</html>
