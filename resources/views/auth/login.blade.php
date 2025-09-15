<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hidro Monitoring</title>
    @vite(['resources/css/login.css'])
</head>
<body>
    <header>
        <img src="../img/contrasteICON.svg" alt="Contraste">
        <p>Alto Contraste</p>
    </header>
    <div class="container">
        <div class="left-panel">
            <img src="../img/logo.svg" alt="Hidro Monitoring Logo">
        </div>
        <div class="right-panel">
            <div class="login-card">
                <h2>Login</h2>
                <p>Faça login em sua conta</p>
                <button class="google-login-btn">
                    <img src="../img/iconeGoogle.svg" alt="iconeGoogle">
                    <span>Login com o Google</span>
                </button>
                <div class="divider">Ou</div>
                <form>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Seu email">
                    </div>
                    <div class="input-group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" placeholder="Sua senha">
                    </div>
                    <button type="submit" class="login-btn">Login</button>
                </form>
                <a href="#" class="forgot-password">Esqueceu sua senha?</a>
                <p class="signup-text">Ainda não possui conta? <a href="#" class="signup-link">Cadastre-se!</a></p>
            </div>
        </div>
    </div>
</body>
</html>
