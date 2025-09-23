<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hidro Monitoring - Redefinir Senha</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/assets/ICON/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ Vite::asset('resources/assets/ICON/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ Vite::asset('resources/assets/ICON/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/assets/ICON/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ Vite::asset('resources/assets/ICON/site.webmanifest') }}" />
    @vite(['resources/css/reset-password.css', 'resources/js/reset-password.js'])
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
        <div class="reset-password-card">
            <h2>Redefinir Senha</h2>
            <p>Crie uma nova senha segura para sua conta</p>
            <form id="reset-password-form">
                <div class="input-group">
                    <label for="password">Nova Senha</label>
                    <div class="password-input-container">
                        <input type="password" id="password" name="password" placeholder="Digite sua nova senha" required>
                        <button type="button" class="toggle-password" data-target="password">
                            <span class="eye-icon">👁️</span>
                        </button>
                    </div>
                    <span class="error-message" id="password-error"></span>
                    <div class="password-requirements">
                        <p class="requirements-title">Requisitos da senha:</p>
                        <ul class="requirements-list">
                            <li id="req-length" class="requirement">
                                <span class="req-icon">✗</span>
                                Pelo menos 8 caracteres
                            </li>
                            <li id="req-uppercase" class="requirement">
                                <span class="req-icon">✗</span>
                                Pelo menos 1 letra maiúscula
                            </li>
                            <li id="req-lowercase" class="requirement">
                                <span class="req-icon">✗</span>
                                Pelo menos 1 letra minúscula
                            </li>
                            <li id="req-number" class="requirement">
                                <span class="req-icon">✗</span>
                                Pelo menos 1 número
                            </li>
                            <li id="req-special" class="requirement">
                                <span class="req-icon">✗</span>
                                Pelo menos 1 caractere especial (!@#$%^&*)
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="input-group">
                    <label for="confirm-password">Confirmar Nova Senha</label>
                    <div class="password-input-container">
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirme sua nova senha" required>
                        <button type="button" class="toggle-password" data-target="confirm-password">
                            <span class="eye-icon">👁️</span>
                        </button>
                    </div>
                    <span class="error-message" id="confirm-password-error"></span>
                </div>
                <button type="submit" class="reset-password-btn">Redefinir Senha</button>
            </form>
            <div class="success-message" id="success-message" style="display: none;">
                <p>✓ Senha redefinida com sucesso!</p>
                <p>Você será redirecionado para o login em alguns segundos...</p>
            </div>
            <a href="login.blade.php" class="back-to-login">Voltar ao Login</a>
        </div>
    </div>
</body>
</html>

