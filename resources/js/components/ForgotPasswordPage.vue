<template>
  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <div class="flex justify-center">
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
          <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
          </svg>
        </div>
      </div>

      <div class="mt-6 text-center">
        <h2 class="text-3xl font-bold text-[#162C39]">
          Esqueceu sua senha?
        </h2>
        <p class="mt-2 text-sm text-gray-600">
          Primeiro, valide seus dados para continuar.
        </p>
      </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow-sm sm:rounded-lg sm:px-10 border border-gray-100">
        <form @submit.prevent="verifyUserData" class="space-y-6">
          <div>
            <label for="cpf" class="block text-sm font-medium text-gray-700 mb-2">
              CPF
            </label>
            <input
              id="cpf"
              v-model="form.cpf"
              type="text"
              required
              :disabled="isLoading || isVerified"
              class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#162C39] focus:border-[#162C39] disabled:opacity-50 disabled:cursor-not-allowed"
              placeholder="Digite seu CPF"
            >
          </div>
          
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
              E-mail
            </label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              required
              :disabled="isLoading || isVerified"
              class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#162C39] focus:border-[#162C39] disabled:opacity-50 disabled:cursor-not-allowed"
              placeholder="Digite seu e-mail"
            >
            <div v-if="errors.verification" class="mt-2 text-sm text-red-600">
              {{ errors.verification }}
            </div>
          </div>

          <div>
            <button
              v-if="!isVerified"
              type="submit"
              :disabled="isLoading || !form.email || !form.cpf"
              class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#162C39] hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#162C39] disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
            >
              <svg v-if="isLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ isLoading ? 'Verificando...' : 'Verificar Dados' }}
            </button>
            
            <button
              v-if="isVerified"
              @click="submitForgotPassword"
              type="button"
              :disabled="isLoading"
              class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#162C39] hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#162C39] disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
            >
               <svg v-if="isLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ isLoading ? 'Enviando...' : 'Redefinir Senha' }}
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
    </div>

    <div v-if="showSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg max-w-md w-full p-6">
        <div class="text-center">
          <div class="flex justify-center mb-4">
            <div class="bg-green-100 rounded-full p-3">
              <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2">Verifique seu e-mail</h3>
          <p class="text-sm text-gray-600 mb-6">
            Nós enviamos um link de redefinição de senha para<br>
            <strong>{{ form.email }}</strong>
          </p>
          <button @click="closeSuccessModal" class="w-full bg-[#162C39] text-white py-2 px-4 rounded-lg hover:bg-opacity-90 transition-colors">
            Entendido, obrigado!
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ForgotPasswordPage',
  data() {
    return {
      form: {
        cpf: '',
        email: ''
      },
      errors: {},
      isLoading: false,
      isVerified: false,
      showSuccessModal: false
    }
  },
  methods: {
    async verifyUserData() {
      this.errors = {};
      
      if (!this.form.cpf || !this.form.email) {
        this.errors.verification = 'CPF e E-mail são obrigatórios.';
        return;
      }
      
      this.isLoading = true;
      
      try {
        await new Promise(resolve => setTimeout(resolve, 1500));
        
        if (this.form.cpf === "123.456.789-00" && this.form.email === "usuario@exemplo.com") {
          this.isVerified = true;
        } else {
          this.errors.verification = 'CPF e/ou E-mail não encontrados ou não correspondem.';
        }
        
      } catch (error) {
        this.errors.verification = 'Ocorreu um erro ao verificar os dados. Tente novamente.';
      } finally {
        this.isLoading = false;
      }
    },

    async submitForgotPassword() {
      this.isLoading = true;
      
      try {
        await new Promise(resolve => setTimeout(resolve, 2000));
        
        this.showSuccessModal = true;
        
      } catch (error) {
        this.errors.verification = 'Ocorreu um erro ao enviar o link. Por favor, tente novamente.';
      } finally {
        this.isLoading = false;
      }
    },
    
    goBackToLogin() {
      window.location.href = '/';
    },
    
    closeSuccessModal() {
      this.showSuccessModal = false;
      setTimeout(() => {
        this.goBackToLogin();
      }, 500);
    },
  }
}
</script>

<style scoped>

</style>