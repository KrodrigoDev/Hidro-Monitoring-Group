<template>
  <div class="min-h-screen" style="background-color: #EBF7F7;">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <div class="flex items-center">
            <button @click="goBack" class="mr-4 text-gray-600 hover:text-gray-900">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
              </svg>
            </button>
            <h1 class="text-2xl font-bold text-gray-900">Gerar Relatório</h1>
          </div>
          <div class="flex items-center space-x-4">
            <!-- User Menu -->
            <div class="relative">
              <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                  <span class="text-white text-sm font-medium">U</span>
                </div>
                <span class="text-sm font-medium">Usuário</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
      <!-- Report Configuration Card -->
      <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
              </div>
            </div>
            <div class="ml-4">
              <h2 class="text-lg font-medium text-gray-900">Configuração do Relatório</h2>
              <p class="text-sm text-gray-500">Configure os filtros e parâmetros para gerar seu relatório personalizado</p>
            </div>
          </div>
        </div>

        <div class="p-6">
          <form @submit.prevent="generateReport" class="space-y-6">
            <!-- Report Type -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Tipo de Relatório
              </label>
              <select v-model="reportConfig.type" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Selecione o tipo de relatório</option>
                <option value="equipments">Relatório de Equipamentos</option>
                <option value="maintenance">Relatório de Manutenções</option>
                <option value="performance">Relatório de Performance</option>
                <option value="costs">Relatório de Custos</option>
              </select>
            </div>

            <!-- Date Range -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Data de Início
                </label>
                <input 
                  v-model="reportConfig.startDate" 
                  type="date" 
                  required
                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Data de Fim
                </label>
                <input 
                  v-model="reportConfig.endDate" 
                  type="date" 
                  required
                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
              </div>
            </div>

            <!-- Filters -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <!-- Equipment Type Filter -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Tipo de Equipamento
                </label>
                <select v-model="reportConfig.equipmentType" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                  <option value="">Todos os tipos</option>
                  <option value="bomba">Bombas</option>
                  <option value="poco">Poços</option>
                  <option value="reservatorio">Reservatórios</option>
                  <option value="sensor">Sensores</option>
                  <option value="valvula">Válvulas</option>
                </select>
              </div>

              <!-- Status Filter -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Status do Equipamento
                </label>
                <select v-model="reportConfig.status" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                  <option value="">Todos os status</option>
                  <option value="funcionando">Funcionando</option>
                  <option value="manutencao">Manutenção</option>
                  <option value="inativo">Inativo</option>
                </select>
              </div>

              <!-- Location Filter -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Unidade
                </label>
                <select v-model="reportConfig.unit" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                  <option value="">Todas as unidades</option>
                  <option value="1">Unidade Centro</option>
                  <option value="2">Unidade Norte</option>
                  <option value="3">Unidade Sul</option>
                  <option value="4">Unidade Leste</option>
                  <option value="5">Unidade Oeste</option>
                </select>
              </div>
            </div>

            <!-- Report Format -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Formato do Relatório
              </label>
              <div class="flex space-x-4">
                <label class="flex items-center">
                  <input v-model="reportConfig.format" type="radio" value="pdf" class="text-blue-600 focus:ring-blue-500">
                  <span class="ml-2 text-sm text-gray-700">PDF</span>
                </label>
                <label class="flex items-center">
                  <input v-model="reportConfig.format" type="radio" value="excel" class="text-blue-600 focus:ring-blue-500">
                  <span class="ml-2 text-sm text-gray-700">Excel</span>
                </label>
                <label class="flex items-center">
                  <input v-model="reportConfig.format" type="radio" value="csv" class="text-blue-600 focus:ring-blue-500">
                  <span class="ml-2 text-sm text-gray-700">CSV</span>
                </label>
              </div>
            </div>

            <!-- Additional Options -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Opções Adicionais
              </label>
              <div class="space-y-2">
                <label class="flex items-center">
                  <input v-model="reportConfig.includeCharts" type="checkbox" class="text-blue-600 focus:ring-blue-500">
                  <span class="ml-2 text-sm text-gray-700">Incluir gráficos e visualizações</span>
                </label>
                <label class="flex items-center">
                  <input v-model="reportConfig.includeDetails" type="checkbox" class="text-blue-600 focus:ring-blue-500">
                  <span class="ml-2 text-sm text-gray-700">Incluir detalhes técnicos</span>
                </label>
                <label class="flex items-center">
                  <input v-model="reportConfig.includeSummary" type="checkbox" class="text-blue-600 focus:ring-blue-500">
                  <span class="ml-2 text-sm text-gray-700">Incluir resumo executivo</span>
                </label>
              </div>
            </div>

            <!-- Generate Button -->
            <div class="flex justify-end space-x-4">
              <button 
                type="button" 
                @click="previewReport"
                :disabled="isGenerating"
                class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                Visualizar
              </button>
              <button 
                type="submit"
                :disabled="isGenerating || !isFormValid"
                class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <svg v-if="isGenerating" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white inline" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ isGenerating ? 'Gerando...' : 'Gerar Relatório' }}
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Statistics Overview -->
      <div class="mt-8 bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
          <h3 class="text-lg font-medium text-gray-900">Visão Geral das Métricas</h3>
          <p class="text-sm text-gray-500">Estatísticas baseadas nos filtros selecionados</p>
        </div>
        
        <div class="p-6">
          <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            <!-- Custo Total -->
            <div class="text-center">
              <div class="text-2xl font-bold text-gray-900">R$ 8.000</div>
              <div class="text-sm text-gray-500">Custo Total</div>
              <div class="w-full bg-red-200 rounded-full h-2 mt-2">
                <div class="bg-red-500 h-2 rounded-full" style="width: 75%"></div>
              </div>
            </div>

            <!-- Custo Mensal Energia -->
            <div class="text-center">
              <div class="text-2xl font-bold text-gray-900">R$ 8.000</div>
              <div class="text-sm text-gray-500">Custo Mensal Energia</div>
              <div class="w-full bg-red-200 rounded-full h-2 mt-2">
                <div class="bg-red-500 h-2 rounded-full" style="width: 80%"></div>
              </div>
            </div>

            <!-- Custo Mensal Mão de Obra -->
            <div class="text-center">
              <div class="text-2xl font-bold text-gray-900">R$ 7.000</div>
              <div class="text-sm text-gray-500">Custo Mensal Mão de Obra</div>
              <div class="w-full bg-red-200 rounded-full h-2 mt-2">
                <div class="bg-red-500 h-2 rounded-full" style="width: 70%"></div>
              </div>
            </div>

            <!-- Venda Arrecadada -->
            <div class="text-center">
              <div class="text-2xl font-bold text-gray-900">R$ 300.000</div>
              <div class="text-sm text-gray-500">Venda Arrecadada</div>
              <div class="w-full bg-green-200 rounded-full h-2 mt-2">
                <div class="bg-green-500 h-2 rounded-full" style="width: 90%"></div>
              </div>
            </div>

            <!-- Quantidade de Casas Atendidas -->
            <div class="text-center">
              <div class="text-2xl font-bold text-gray-900">4000</div>
              <div class="text-sm text-gray-500">Quantidade de Casas Atendidas</div>
              <div class="w-full bg-green-200 rounded-full h-2 mt-2">
                <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
              </div>
            </div>

            <!-- Quantidade de Clientes Ativos -->
            <div class="text-center">
              <div class="text-2xl font-bold text-gray-900">16.200</div>
              <div class="text-sm text-gray-500">Quantidade de Clientes Ativos</div>
              <div class="w-full bg-green-200 rounded-full h-2 mt-2">
                <div class="bg-green-500 h-2 rounded-full" style="width: 95%"></div>
              </div>
            </div>
          </div>

          <!-- Description -->
          <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <div class="ml-3">
                <h4 class="text-sm font-medium text-blue-800">Informações sobre as Métricas</h4>
                <p class="text-sm text-blue-700 mt-1 leading-relaxed">
                  As métricas apresentadas acima são calculadas com base nos dados operacionais do sistema de abastecimento de água. 
                  Os valores de custo incluem despesas com energia elétrica, mão de obra especializada e manutenção preventiva e corretiva. 
                  A receita arrecadada representa o faturamento total com a prestação de serviços de abastecimento, enquanto os indicadores 
                  de atendimento mostram a cobertura atual do sistema em termos de residências conectadas e clientes ativos.
                </p>
              </div>
            </div>
          </div>

          <!-- Generate Report Button (Bottom) -->
          <div class="mt-6 text-center">
            <button 
              @click="generateReport"
              :disabled="isGenerating || !isFormValid"
              class="px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <svg v-if="isGenerating" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ isGenerating ? 'Gerando Relatório...' : 'Gerar Relatório' }}
            </button>
          </div>
        </div>
      </div>

      <!-- Success Modal -->
      <div v-if="showSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
          <div class="text-center">
            <!-- Success Icon -->
            <div class="flex justify-center mb-4">
              <div class="bg-green-100 rounded-full p-3">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
            </div>
            
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Relatório Gerado com Sucesso!</h3>
            <p class="text-sm text-gray-600 mb-6">
              Seu relatório foi gerado e está pronto para download.
            </p>
            
            <div class="flex space-x-3">
              <button
                @click="downloadReport"
                class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors"
              >
                Download
              </button>
              <button
                @click="closeSuccessModal"
                class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition-colors"
              >
                Fechar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GenerateReportPage',
  data() {
    return {
      isGenerating: false,
      showSuccessModal: false,
      reportConfig: {
        type: '',
        startDate: '',
        endDate: '',
        equipmentType: '',
        status: '',
        unit: '',
        format: 'pdf',
        includeCharts: true,
        includeDetails: false,
        includeSummary: true
      }
    }
  },
  computed: {
    isFormValid() {
      return this.reportConfig.type && 
             this.reportConfig.startDate && 
             this.reportConfig.endDate &&
             this.reportConfig.format
    }
  },
  mounted() {
    // Set default dates (last 30 days)
    const today = new Date()
    const thirtyDaysAgo = new Date(today.getTime() - (30 * 24 * 60 * 60 * 1000))
    
    this.reportConfig.endDate = today.toISOString().split('T')[0]
    this.reportConfig.startDate = thirtyDaysAgo.toISOString().split('T')[0]
  },
  methods: {
    async generateReport() {
      if (!this.isFormValid) return
      
      this.isGenerating = true
      
      try {
        // Simulate API call to generate report
        await new Promise(resolve => setTimeout(resolve, 3000))
        
        // Here you would make the actual API call
        // const response = await axios.post('/api/reports/generate', this.reportConfig)
        
        this.showSuccessModal = true
        
      } catch (error) {
        console.error('Error generating report:', error)
        alert('Erro ao gerar relatório. Tente novamente.')
      } finally {
        this.isGenerating = false
      }
    },
    
    async previewReport() {
      if (!this.isFormValid) return
      
      // Simulate preview functionality
      alert('Funcionalidade de visualização será implementada em breve!')
    },
    
    downloadReport() {
      // Simulate file download
      const filename = `relatorio_${this.reportConfig.type}_${new Date().toISOString().split('T')[0]}.${this.reportConfig.format}`
      
      // Create a dummy file for demonstration
      const content = `Relatório ${this.reportConfig.type}\nPeríodo: ${this.reportConfig.startDate} a ${this.reportConfig.endDate}\nFormato: ${this.reportConfig.format}`
      const blob = new Blob([content], { type: 'text/plain' })
      const url = window.URL.createObjectURL(blob)
      
      const a = document.createElement('a')
      a.href = url
      a.download = filename
      document.body.appendChild(a)
      a.click()
      document.body.removeChild(a)
      window.URL.revokeObjectURL(url)
      
      this.closeSuccessModal()
    },
    
    closeSuccessModal() {
      this.showSuccessModal = false
    },
    
    goBack() {
      window.history.back()
    }
  }
}
</script>

<style scoped>
/* Additional custom styles if needed */
</style>

