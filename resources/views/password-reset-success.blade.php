<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Senha redefinida com sucesso - Hidro-Monitoring</title>
    
    <!-- Tailwind CSS via CDN para garantir que os estilos funcionem -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div id="app">
        <password-reset-success-page></password-reset-success-page>
    </div>
</body>
</html>

