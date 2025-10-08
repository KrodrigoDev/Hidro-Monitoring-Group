<template>
  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <div class="flex justify-center">
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
          <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
          </svg>
        </div>
      </div>

      <div class="mt-6 text-center">
        <h2 class="text-3xl font-bold text-[#162C39]">
          Definir nova senha
        </h2>
        <p class="mt-2 text-sm text-gray-600">
          Sua nova senha deve ser diferente das<br>
          senhas usadas anteriormente.
        </p>
      </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow-sm sm:rounded-lg sm:px-10 border border-gray-100">
        <form @submit.prevent="submitResetPassword" class="space-y-6">
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
              Senha
            </label>
            <div class="relative">
              <input
                id="password"
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                required
                :disabled="isLoading"
                @input="validatePassword"
                class="appearance-none block w-full px-3 py-3 pr-10 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#162C39] focus:border-[#162C39] disabled:opacity-50 disabled:cursor-not-allowed"
                placeholder="••••••••"
              >
              <button
                type="button"
                @click="showPassword = !showPassword"
                class="absolute inset-y-0 right-0 pr-3 flex items-center"
              >
                <svg v-if="showPassword" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                </svg>
                <svg v-else class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
              </button>
            </div>
            <div v-if="errors.password" class="mt-1 text-sm text-red-600">
              {{ errors.password }}
            </div>
          </div>

          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
              Confirmar senha
            </label>
            <div class="relative">
              <input
                id="password_confirmation"
                v-model="form.password_confirmation"
                :type="showConfirmPassword ? 'text' : 'password'"
                required
                :disabled="isLoading"
                @input="validatePasswordConfirmation"
                class="appearance-none block w-full px-3 py-3 pr-10 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#162C39] focus:border-[#162C39] disabled:opacity-50 disabled:cursor-not-allowed"
                placeholder="••••••••"
              >
              <button
                type="button"
                @click="showConfirmPassword = !showConfirmPassword"
                class="absolute inset-y-0 right-0 pr-3 flex items-center"
              >
                <svg v-if="showConfirmPassword" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                </svg>
                <svg v-else class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
              </button>
            </div>
            <div v-if="errors.password_confirmation" class="mt-1 text-sm text-red-600">
              {{ errors.password_confirmation }}
            </div>
          </div>

          <div class="space-y-2">
            <div class="flex items-center space-x-2">
              <div :class="passwordValidation.minLength ? 'bg-green-500' : 'bg-gray-300'" class="w-4 h-4 rounded-full flex items-center justify-center">
                <svg v-if="passwordValidation.minLength" class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <span :class="passwordValidation.minLength ? 'text-green-600' : 'text-gray-500'" class="text-sm">
                Deve ter no mínimo 8 caracteres
              </span>
            </div>
            
            <div class="flex items-center space-x-2">
              <div :class="passwordValidation.hasSpecialChar ? 'bg-green-500' : 'bg-gray-300'" class="w-4 h-4 rounded-full flex items-center justify-center">
                <svg v-if="passwordValidation.hasSpecialChar" class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <span :class="passwordValidation.hasSpecialChar ? 'text-green-600' : 'text-gray-500'" class="text-sm">
                Deve conter um caractere especial
              </span>
            </div>
          </div>

          <div>
            <button
              type="submit"
              :disabled="isLoading || !isFormValid"
              class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#162C39] hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#162C39] disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
            >
              <svg v-if="isLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ isLoading ? 'Redefinindo...' : 'Redefinir senha' }}
            </button>
          </div>
        </form>

        <div class="mt-6">
          <div class="text-center">
            <button
              @click="goBackToLogin"
              class="text-sm text-gray-600 hover:text-gray-900 flex items-center justify-center space-x-2 transition-colors w-full"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
              </svg>
              <span>Voltar para o login</span>
            </button>
          </div>
        </div>
      </div>

      <div class="mt-8 flex justify-center space-x-2">
        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
        <div class="w-2 h-2 bg-[#162C39] rounded-full"></div>
        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ResetPasswordPage',
  data() {
    return {
      form: {
        password: '',
        password_confirmation: '',
        token: '', // Viria do parâmetro da URL
        email: ''  // Viria do parâmetro da URL
      },
      errors: {},
      isLoading: false,
      showPassword: false,
      showConfirmPassword: false,
      passwordValidation: {
        minLength: false,
        hasSpecialChar: false
      }
    }
  },
  computed: {
    isFormValid() {
      return this.passwordValidation.minLength && 
             this.passwordValidation.hasSpecialChar && 
             this.form.password === this.form.password_confirmation &&
             this.form.password.length > 0 &&
             this.form.password_confirmation.length > 0;
    }
  },
  mounted() {
    // Extrai o token e o email dos parâmetros da URL
    const urlParams = new URLSearchParams(window.location.search);
    this.form.token = urlParams.get('token') || '';
    this.form.email = urlParams.get('email') || '';
  },
  methods: {
    validatePassword() {
      const password = this.form.password;
      
      this.passwordValidation.minLength = password.length >= 8;
      
      const specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
      this.passwordValidation.hasSpecialChar = specialCharRegex.test(password);
      
      if (this.passwordValidation.minLength && this.passwordValidation.hasSpecialChar) {
        delete this.errors.password;
      }
      
      if (this.form.password_confirmation) {
        this.validatePasswordConfirmation();
      }
    },
    
    validatePasswordConfirmation() {
      if (this.form.password !== this.form.password_confirmation) {
        this.errors.password_confirmation = 'As senhas não coincidem';
      } else {
        delete this.errors.password_confirmation;
      }
    },
    
    async submitResetPassword() {
      this.errors = {};
      
      if (!this.form.password) {
        this.errors.password = 'A senha é obrigatória';
        return;
      }
      
      if (!this.passwordValidation.minLength) {
        this.errors.password = 'A senha deve ter no mínimo 8 caracteres';
        return;
      }
      
      if (!this.passwordValidation.hasSpecialChar) {
        this.errors.password = 'A senha deve conter pelo menos um caractere especial';
        return;
      }
      
      if (this.form.password !== this.form.password_confirmation) {
        this.errors.password_confirmation = 'As senhas não coincidem';
        return;
      }
      
      if (!this.form.token) {
        this.errors.password = 'Token de redefinição inválido';
        return;
      }
      
      this.isLoading = true;
      
      try {
        await new Promise(resolve => setTimeout(resolve, 2000));
        
        // Chamada de API real para redefinir a senha
        // const response = await axios.post('/api/password/reset', this.form);
        
        window.location.href = '/password-reset-success';
        
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.errors = error.response.data.errors;
        } else if (error.response && error.response.status === 400) {
          this.errors.password = 'Token de redefinição inválido ou expirado';
        } else {
          this.errors.password = 'Ocorreu um erro. Por favor, tente novamente.';
        }
      } finally {
        this.isLoading = false;
      }
    },
    
    goBackToLogin() {
      window.location.href = '/';
    }
  }
}
</script>

<style scoped>

</style>