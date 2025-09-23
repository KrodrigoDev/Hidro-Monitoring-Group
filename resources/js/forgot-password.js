document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('forgot-password-form');
    const cpfInput = document.getElementById('cpf');
    const emailInput = document.getElementById('email');
    const cpfError = document.getElementById('cpf-error');
    const emailError = document.getElementById('email-error');
    const successMessage = document.getElementById('success-message');

    // Máscara para CPF
    cpfInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = value;
    });

    // Validação de CPF
    function validateCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, '');
        
        if (cpf.length !== 11) return false;
        
        // Verifica se todos os dígitos são iguais
        if (/^(\d)\1{10}$/.test(cpf)) return false;
        
        // Validação do primeiro dígito verificador
        let sum = 0;
        for (let i = 0; i < 9; i++) {
            sum += parseInt(cpf.charAt(i)) * (10 - i);
        }
        let remainder = (sum * 10) % 11;
        if (remainder === 10 || remainder === 11) remainder = 0;
        if (remainder !== parseInt(cpf.charAt(9))) return false;
        
        // Validação do segundo dígito verificador
        sum = 0;
        for (let i = 0; i < 10; i++) {
            sum += parseInt(cpf.charAt(i)) * (11 - i);
        }
        remainder = (sum * 10) % 11;
        if (remainder === 10 || remainder === 11) remainder = 0;
        if (remainder !== parseInt(cpf.charAt(10))) return false;
        
        return true;
    }

    // Validação de email
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Validação em tempo real
    cpfInput.addEventListener('blur', function() {
        const cpfValue = this.value;
        if (cpfValue && !validateCPF(cpfValue)) {
            cpfError.textContent = 'CPF inválido';
            this.classList.add('error');
        } else {
            cpfError.textContent = '';
            this.classList.remove('error');
        }
    });

    emailInput.addEventListener('blur', function() {
        const emailValue = this.value;
        if (emailValue && !validateEmail(emailValue)) {
            emailError.textContent = 'E-mail inválido';
            this.classList.add('error');
        } else {
            emailError.textContent = '';
            this.classList.remove('error');
        }
    });

    // Submissão do formulário
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const cpfValue = cpfInput.value;
        const emailValue = emailInput.value;
        let isValid = true;

        // Validar CPF
        if (!cpfValue) {
            cpfError.textContent = 'CPF é obrigatório';
            cpfInput.classList.add('error');
            isValid = false;
        } else if (!validateCPF(cpfValue)) {
            cpfError.textContent = 'CPF inválido';
            cpfInput.classList.add('error');
            isValid = false;
        } else {
            cpfError.textContent = '';
            cpfInput.classList.remove('error');
        }

        // Validar email
        if (!emailValue) {
            emailError.textContent = 'E-mail é obrigatório';
            emailInput.classList.add('error');
            isValid = false;
        } else if (!validateEmail(emailValue)) {
            emailError.textContent = 'E-mail inválido';
            emailInput.classList.add('error');
            isValid = false;
        } else {
            emailError.textContent = '';
            emailInput.classList.remove('error');
        }

        if (isValid) {
            // Simular envio do formulário
            const submitBtn = form.querySelector('.forgot-password-btn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Enviando...';

            // Simular delay de envio
            setTimeout(() => {
                form.style.display = 'none';
                successMessage.style.display = 'block';
                
                // Aqui você faria a requisição real para o backend
                console.log('Dados enviados:', {
                    cpf: cpfValue,
                    email: emailValue
                });
            }, 2000);
        }
    });
});

