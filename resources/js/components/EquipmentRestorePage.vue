<template>
  <div class="min-h-screen bg-gradient-to-br from-purple-50 to-indigo-100 p-6">
    <div class="max-w-4xl mx-auto">
      <!-- Header -->
      <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="flex items-center space-x-4">
          <div class="bg-purple-100 p-3 rounded-full">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
          </div>
          <div>
            <h1 class="text-3xl font-bold text-gray-900">Restauração de Equipamentos</h1>
            <p class="text-gray-600">Restaure equipamentos inativos para retornar à operação</p>
          </div>
        </div>
      </div>

      <!-- Instruções de Uso -->
      <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
        <div class="flex items-start space-x-3">
          <svg class="w-6 h-6 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <div>
            <h3 class="text-lg font-semibold text-blue-800">Como usar esta funcionalidade</h3>
            <p class="text-blue-700 mt-1">
              Digite o código ou nome do equipamento inativo que deseja restaurar. 
              O sistema verificará se o equipamento está elegível para restauração e 
              solicitará confirmação antes de executar a operação.
            </p>
          </div>
        </div>
      </div>

      <!-- Formulário de Busca -->
      <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Buscar Equipamento</h2>
        
        <div class="flex space-x-4">
          <div class="flex-1">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
              Código ou Nome do Equipamento
            </label>
            <input 
              id="search"
              v-model="searchQuery" 
              type="text" 
              placeholder="Ex: BPA-001 ou Bomba Principal A1"
              class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
              @keyup.enter="searchEquipment"
            >
          </div>
          <div class="flex items-end">
            <button 
              @click="searchEquipment"
              :disabled="!searchQuery.trim() || isSearching"
              class="px-6 py-3 bg-purple-600 text-white rounded-md hover:bg-purple-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
            >
              <span v-if="isSearching">Buscando...</span>
              <span v-else>Buscar</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Resultado da Busca -->
      <div v-if="searchResult" class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Equipamento Encontrado</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Informações Básicas -->
          <div class="space-y-4">
            <div>
              <p class="text-sm font-medium text-gray-600">Nome do Equipamento</p>
              <p class="text-lg text-gray-900">{{ searchResult.nome }}</p>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-600">Código</p>
              <p class="text-lg text-gray-900">{{ searchResult.codigo_ativo }}</p>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-600">Tipo</p>
              <p class="text-lg text-gray-900">{{ searchResult.tipo }}</p>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-600">Localização</p>
              <p class="text-lg text-gray-900">{{ searchResult.unidade }}</p>
              <p class="text-sm text-gray-500">{{ searchResult.municipio }}, {{ searchResult.estado }}</p>
            </div>
          </div>

          <!-- Status e Ações -->
          <div class="space-y-4">
            <div>
              <p class="text-sm font-medium text-gray-600">Situação Atual</p>
              <span 
                :class="getStatusClass(searchResult.situacao)"
                class="inline-flex px-3 py-1 text-sm font-semibold rounded-full"
              >
                {{ getStatusText(searchResult.situacao) }}
              </span>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-600">Última Manutenção</p>
              <p class="text-lg text-gray-900">{{ formatDate(searchResult.ultima_manutencao) }}</p>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-600">Inativo desde</p>
              <p class="text-lg text-gray-900">{{ formatDate(searchResult.data_inativacao) }}</p>
            </div>

            <!-- Elegibilidade para Restauração -->
            <div class="mt-6">
              <div v-if="isEligibleForRestore" class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center space-x-2">
                  <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <p class="text-sm font-medium text-green-800">Elegível para restauração</p>
                </div>
                <p class="text-sm text-green-700 mt-1">
                  Este equipamento pode ser restaurado para operação normal.
                </p>
              </div>

              <div v-else class="bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center space-x-2">
                  <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
                  <p class="text-sm font-medium text-red-800">Não elegível para restauração</p>
                </div>
                <p class="text-sm text-red-700 mt-1">
                  {{ ineligibilityReason }}
                </p>
              </div>
            </div>

            <!-- Botão de Restauração -->
            <div v-if="isEligibleForRestore" class="mt-6">
              <button 
                @click="showConfirmModal = true"
                class="w-full px-6 py-3 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors font-medium"
              >
                Restaurar Equipamento
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Mensagem quando não encontrar equipamento -->
      <div v-if="searchPerformed && !searchResult" class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
        <div class="flex items-center space-x-3">
          <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
          </svg>
          <div>
            <h3 class="text-lg font-semibold text-yellow-800">Equipamento não encontrado</h3>
            <p class="text-yellow-700 mt-1">
              Não foi possível encontrar um equipamento com o código ou nome informado. 
              Verifique se a informação está correta e tente novamente.
            </p>
          </div>
        </div>
      </div>

      <!-- Histórico de Restaurações Recentes -->
      <div v-if="recentRestorations.length > 0" class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Restaurações Recentes</h3>
        
        <div class="space-y-3">
          <div 
            v-for="restoration in recentRestorations" 
            :key="restoration.id"
            class="flex items-center justify-between bg-gray-50 p-4 rounded-lg"
          >
            <div>
              <p class="font-medium text-gray-900">{{ restoration.equipamento_nome }}</p>
              <p class="text-sm text-gray-600">{{ restoration.equipamento_codigo }}</p>
            </div>
            <div class="text-right">
              <p class="text-sm text-gray-900">{{ formatDate(restoration.data_restauracao) }}</p>
              <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                Restaurado
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal de Confirmação -->
    <div v-if="showConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg max-w-md w-full">
        <div class="px-6 py-4 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-900">Confirmar Restauração</h3>
        </div>
        
        <div class="p-6">
          <div class="flex items-center space-x-3 mb-4">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            <div>
              <p class="text-lg font-medium text-gray-900">{{ searchResult?.nome }}</p>
              <p class="text-sm text-gray-600">{{ searchResult?.codigo_ativo }}</p>
            </div>
          </div>
          
          <p class="text-gray-700 mb-6">
            Tem certeza de que deseja restaurar este equipamento? 
            Esta ação irá alterar o status do equipamento para "Operacional" 
            e ele voltará a ser monitorado pelo sistema.
          </p>

          <div class="flex space-x-4">
            <button 
              @click="showConfirmModal = false"
              class="flex-1 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors"
            >
              Cancelar
            </button>
            <button 
              @click="confirmRestore"
              :disabled="isRestoring"
              class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 disabled:opacity-50 transition-colors"
            >
              <span v-if="isRestoring">Restaurando...</span>
              <span v-else>Confirmar</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal de Sucesso -->
    <div v-if="showSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg max-w-md w-full">
        <div class="p-6 text-center">
          <div class="bg-green-100 p-3 rounded-full w-16 h-16 mx-auto mb-4">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2">Restauração Concluída!</h3>
          <p class="text-gray-600 mb-4">
            O equipamento <strong>{{ restoredEquipment?.nome }}</strong> foi restaurado com sucesso 
            e está novamente operacional.
          </p>
          <button 
            @click="closeSuccessModal"
            class="bg-purple-600 text-white px-6 py-2 rounded-md hover:bg-purple-700 transition-colors"
          >
            Fechar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'EquipmentRestorePage',
  data() {
    return {
      searchQuery: '',
      isSearching: false,
      searchPerformed: false,
      searchResult: null,
      showConfirmModal: false,
      showSuccessModal: false,
      isRestoring: false,
      restoredEquipment: null,
      recentRestorations: [
        {
          id: 1,
          equipamento_nome: 'Bomba Secundária B2',
          equipamento_codigo: 'BSB-002',
          data_restauracao: '2024-02-20'
        },
        {
          id: 2,
          equipamento_nome: 'Sensor de Temperatura T1',
          equipamento_codigo: 'STT-001',
          data_restauracao: '2024-02-18'
        }
      ],
      // Dados simulados de equipamentos inativos
      inactiveEquipments: [
        {
          id: 4,
          nome: 'Medidor de Vazão D4',
          codigo_ativo: 'MVD-004',
          tipo: 'Medidor de Vazão',
          situacao: 'inativo',
          unidade: 'ETA Leste',
          municipio: 'Mauá',
          estado: 'SP',
          ultima_manutencao: '2023-12-05',
          data_inativacao: '2024-01-15',
          motivo_inativacao: 'Falha no sistema eletrônico'
        },
        {
          id: 6,
          nome: 'Válvula de Segurança VS1',
          codigo_ativo: 'VSS-001',
          tipo: 'Válvula de Controle',
          situacao: 'inativo',
          unidade: 'ETA Central',
          municipio: 'São Paulo',
          estado: 'SP',
          ultima_manutencao: '2023-11-20',
          data_inativacao: '2024-02-01',
          motivo_inativacao: 'Desgaste excessivo'
        }
      ]
    }
  },
  computed: {
    isEligibleForRestore() {
      if (!this.searchResult) return false;
      
      // Critérios para elegibilidade:
      // 1. Equipamento deve estar inativo
      // 2. Não deve ter sido inativado há mais de 6 meses
      // 3. Deve ter passado por manutenção nos últimos 12 meses
      
      const now = new Date();
      const inactivationDate = new Date(this.searchResult.data_inativacao);
      const lastMaintenanceDate = new Date(this.searchResult.ultima_manutencao);
      
      const monthsSinceInactivation = (now - inactivationDate) / (1000 * 60 * 60 * 24 * 30);
      const monthsSinceLastMaintenance = (now - lastMaintenanceDate) / (1000 * 60 * 60 * 24 * 30);
      
      return this.searchResult.situacao === 'inativo' && 
             monthsSinceInactivation <= 6 && 
             monthsSinceLastMaintenance <= 12;
    },
    
    ineligibilityReason() {
      if (!this.searchResult) return '';
      
      if (this.searchResult.situacao !== 'inativo') {
        return 'O equipamento não está inativo.';
      }
      
      const now = new Date();
      const inactivationDate = new Date(this.searchResult.data_inativacao);
      const lastMaintenanceDate = new Date(this.searchResult.ultima_manutencao);
      
      const monthsSinceInactivation = (now - inactivationDate) / (1000 * 60 * 60 * 24 * 30);
      const monthsSinceLastMaintenance = (now - lastMaintenanceDate) / (1000 * 60 * 60 * 24 * 30);
      
      if (monthsSinceInactivation > 6) {
        return 'Equipamento inativo há mais de 6 meses. Necessária avaliação técnica.';
      }
      
      if (monthsSinceLastMaintenance > 12) {
        return 'Última manutenção há mais de 12 meses. Necessária manutenção antes da restauração.';
      }
      
      return 'Equipamento não atende aos critérios de elegibilidade.';
    }
  },
  methods: {
    async searchEquipment() {
      if (!this.searchQuery.trim()) return;
      
      this.isSearching = true;
      this.searchPerformed = false;
      this.searchResult = null;
      
      try {
        // Simular busca no backend
        await new Promise(resolve => setTimeout(resolve, 1500));
        
        // Buscar equipamento nos dados simulados
        const equipment = this.inactiveEquipments.find(eq => 
          eq.nome.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          eq.codigo_ativo.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
        
        this.searchResult = equipment || null;
        this.searchPerformed = true;
        
      } catch (error) {
        alert('Erro ao buscar equipamento. Tente novamente.');
      } finally {
        this.isSearching = false;
      }
    },

    async confirmRestore() {
      this.isRestoring = true;
      
      try {
        // Simular processo de restauração
        await new Promise(resolve => setTimeout(resolve, 2000));
        
        // Atualizar status do equipamento
        this.searchResult.situacao = 'operacional';
        this.restoredEquipment = { ...this.searchResult };
        
        // Adicionar à lista de restaurações recentes
        this.recentRestorations.unshift({
          id: Date.now(),
          equipamento_nome: this.searchResult.nome,
          equipamento_codigo: this.searchResult.codigo_ativo,
          data_restauracao: new Date().toISOString().split('T')[0]
        });
        
        // Remover da lista de equipamentos inativos
        const index = this.inactiveEquipments.findIndex(eq => eq.id === this.searchResult.id);
        if (index > -1) {
          this.inactiveEquipments.splice(index, 1);
        }
        
        // Mostrar modal de sucesso
        this.showConfirmModal = false;
        this.showSuccessModal = true;
        
      } catch (error) {
        alert('Erro ao restaurar equipamento. Tente novamente.');
      } finally {
        this.isRestoring = false;
      }
    },

    closeSuccessModal() {
      this.showSuccessModal = false;
      this.restoredEquipment = null;
      
      // Limpar busca
      this.searchQuery = '';
      this.searchResult = null;
      this.searchPerformed = false;
    },

    getStatusClass(status) {
      const classes = {
        'operacional': 'bg-green-100 text-green-800',
        'manutencao': 'bg-yellow-100 text-yellow-800',
        'inativo': 'bg-red-100 text-red-800'
      };
      return classes[status] || 'bg-gray-100 text-gray-800';
    },

    getStatusText(status) {
      const texts = {
        'operacional': 'Operacional',
        'manutencao': 'Em Manutenção',
        'inativo': 'Inativo'
      };
      return texts[status] || 'Desconhecido';
    },

    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString('pt-BR');
    }
  }
}
</script>

<style scoped>
/* Estilos específicos do componente, se necessário */
</style>

