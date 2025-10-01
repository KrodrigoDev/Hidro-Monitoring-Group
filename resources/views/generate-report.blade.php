<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gerar Relatório - Hidro-Monitoring</title>
    
    <!-- Tailwind CSS via CDN para garantir que os estilos funcionem -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color: #EBF7F7;">
    <div id="app">
        <generate-report-page></generate-report-page>
    </div>
</body>
</html>

