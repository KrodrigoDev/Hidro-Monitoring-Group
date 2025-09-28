<template>
  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <div class="flex justify-center">
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
          <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
      </div>

      <div class="mt-6 text-center">
        <h2 class="text-3xl font-bold text-[#162C39]">
          Senha redefinida
        </h2>
        <p class="mt-2 text-sm text-gray-600">
          Sua senha foi redefinida com sucesso.<br>
          Clique abaixo para fazer o login.
        </p>
      </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow-sm sm:rounded-lg sm:px-10 border border-gray-100">
        <div class="space-y-6">
          <button
            @click="continueToLogin"
            :disabled="isRedirecting"
            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#162C39] hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#162C39] disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
          >
            <svg v-if="isRedirecting" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ isRedirecting ? 'Redirecionando...' : 'Continuar' }}
          </button>
        </div>

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
        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
        <div class="w-2 h-2 bg-[#162C39] rounded-full"></div>
      </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-start">
          <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <div class="ml-3">
            <h3 class="text-sm font-medium text-green-800">
              Dicas de Segurança
            </h3>
            <div class="mt-2 text-sm text-green-700">
              <ul class="list-disc list-inside space-y-1">
                <li>Mantenha sua nova senha segura e não a compartilhe</li>
                <li>Considere usar um gerenciador de senhas</li>
                <li>Saia de dispositivos compartilhados ou públicos</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="showCountdown" class="mt-6 text-center">
      <p class="text-sm text-gray-500">
        Redirecionando para o login em {{ countdown }} segundos...
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PasswordResetSuccessPage',
  data() {
    return {
      isRedirecting: false,
      showCountdown: false,
      countdown: 10,
      countdownInterval: null
    }
  },
  mounted() {
    // Opcional: Inicia o redirecionamento automático
    // this.startAutoRedirect();
  },
  beforeUnmount() {
    // Limpa o intervalo se o componente for destruído
    if (this.countdownInterval) {
      clearInterval(this.countdownInterval);
    }
  },
  methods: {
    continueToLogin() {
      this.isRedirecting = true;
      
      // Adiciona um pequeno atraso para melhor UX
      setTimeout(() => {
        this.goBackToLogin();
      }, 1000);
    },
    
    goBackToLogin() {
      // Navega de volta para a página de login
      window.location.href = '/';
    },
    
    startAutoRedirect() {
      this.showCountdown = true;
      
      this.countdownInterval = setInterval(() => {
        this.countdown--;
        
        if (this.countdown <= 0) {
          clearInterval(this.countdownInterval);
          this.goBackToLogin();
        }
      }, 1000);
    },
    
    stopAutoRedirect() {
      if (this.countdownInterval) {
        clearInterval(this.countdownInterval);
        this.showCountdown = false;
      }
    }
  }
}
</script>

<style scoped>

</style>