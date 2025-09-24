<template>
  <div class="min-h-screen bg-white p-0">
    <header>
      <button class="return-btn mr-auto" @click="goBack"></button>
      <img :src="contrasteIcon" alt="Contraste">
      <p>Alto Contraste</p>
    </header>

    <div class="p-6">
      <div class="max-w-7xl mx-auto">
        <div class="bg-[#EBF7F7] rounded-lg shadow-lg p-6 mb-6">
          <div class="flex items-center space-x-4">
            <div class="bg-white p-3 rounded-full">
              <svg class="w-8 h-8 text-[#162C39]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
              </svg>
            </div>
            <div>
              <h1 class="text-3xl font-bold text-[#162C39]">Histórico de Equipamentos</h1>
              <p class="text-gray-600">Visualize o histórico completo de manutenções dos equipamentos</p>
            </div>
          </div>
        </div>

        <div class="bg-[#EBF7F7] rounded-lg shadow-lg p-6 mb-6">
          <h2 class="text-xl font-semibold text-[#162C39] mb-4">Filtros de Busca</h2>
          
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
              <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                Buscar Equipamento
              </label>
              <input 
                id="search"
                v-model="filters.search" 
                type="text" 
                placeholder="Nome ou código do equipamento"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
              >
            </div>

            <div>
              <label for="tipo" class="block text-sm font-medium text-gray-700 mb-2">
                Tipo de Equipamento
              </label>
              <select 
                id="tipo"
                v-model="filters.tipo" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
              >
                <option value="">Todos os tipos</option>
                <option value="bomba">Bomba d'água</option>
                <option value="sensor">Sensor de Pressão</option>
                <option value="valvula">Válvula de Controle</option>
                <option value="medidor">Medidor de Vazão</option>
                <option value="filtro">Sistema de Filtração</option>
              </select>
            </div>

            <div>
              <label for="situacao" class="block text-sm font-medium text-gray-700 mb-2">
                Situação
              </label>
              <select 
                id="situacao"
                v-model="filters.situacao" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
              >
                <option value="">Todas as situações</option>
                <option value="operacional">Operacional</option>
                <option value="manutencao">Em Manutenção</option>
                <option value="inativo">Inativo</option>
              </select>
            </div>

            <div class="flex items-end">
              <button 
                @click="clearFilters"
                class="w-full px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors"
              >
                Limpar Filtros
              </button>
            </div>
          </div>
        </div>

        <div v-if="loading" class="bg-[#EBF7F7] rounded-lg shadow-lg p-12 text-center">
          <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-600 mx-auto mb-4"></div>
          <p class="text-gray-600">Carregando equipamentos...</p>
        </div>

        <div v-else class="bg-[#EBF7F7] rounded-lg shadow-lg overflow-hidden">
          <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-[#162C39]">
              Equipamentos Encontrados ({{ filteredEquipments.length }})
            </h2>
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Equipamento
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Localização
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Tipo
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Situação
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Última Manutenção
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Ações
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="equipment in paginatedEquipments" :key="equipment.id" class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div>
                      <div class="text-sm font-medium text-gray-900">{{ equipment.nome }}</div>
                      <div class="text-sm text-gray-500">{{ equipment.codigo_ativo }}</div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ equipment.unidade }}</div>
                    <div class="text-sm text-gray-500">{{ equipment.municipio }}, {{ equipment.estado }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                      {{ equipment.tipo }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span 
                      :class="getStatusClass(equipment.situacao)"
                      class="inline-flex px-2 py-1 text-xs font-semibold rounded-full"
                    >
                      {{ getStatusText(equipment.situacao) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ formatDate(equipment.ultima_manutencao) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button 
                      @click="viewHistory(equipment)"
                      class="text-green-600 hover:text-green-900 mr-3"
                    >
                      Ver Histórico
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
              <button 
                @click="previousPage"
                :disabled="currentPage === 1"
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50"
              >
                Anterior
              </button>
              <button 
                @click="nextPage"
                :disabled="currentPage === totalPages"
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50"
              >
                Próximo
              </button>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
              <div>
                <p class="text-sm text-gray-700">
                  Mostrando
                  <span class="font-medium">{{ startIndex }}</span>
                  a
                  <span class="font-medium">{{ endIndex }}</span>
                  de
                  <span class="font-medium">{{ filteredEquipments.length }}</span>
                  resultados
                </p>
              </div>
              <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                  <button 
                    @click="previousPage"
                    :disabled="currentPage === 1"
                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50"
                  >
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                  </button>
                  
                  <button 
                    v-for="page in visiblePages" 
                    :key="page"
                    @click="goToPage(page)"
                    :class="page === currentPage ? 'bg-green-50 border-green-500 text-green-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'"
                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                  >
                    {{ page }}
                  </button>
                  
                  <button 
                    @click="nextPage"
                    :disabled="currentPage === totalPages"
                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50"
                  >
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="showHistoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
          <h3 class="text-lg font-semibold text-gray-900">
            Histórico de Manutenções - {{ selectedEquipment?.nome }}
          </h3>
          <button 
            @click="closeHistoryModal"
            class="text-gray-400 hover:text-gray-600"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        
        <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
          <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <p class="text-sm font-medium text-gray-600">Código</p>
                <p class="text-lg text-gray-900">{{ selectedEquipment?.codigo_ativo }}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-600">Tipo</p>
                <p class="text-lg text-gray-900">{{ selectedEquipment?.tipo }}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-600">Situação Atual</p>
                <span 
                  :class="getStatusClass(selectedEquipment?.situacao)"
                  class="inline-flex px-2 py-1 text-xs font-semibold rounded-full"
                >
                  {{ getStatusText(selectedEquipment?.situacao) }}
                </span>
              </div>
            </div>
          </div>

          <div class="space-y-6">
            <h4 class="text-lg font-semibold text-gray-900">Histórico de Manutenções</h4>
            
            <div v-if="maintenanceHistory.length === 0" class="text-center py-8">
              <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
              <p class="text-gray-500 mt-2">Nenhuma manutenção registrada para este equipamento.</p>
            </div>

            <div v-else class="flow-root">
              <ul class="-mb-8">
                <li v-for="(maintenance, index) in maintenanceHistory" :key="maintenance.id" class="relative pb-8">
                  <div v-if="index !== maintenanceHistory.length - 1" class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"></div>
                  <div class="relative flex space-x-3">
                    <div>
                      <span 
                        :class="getMaintenanceIconClass(maintenance.tipo)"
                        class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white"
                      >
                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                      </span>
                    </div>
                    <div class="min-w-0 flex-1 pt-1.5">
                      <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                          <h5 class="text-sm font-medium text-gray-900">{{ maintenance.descricao_problema }}</h5>
                          <span class="text-xs text-gray-500">{{ formatDate(maintenance.data_inicio) }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">{{ maintenance.servico_realizado }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                          <span>Responsável: {{ maintenance.responsavel }}</span>
                          <span>Duração: {{ calculateDuration(maintenance.data_inicio, maintenance.data_fim) }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import contrasteIcon from '../../assets/ICON/contrasteICON.svg';

export default {
  name: 'EquipmentHistoryPage',
  props: {
    backUrl: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      contrasteIcon: contrasteIcon,
      loading: true,
      showHistoryModal: false,
      selectedEquipment: null,
      currentPage: 1,
      itemsPerPage: 10,
      filters: {
        search: '',
        tipo: '',
        situacao: ''
      },
      equipments: [
        {
          id: 1,
          nome: 'Bomba Principal A1',
          codigo_ativo: 'BPA-001',
          tipo: 'bomba',
          situacao: 'operacional',
          unidade: 'ETA Central',
          municipio: 'São Paulo',
          estado: 'SP',
          ultima_manutencao: '2025-01-15'
        },
        {
          id: 2,
          nome: 'Sensor de Pressão B2',
          codigo_ativo: 'SPB-002',
          tipo: 'sensor',
          situacao: 'manutencao',
          unidade: 'ETA Norte',
          municipio: 'Guarulhos',
          estado: 'SP',
          ultima_manutencao: '2025-02-20'
        },
        {
          id: 3,
          nome: 'Válvula de Controle C3',
          codigo_ativo: 'VCC-003',
          tipo: 'valvula',
          situacao: 'operacional',
          unidade: 'ETA Sul',
          municipio: 'São Bernardo',
          estado: 'SP',
          ultima_manutencao: '2025-01-10'
        },
        {
          id: 4,
          nome: 'Medidor de Vazão D4',
          codigo_ativo: 'MVD-004',
          tipo: 'medidor',
          situacao: 'inativo',
          unidade: 'ETA Leste',
          municipio: 'Mauá',
          estado: 'SP',
          ultima_manutencao: '2024-12-05'
        },
        {
          id: 5,
          nome: 'Sistema de Filtração E5',
          codigo_ativo: 'SFE-005',
          tipo: 'filtro',
          situacao: 'operacional',
          unidade: 'ETA Oeste',
          municipio: 'Osasco',
          estado: 'SP',
          ultima_manutencao: '2025-02-01'
        }
      ],
      maintenanceHistory: []
    }
  },
  computed: {
    filteredEquipments() {
      return this.equipments.filter(equipment => {
        const matchesSearch = !this.filters.search || 
          equipment.nome.toLowerCase().includes(this.filters.search.toLowerCase()) ||
          equipment.codigo_ativo.toLowerCase().includes(this.filters.search.toLowerCase());
        
        const matchesTipo = !this.filters.tipo || equipment.tipo === this.filters.tipo;
        const matchesSituacao = !this.filters.situacao || equipment.situacao === this.filters.situacao;
        
        return matchesSearch && matchesTipo && matchesSituacao;
      });
    },
    totalPages() {
      return Math.ceil(this.filteredEquipments.length / this.itemsPerPage);
    },
    paginatedEquipments() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredEquipments.slice(start, end);
    },
    startIndex() {
      if (this.filteredEquipments.length === 0) return 0;
      return (this.currentPage - 1) * this.itemsPerPage + 1;
    },
    endIndex() {
      return Math.min(this.currentPage * this.itemsPerPage, this.filteredEquipments.length);
    },
    visiblePages() {
      const pages = [];
      if (this.totalPages <= 1) return [];
      const start = Math.max(1, this.currentPage - 2);
      const end = Math.min(this.totalPages, this.currentPage + 2);
      
      for (let i = start; i <= end; i++) {
        pages.push(i);
      }
      return pages;
    }
  },
  mounted() {
    this.loadEquipments();
  },
  methods: {
    goBack() {
      window.location.href = this.backUrl;
    },
    async loadEquipments() {
      this.loading = true;
      await new Promise(resolve => setTimeout(resolve, 1500));
      this.loading = false;
    },
    clearFilters() {
      this.filters = {
        search: '',
        tipo: '',
        situacao: ''
      };
      this.currentPage = 1;
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
    getMaintenanceIconClass(tipo) {
      const classes = {
        'preventiva': 'bg-blue-500',
        'corretiva': 'bg-red-500',
        'emergencial': 'bg-orange-500'
      };
      return classes[tipo] || 'bg-gray-500';
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      // Ajuste para garantir que a data seja interpretada como UTC para evitar problemas de fuso horário
      const utcDate = new Date(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate());
      return utcDate.toLocaleDateString('pt-BR');
    },
    calculateDuration(startDate, endDate) {
      const start = new Date(startDate);
      const end = new Date(endDate);
      const diffTime = Math.abs(end - start);
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
      if (diffDays === 0) return 'Mesmo dia';
      return `${diffDays} dia${diffDays > 1 ? 's' : ''}`;
    },
    viewHistory(equipment) {
      this.selectedEquipment = equipment;
      this.loadMaintenanceHistory(equipment.id);
      this.showHistoryModal = true;
    },
    loadMaintenanceHistory(equipmentId) {
      const mockHistory = [
        {
          id: 1,
          data_inicio: '2025-02-15',
          data_fim: '2025-02-16',
          tipo: 'preventiva',
          descricao_problema: 'Manutenção preventiva programada',
          servico_realizado: 'Troca de filtros, lubrificação de componentes e verificação geral do sistema.',
          responsavel: 'João Silva'
        },
        {
          id: 2,
          data_inicio: '2025-01-10',
          data_fim: '2025-01-12',
          tipo: 'corretiva',
          descricao_problema: 'Vazamento identificado na conexão principal',
          servico_realizado: 'Substituição de vedações e teste de pressão do sistema.',
          responsavel: 'Maria Santos'
        },
        {
          id: 3,
          data_inicio: '2024-12-05',
          data_fim: '2024-12-05',
          tipo: 'emergencial',
          descricao_problema: 'Parada súbita do equipamento',
          servico_realizado: 'Diagnóstico e reparo do sistema elétrico. Substituição de componente defeituoso.',
          responsavel: 'Carlos Oliveira'
        }
      ];
      
      this.maintenanceHistory = mockHistory;
    },
    closeHistoryModal() {
      this.showHistoryModal = false;
      this.selectedEquipment = null;
      this.maintenanceHistory = [];
    },
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    goToPage(page) {
      this.currentPage = page;
    }
  },
  watch: {
    filters: {
      handler() {
        this.currentPage = 1;
      },
      deep: true
    }
  }
}
</script>

<style scoped>
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
  background-image: url('../../assets/ICON/returnICON.svg');
  transition: background-image 0.0s ease-in-out;
}

.return-btn.mr-auto:hover {
  background-image: url('../../assets/ICON/backIntICON.svg');
  background-size: 40px 40px; 
}
</style>