<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/assets/ICON/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ Vite::asset('resources/assets/ICON/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ Vite::asset('resources/assets/ICON/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/assets/ICON/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ Vite::asset('resources/assets/ICON/site.webmanifest') }}" />
    @vite(['resources/css/user-management.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <button class="return-btn">
            <img src="{{ Vite::asset('resources/assets/ICON/returnICON.svg') }}" alt="Return">
        </button>
        <img src="{{ Vite::asset('resources/assets/ICON/contrasteICON.svg') }}" alt="Contraste">
        <p>Alto Contraste</p>
    </header>
    <div class="container">
        <h1 class="user-list">Listagem de Usuários</h1>
        <div class="user-card">
            <div class="user-card-header">
                <h3 class="usard-card-title">Usuário 01</h3>
            </div>
            
            <div class="user-card-info">
                <p><strong>Data de criação do usuário:</strong> 11/12/2012</p>
                <p><strong>Nome do Usuário:</strong> Alessandro</p>
                <p><strong>Nível de acesso:</strong> Servidor</p>
                <p><strong>Quantidade de equipamentos vinculados ao usuário:</strong> 5</p>
            </div>
            <div class="user-card-actions">
                <button class="btn-edit">Editar</button>
                <button class="btn-delete">Excluir</button>
            </div>
        </div>
    </div>
</body>
</html>