document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reset-password-form');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const passwordError = document.getElementById('password-error');
    const confirmPasswordError = document.getElementById('confirm-password-error');
    const successMessage = document.getElementById('success-message');
    
    // Elementos dos requisitos
    const reqLength = document.getElementById('req-length');
    const reqUppercase = document.getElementById('req-uppercase');
    const reqLowercase = document.getElementById('req-lowercase');
    const reqNumber = document.getElementById('req-number');
    const reqSpecial = document.getElementById('req-special');

    // Botões de mostrar/ocultar senha
    const toggleButtons = document.querySelectorAll('.toggle-password');

    // Função para alternar visibilidade da senha
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);
            const eyeIcon = this.querySelector('.eye-icon');
            
            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                eyeIcon.textContent = '🙈';
            } else {
                targetInput.type = 'password';
                eyeIcon.textContent = '👁️';
            }
        });
    });

    // Validação de requisitos da senha
    function validatePasswordRequirements(password) {
        const requirements = {
            length: password.length >= 8,
            uppercase: /[A-Z]/.test(password),
            lowercase: /[a-z]/.test(password),
            number: /\d/.test(password),
            special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
        };

        // Atualizar visual dos requisitos
        updateRequirement(reqLength, requirements.length);
        updateRequirement(reqUppercase, requirements.uppercase);
        updateRequirement(reqLowercase, requirements.lowercase);
        updateRequirement(reqNumber, requirements.number);
        updateRequirement(reqSpecial, requirements.special);

        return Object.values(requirements).every(req => req);
    }

    function updateRequirement(element, isValid) {
        if (isValid) {
            element.classList.add('valid');
        } else {
            element.classList.remove('valid');
        }
    }

    // Validação em tempo real da senha
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const isValid = validatePasswordRequirements(password);
        
        if (password.length > 0) {
            if (isValid) {
                this.classList.remove('error');
                this.classList.add('valid');
                passwordError.textContent = '';
            } else {
                this.classList.add('error');
                this.classList.remove('valid');
            }
        } else {
            this.classList.remove('error', 'valid');
            passwordError.textContent = '';
        }

        // Validar confirmação de senha se já foi preenchida
        if (confirmPasswordInput.value) {
            validatePasswordMatch();
        }
    });

    // Validação de confirmação de senha
    function validatePasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (confirmPassword.length > 0) {
            if (password === confirmPassword) {
                confirmPasswordInput.classList.remove('error');
                confirmPasswordInput.classList.add('valid');
                confirmPasswordError.textContent = '';
                return true;
            } else {
                confirmPasswordInput.classList.add('error');
                confirmPasswordInput.classList.remove('valid');
                confirmPasswordError.textContent = 'As senhas não coincidem';
                return false;
            }
        }
        return false;
    }

    confirmPasswordInput.addEventListener('input', validatePasswordMatch);

    // Submissão do formulário
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        let isValid = true;

        // Validar senha
        if (!password) {
            passwordError.textContent = 'Senha é obrigatória';
            passwordInput.classList.add('error');
            isValid = false;
        } else if (!validatePasswordRequirements(password)) {
            passwordError.textContent = 'A senha não atende aos requisitos mínimos';
            passwordInput.classList.add('error');
            isValid = false;
        } else {
            passwordError.textContent = '';
            passwordInput.classList.remove('error');
            passwordInput.classList.add('valid');
        }

        // Validar confirmação de senha
        if (!confirmPassword) {
            confirmPasswordError.textContent = 'Confirmação de senha é obrigatória';
            confirmPasswordInput.classList.add('error');
            isValid = false;
        } else if (password !== confirmPassword) {
            confirmPasswordError.textContent = 'As senhas não coincidem';
            confirmPasswordInput.classList.add('error');
            isValid = false;
        } else {
            confirmPasswordError.textContent = '';
            confirmPasswordInput.classList.remove('error');
            confirmPasswordInput.classList.add('valid');
        }

        if (isValid) {
            // Simular envio do formulário
            const submitBtn = form.querySelector('.reset-password-btn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Redefinindo...';

            // Simular delay de envio
            setTimeout(() => {
                form.style.display = 'none';
                successMessage.style.display = 'block';
                
                // Redirecionar para login após 3 segundos
                setTimeout(() => {
                    window.location.href = 'login.blade.php';
                }, 3000);
                
                // Aqui você faria a requisição real para o backend
                console.log('Nova senha definida com sucesso');
            }, 2000);
        }
    });

    // Inicializar validação dos requisitos (todos como não atendidos)
    validatePasswordRequirements('');
});

