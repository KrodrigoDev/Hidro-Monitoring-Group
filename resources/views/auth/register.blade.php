<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hidro Monitoring - Cadastro</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/assets/ICON/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ Vite::asset('resources/assets/ICON/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ Vite::asset('resources/assets/ICON/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/assets/ICON/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ Vite::asset('resources/assets/ICON/site.webmanifest') }}" />
    @vite(['resources/css/register.css', 'resources/js/app.js'])
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
        <div class="left-panel">
            <img src="{{ Vite::asset('resources/assets/ICON/logo2.svg') }}" alt="Hidro Monitoring Logo">
        </div>
        <div class="right-panel">
            <div class="register-card">
                <h2>Cadastrar Usuário</h2>
                <form>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="nome-completo">Nome Completo</label>
                            <input type="text" id="nome-completo" placeholder="Seu nome completo">
                        </div>
                        <div class="input-group">
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" placeholder="000.000.000-00">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="data-nascimento">Data de nascimento</label>
                            <input type="date" id="data-nascimento">
                        </div>
                        <div class="input-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" placeholder="seu@email.com">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="empresa">Empresa</label>
                            <input type="text" id="empresa" placeholder="Nome da empresa">
                        </div>
                        <div class="input-group">
                            <label for="permissoes">Permissões</label>
                            <select id="permissoes">
                                <option value="">Selecione as permissões</option>
                                <option value="admin">Administrador</option>
                                <option value="user">Usuário</option>
                                <option value="viewer">Visualizador</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="register-btn">Cadastrar Novo Usuário</button>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>

