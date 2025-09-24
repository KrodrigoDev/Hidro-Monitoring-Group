<template>
  <div class="min-h-screen bg-white p-0">
    <header>
      <button class="return-btn mr-auto" @click="goBack"></button>
      <img :src="contrasteIcon" alt="Contraste">
      <p>Alto Contraste</p>
    </header>

    <div class="p-6">
      <div class="max-w-4xl mx-auto">
        <div class="bg-[#EBF7F7] rounded-lg shadow-lg p-6 mb-6">
          <div class="flex items-center space-x-4">
            <div class="bg-white p-3 rounded-full">
              <svg class="w-8 h-8 text-[#162C39]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 11-9.75 9.75A9.75 9.75 0 0112 2.25z"></path>
              </svg>
            </div>
            <div>
              <h1 class="text-3xl font-bold text-[#162C39]">Central de Suporte</h1>
              <p class="text-gray-600">Abra chamados de suporte técnico e acompanhe suas solicitações</p>
            </div>
          </div>
        </div>

        <div class="bg-[#EBF7F7] rounded-lg shadow-lg p-6">
          <h2 class="text-2xl font-bold text-[#162C39] mb-6">Abrir Novo Chamado</h2>
          
          <form @submit.prevent="submitTicket" class="space-y-6">
            <div>
              <label for="motivo" class="block text-sm font-medium text-gray-700 mb-2">
                Motivo da Solicitação *
              </label>
              <select 
                id="motivo" 
                v-model="form.motivo" 
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
                <option value="">Selecione o motivo</option>
                <option value="problema_tecnico">Problema Técnico</option>
                <option value="manutencao_equipamento">Manutenção de Equipamento</option>
                <option value="falha_sistema">Falha no Sistema</option>
                <option value="duvida_operacional">Dúvida Operacional</option>
                <option value="solicitacao_acesso">Solicitação de Acesso</option>
                <option value="treinamento">Treinamento</option>
                <option value="outros">Outros</option>
              </select>
            </div>

            <div>
              <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">
                Descrição Detalhada *
              </label>
              <textarea 
                id="descricao" 
                v-model="form.descricao" 
                required
                rows="6"
                placeholder="Descreva detalhadamente o problema ou solicitação. Inclua informações como: quando ocorreu, equipamentos envolvidos, mensagens de erro, etc."
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              ></textarea>
              <p class="mt-1 text-sm text-gray-500">Mínimo de 20 caracteres</p>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Anexos (Opcional)
              </label>
              <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                <input 
                  type="file" 
                  @change="handleFileUpload" 
                  multiple 
                  accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                  class="hidden" 
                  ref="fileInput"
                >
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                  <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="mt-4">
                  <button 
                    type="button" 
                    @click="$refs.fileInput.click()"
                    class="bg-[#162C39] text-white px-4 py-2 rounded-md hover:bg-[#102029] transition-colors"
                  >
                    Selecionar Arquivos
                  </button>
                  <p class="mt-2 text-sm text-gray-500">
                    PDF, DOC, DOCX, JPG, PNG até 10MB cada
                  </p>
                </div>
              </div>
              
              <div v-if="form.anexos.length > 0" class="mt-4">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Arquivos Selecionados:</h4>
                <div class="space-y-2">
                  <div 
                    v-for="(file, index) in form.anexos" 
                    :key="index"
                    class="flex items-center justify-between bg-gray-50 p-3 rounded-md"
                  >
                    <div class="flex items-center space-x-3">
                      <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                      </svg>
                      <span class="text-sm text-gray-900">{{ file.name }}</span>
                      <span class="text-xs text-gray-500">({{ formatFileSize(file.size) }})</span>
                    </div>
                    <button 
                      type="button" 
                      @click="removeFile(index)"
                      class="text-red-600 hover:text-red-800"
                    >
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="flex justify-end space-x-4 pt-6 border-t">
              <button 
                type="button" 
                @click="resetForm"
                class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors"
              >
                Cancelar
              </button>
              <button 
                type="submit" 
                :disabled="isSubmitting"
                class="px-6 py-2 bg-[#162C39] text-white rounded-md hover:bg-[#102029] disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
              >
                <span v-if="isSubmitting">Enviando...</span>
                <span v-else>Abrir Chamado</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div v-if="showSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-[#EBF7F7] rounded-lg p-6 max-w-md mx-4">
        <div class="text-center">
          <div class="bg-green-100 p-3 rounded-full w-16 h-16 mx-auto mb-4">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2">Chamado Aberto com Sucesso!</h3>
          <p class="text-gray-600 mb-4">
            Seu chamado foi registrado com o número <strong>#{{ ticketNumber }}</strong>. 
            Nossa equipe entrará em contato em breve.
          </p>
          <button 
            @click="closeSuccessModal"
            class="bg-[#162C39] text-white px-6 py-2 rounded-md hover:bg-[#102029] transition-colors"
          >
            Fechar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// Importa o ícone para que o Vite possa processá-lo
