<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hidro Monitoring - Esqueci Minha Senha</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/assets/ICON/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ Vite::asset('resources/assets/ICON/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ Vite::asset('resources/assets/ICON/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/assets/ICON/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ Vite::asset('resources/assets/ICON/site.webmanifest') }}" />
    @vite(['resources/css/forgot-password.css', 'resources/js/forgot-password.js'])
</head>
<body>
    <header>
        <button class="return-btn mr-auto" onclick="window.location.href='login.blade.php'">
            <img src="{{ Vite::asset('resources/assets/ICON/returnICON.svg') }}" alt="Return">
        </button>
        <img src="{{ Vite::asset('resources/assets/ICON/contrasteICON.svg') }}" alt="Contraste">
        <p>Alto Contraste</p>
    </header>
    <div class="container">
        <div class="left-panel">
            <img src="{{ Vite::asset('resources/assets/ICON/logo1.svg') }}" alt="Hidro Monitoring Logo">
        </div>
        <div class="right-panel">
            <div class="forgot-password-card">
                <h2>Esqueci Minha Senha</h2>
                <p>Digite seu CPF e e-mail para receber o link de recuperação</p>
                <form id="forgot-password-form">
                    <div class="input-group">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="14" required>
                        <span class="error-message" id="cpf-error"></span>
                    </div>
                    <div class="input-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                        <span class="error-message" id="email-error"></span>
                    </div>
                    <button type="submit" class="forgot-password-btn">Enviar Link de Recuperação</button>
                </form>
                <div class="success-message" id="success-message" style="display: none;">
                    <p>✓ Link de recuperação enviado para seu e-mail!</p>
                </div>
                <a href="login.blade.php" class="back-to-login">Voltar ao Login</a>
            </div>
        </div>
    </div>
</body>
</html>