import contrasteIcon from '../../assets/ICON/contrasteICON.svg';

export default {
  name: 'SupportPage',
  // Adiciona a 'prop' para receber a URL de retorno do Laravel
  props: {
    backUrl: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      contrasteIcon: contrasteIcon, // Disponibiliza o ícone para o template
      activeTickets: 3,
      isSubmitting: false,
      showSuccessModal: false,
      ticketNumber: '',
      form: {
        motivo: '',
        descricao: '',
        anexos: []
      }
    }
  },
  methods: {
    // Método para o botão de retorno
    goBack() {
      window.location.href = this.backUrl;
    },
    handleFileUpload(event) {
      const files = Array.from(event.target.files);
      const maxSize = 10 * 1024 * 1024; // 10MB
      const allowedTypes = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'image/jpeg',
        'image/jpg',
        'image/png'
      ];

      files.forEach(file => {
        if (file.size > maxSize) {
          alert(`O arquivo ${file.name} é muito grande. Tamanho máximo: 10MB`);
          return;
        }

        if (!allowedTypes.includes(file.type)) {
          alert(`Tipo de arquivo não permitido: ${file.name}`);
          return;
        }

        this.form.anexos.push(file);
      });

      event.target.value = '';
    },
    removeFile(index) {
      this.form.anexos.splice(index, 1);
    },
    formatFileSize(bytes) {
      if (bytes === 0) return '0 Bytes';
      const k = 1024;
      const sizes = ['Bytes', 'KB', 'MB', 'GB'];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    },
    async submitTicket() {
      if (this.form.descricao.length < 20) {
        alert('A descrição deve ter pelo menos 20 caracteres.');
        return;
      }

      this.isSubmitting = true;

      try {
        await new Promise(resolve => setTimeout(resolve, 2000));
        this.ticketNumber = 'HM' + Date.now().toString().slice(-6);
        this.showSuccessModal = true;
        this.resetForm();
      } catch (error) {
        alert('Erro ao enviar chamado. Tente novamente.');
      } finally {
        this.isSubmitting = false;
      }
    },
    resetForm() {
      this.form = {
        motivo: '',
        descricao: '',
        anexos: []
      };
    },
    closeSuccessModal() {
      this.showSuccessModal = false;
    }
  }
}
</script>

<style scoped>
/* CSS adicionado e caminhos corrigidos */
header {
  width: 100%; 
  height: 64px;
  padding: 15px 30px;
  display: flex;
  justify-content: right;
  gap: 5px;
  align-items: center;
  background-color: #EBF7F7;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  box-sizing: border-box; 
}

.return-btn.mr-auto {
  width: 40px;
  height: 40px;
  border: none;
  background-color: transparent;
  cursor: pointer;
  background-repeat: no-repeat;
  background-position: center;
  background-size: 30px 30px; 
  /* Caminho corrigido para funcionar com Vite */
  background-image: url('../../assets/ICON/returnICON.svg');
  transition: background-image 0.0s ease-in-out;
}

.return-btn.mr-auto:hover {
  /* Caminho corrigido para funcionar com Vite */
  background-image: url('../../assets/ICON/backIntICON.svg');
  background-size: 40px 40px; 
}
</style>