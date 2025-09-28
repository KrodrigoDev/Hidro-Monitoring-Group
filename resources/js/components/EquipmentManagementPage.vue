<template>
  <div class="min-h-screen bg-[#EBF7F7] p-0">
    <header>
      <button class="return-btn mr-auto" @click="goBack"></button>
      <img :src="contrasteIcon" alt="Contraste">
      <p>Alto Contraste</p>
    </header>
    
    <div class="max-w-7xl mx-auto mt-6">
      <!-- Header -->
      <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="flex items-center space-x-4">
          <div class="bg-[#EBF7F7] p-3 rounded-full">
            <svg class="w-8 h-8 text-[#162C39]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
          </div>
          <div>
            <h1 class="text-3xl font-bold text-gray-900">Gerenciamento de Equipamentos</h1>
            <p class="text-gray-600">Adicione, edite e gerencie equipamentos do sistema</p>
          </div>
        </div>
      </div>

      <!-- Tabs Navigation -->
      <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="border-b border-gray-200">
          <nav class="-mb-px flex space-x-8 px-6">
            <button
              @click="activeTab = 'management'"
              :class="activeTab === 'management' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
              class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
            >
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Gerenciar Equipamentos</span>
              </div>
            </button>
            <button
              @click="activeTab = 'history'"
              :class="activeTab === 'history' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
              class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
            >
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <span>Histórico de Equipamentos</span>
              </div>
            </button>
          </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
          <!-- Management Tab -->
          <div v-if="activeTab === 'management'">
            <!-- Action Buttons -->
            <div class="flex justify-between items-center mb-6">
              <div class="flex space-x-4">
                <button
                  @click="showAddModal = true"
                  class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors flex items-center space-x-2"
                >
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                  </svg>
                  <span>Adicionar Equipamento</span>
                </button>
              </div>
              
              <!-- Search and Filters -->
              <div class="flex space-x-4">
                <input
                  v-model="searchQuery"
                  type="text"
                  placeholder="Buscar equipamentos..."
                  class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <select
                  v-model="filterType"
                  class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="">Todos os tipos</option>
                  <option v-for="type in equipmentTypes" :key="type.id" :value="type.id">
                    {{ type.nome_tipo }}
                  </option>
                </select>
              </div>
            </div>

            <!-- Equipment List -->
            <div class="bg-gray-50 rounded-lg overflow-hidden">
              <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-100">
                    <tr>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Equipamento
                      </th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tipo
                      </th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Localização
                      </th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Situação
                      </th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Instalação
                      </th>
                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ações
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="equipment in filteredEquipments" :key="equipment.id" class="hover:bg-gray-50">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                          <div class="text-sm font-medium text-gray-900">{{ equipment.nome }}</div>
                          <div class="text-sm text-gray-500">{{ equipment.codigo_ativo }}</div>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                          {{ getTypeName(equipment.tipo_equipamento_id) }}
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ getUnitName(equipment.unidade_id) }}</div>
                        <div class="text-sm text-gray-500">{{ equipment.localizacao }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span 
                          :class="getStatusClass(equipment.situacao_equipamento_id)"
                          class="inline-flex px-2 py-1 text-xs font-semibold rounded-full"
                        >
                          {{ getStatusName(equipment.situacao_equipamento_id) }}
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ formatDate(equipment.data_instalacao) }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button 
                          @click="editEquipment(equipment)"
                          class="text-blue-600 hover:text-blue-900 mr-3"
                        >
                          Editar
                        </button>
                        <button 
                          @click="deleteEquipment(equipment)"
                          class="text-red-600 hover:text-red-900"
                        >
                          Excluir
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- History Tab -->
          <div v-if="activeTab === 'history'">
            <equipment-history-page></equipment-history-page>
          </div>
        </div>
      </div>
    </div>

    <!-- Add/Edit Equipment Modal -->
    <div v-if="showAddModal || showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
          <h3 class="text-lg font-semibold text-gray-900">
            {{ showAddModal ? 'Adicionar Equipamento' : 'Editar Equipamento' }}
          </h3>
          <button 
            @click="closeModal"
            class="text-gray-400 hover:text-gray-600"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        
        <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
          <form @submit.prevent="saveEquipment" class="space-y-6">
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Nome do Equipamento *
                </label>
                <input
                  v-model="equipmentForm.nome"
                  type="text"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  placeholder="Ex: Bomba Principal A1"
                >
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Código do Ativo *
                </label>
                <input
                  v-model="equipmentForm.codigo_ativo"
                  type="text"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  placeholder="Ex: BPA-001"
                >
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Tipo de Equipamento *
                </label>
                <select
                  v-model="equipmentForm.tipo_equipamento_id"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="">Selecione o tipo</option>
                  <option v-for="type in equipmentTypes" :key="type.id" :value="type.id">
                    {{ type.nome_tipo }}
                  </option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Situação *
                </label>
                <select
                  v-model="equipmentForm.situacao_equipamento_id"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="">Selecione a situação</option>
                  <option v-for="status in equipmentStatuses" :key="status.id" :value="status.id">
                    {{ status.nome_situacao }}
                  </option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Estado *
                </label>
                <select
                  v-model="equipmentForm.estado_id"
                  @change="loadMunicipios"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="">Selecione o estado</option>
                  <option v-for="estado in estados" :key="estado.id" :value="estado.id">
                    {{ estado.nome }} ({{ estado.uf }})
                  </option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Município *
                </label>
                <select
                  v-model="equipmentForm.municipio_id"
                  @change="loadUnidades"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="">Selecione o município</option>
                  <option v-for="municipio in municipios" :key="municipio.id" :value="municipio.id">
                    {{ municipio.nome }}
                  </option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Unidade *
                </label>
                <select
                  v-model="equipmentForm.unidade_id"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="">Selecione a unidade</option>
                  <option v-for="unidade in unidades" :key="unidade.id" :value="unidade.id">
                    {{ unidade.nome }}
                  </option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Localização Específica
                </label>
                <input
                  v-model="equipmentForm.localizacao"
                  type="text"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  placeholder="Ex: Setor A, Casa de Bombas 1"
                >
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Data de Instalação
                </label>
                <input
                  v-model="equipmentForm.data_instalacao"
                  type="date"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
              </div>
            </div>

            <!-- Coordinates -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Latitude
                </label>
                <input
                  v-model="equipmentForm.latitude"
                  type="number"
                  step="0.00000001"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  placeholder="Ex: -23.5505199"
                >
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Longitude
                </label>
                <input
                  v-model="equipmentForm.longitude"
                  type="number"
                  step="0.00000001"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  placeholder="Ex: -46.6333094"
                >
              </div>
            </div>

            <!-- Description -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Descrição
              </label>
              <textarea
                v-model="equipmentForm.descricao"
                rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Detalhes técnicos ou observações sobre o equipamento"
              ></textarea>
            </div>

            <!-- Dynamic Attributes -->
            <div>
              <div class="flex justify-between items-center mb-4">
                <h4 class="text-lg font-medium text-gray-900">Atributos do Equipamento</h4>
                <button
                  type="button"
                  @click="addAttribute"
                  class="bg-green-600 text-white px-3 py-1 rounded-md hover:bg-green-700 transition-colors text-sm"
                >
                  + Adicionar Atributo
                </button>
              </div>

              <div v-if="equipmentForm.atributos.length === 0" class="text-gray-500 text-center py-4 border-2 border-dashed border-gray-300 rounded-lg">
                Nenhum atributo adicionado. Clique em "Adicionar Atributo" para começar.
              </div>

              <div v-else class="space-y-3">
                <div 
                  v-for="(atributo, index) in equipmentForm.atributos" 
                  :key="index"
                  class="grid grid-cols-1 md:grid-cols-4 gap-3 p-4 bg-gray-50 rounded-lg"
                >
                  <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Nome do Atributo</label>
                    <input
                      v-model="atributo.nome_atributo"
                      type="text"
                      placeholder="Ex: Capacidade"
                      class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Valor</label>
                    <input
                      v-model="atributo.valor_atributo"
                      type="text"
                      placeholder="Ex: 1000"
                      class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Unidade</label>
                    <input
                      v-model="atributo.unidade_medida"
                      type="text"
                      placeholder="Ex: m³/h"
                      class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >
                  </div>
                  <div class="flex items-end">
                    <button
                      type="button"
                      @click="removeAttribute(index)"
                      class="w-full bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 transition-colors text-sm"
                    >
                      Remover
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t">
              <button 
                type="button" 
                @click="closeModal"
                class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors"
              >
                Cancelar
              </button>
              <button 
                type="submit" 
                :disabled="isSaving"
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
              >
                <span v-if="isSaving">Salvando...</span>
                <span v-else>{{ showAddModal ? 'Adicionar' : 'Salvar' }}</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg max-w-md w-full">
        <div class="px-6 py-4 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-900">Confirmar Exclusão</h3>
        </div>
        
        <div class="p-6">
          <div class="flex items-center space-x-3 mb-4">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            <div>
              <p class="text-lg font-medium text-gray-900">{{ equipmentToDelete?.nome }}</p>
              <p class="text-sm text-gray-600">{{ equipmentToDelete?.codigo_ativo }}</p>
            </div>
          </div>
          
          <p class="text-gray-700 mb-6">
            Tem certeza de que deseja excluir este equipamento? 
            Esta ação não pode ser desfeita e todos os dados relacionados serão perdidos.
          </p>

          <div class="flex space-x-4">
            <button 
              @click="showDeleteModal = false; equipmentToDelete = null"
              class="flex-1 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors"
            >
              Cancelar
            </button>
            <button 
              @click="confirmDelete"
              :disabled="isDeleting"
              class="flex-1 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 disabled:opacity-50 transition-colors"
            >
              <span v-if="isDeleting">Excluindo...</span>
              <span v-else>Confirmar</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import EquipmentHistoryPage from './EquipmentHistoryPage.vue';
import contrasteIcon from '../../assets/ICON/contrasteICON.svg';

export default {
  name: 'EquipmentManagementPage',
  components: {
    EquipmentHistoryPage
  },
  data() {
    return {
      contrasteIcon: contrasteIcon, 
      activeTab: 'management',
      showAddModal: false,
      activeTab: 'management',
      showAddModal: false,
      showEditModal: false,
      showDeleteModal: false,
      isSaving: false,
      isDeleting: false,
      searchQuery: '',
      filterType: '',
      equipmentToDelete: null,
      
      equipmentForm: {
        id: null,
        nome: '',
        codigo_ativo: '',
        tipo_equipamento_id: '',
        situacao_equipamento_id: '',
        estado_id: '',
        municipio_id: '',
        unidade_id: '',
        localizacao: '',
        latitude: '',
        longitude: '',
        descricao: '',
        data_instalacao: '',
        atributos: []
      },

      // Mock data - replace with API calls
      equipments: [
        {
          id: 1,
          nome: 'Bomba Principal A1',
          codigo_ativo: 'BPA-001',
          tipo_equipamento_id: 1,
          situacao_equipamento_id: 1,
          unidade_id: 1,
          localizacao: 'Casa de Bombas 1',
          latitude: -23.5505199,
          longitude: -46.6333094,
          descricao: 'Bomba centrífuga para abastecimento principal',
          data_instalacao: '2023-01-15',
          atributos: [
            { nome_atributo: 'Capacidade', valor_atributo: '1000', unidade_medida: 'm³/h' },
            { nome_atributo: 'Potência', valor_atributo: '50', unidade_medida: 'CV' }
          ]
        },
        {
          id: 2,
          nome: 'Sensor de Pressão B2',
          codigo_ativo: 'SPB-002',
          tipo_equipamento_id: 2,
          situacao_equipamento_id: 2,
          unidade_id: 2,
          localizacao: 'Setor B',
          latitude: -23.5489,
          longitude: -46.6388,
          descricao: 'Sensor de pressão para monitoramento',
          data_instalacao: '2023-02-20',
          atributos: [
            { nome_atributo: 'Faixa de Pressão', valor_atributo: '0-10', unidade_medida: 'bar' }
          ]
        }
      ],

      equipmentTypes: [
        { id: 1, nome_tipo: 'Bomba', descricao: 'Equipamentos de bombeamento' },
        { id: 2, nome_tipo: 'Sensor', descricao: 'Sensores de monitoramento' },
        { id: 3, nome_tipo: 'Reservatório', descricao: 'Reservatórios de água' },
        { id: 4, nome_tipo: 'Poço', descricao: 'Poços artesianos' },
        { id: 5, nome_tipo: 'Válvula', descricao: 'Válvulas de controle' }
      ],

      equipmentStatuses: [
        { id: 1, nome_situacao: 'Funcionando', descricao: 'Equipamento em operação normal' },
        { id: 2, nome_situacao: 'Manutenção', descricao: 'Equipamento em manutenção' },
        { id: 3, nome_situacao: 'Inativo', descricao: 'Equipamento fora de operação' }
      ],

      estados: [
        { id: 1, nome: 'São Paulo', uf: 'SP' },
        { id: 2, nome: 'Rio de Janeiro', uf: 'RJ' },
        { id: 3, nome: 'Minas Gerais', uf: 'MG' }
      ],

      municipios: [],
      unidades: [],

      allMunicipios: [
        { id: 1, nome: 'São Paulo', estado_id: 1 },
        { id: 2, nome: 'Guarulhos', estado_id: 1 },
        { id: 3, nome: 'Campinas', estado_id: 1 },
        { id: 4, nome: 'Rio de Janeiro', estado_id: 2 },
        { id: 5, nome: 'Niterói', estado_id: 2 },
        { id: 6, nome: 'Belo Horizonte', estado_id: 3 }
      ],

      allUnidades: [
        { id: 1, nome: 'ETA Central', municipio_id: 1 },
        { id: 2, nome: 'ETA Norte', municipio_id: 2 },
        { id: 3, nome: 'ETA Sul', municipio_id: 1 },
        { id: 4, nome: 'ETA Leste', municipio_id: 3 },
        { id: 5, nome: 'ETA Oeste', municipio_id: 1 }
      ]
    }
  },
  computed: {
    filteredEquipments() {
      return this.equipments.filter(equipment => {
        const matchesSearch = !this.searchQuery || 
          equipment.nome.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          equipment.codigo_ativo.toLowerCase().includes(this.searchQuery.toLowerCase());
        
        const matchesType = !this.filterType || equipment.tipo_equipamento_id == this.filterType;
        
        return matchesSearch && matchesType;
      });
    }
  },
  methods: {

    goBack() {
      window.history.back();
    },
    
    // Tab methods
    switchTab(tab) {
      this.activeTab = tab;
    },

    // Modal methods
    closeModal() {
      this.showAddModal = false;
      this.showEditModal = false;
      this.resetForm();
    },

    resetForm() {
      this.equipmentForm = {
        id: null,
        nome: '',
        codigo_ativo: '',
        tipo_equipamento_id: '',
        situacao_equipamento_id: '',
        estado_id: '',
        municipio_id: '',
        unidade_id: '',
        localizacao: '',
        latitude: '',
        longitude: '',
        descricao: '',
        data_instalacao: '',
        atributos: []
      };
      this.municipios = [];
      this.unidades = [];
    },

    // Equipment CRUD methods
    editEquipment(equipment) {
      this.equipmentForm = { ...equipment };
      this.loadMunicipios();
      this.loadUnidades();
      this.showEditModal = true;
    },

    deleteEquipment(equipment) {
      this.equipmentToDelete = equipment;
      this.showDeleteModal = true;
    },

    async confirmDelete() {
      this.isDeleting = true;
      
      try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1000));
        
        // Remove from local array
        const index = this.equipments.findIndex(eq => eq.id === this.equipmentToDelete.id);
        if (index > -1) {
          this.equipments.splice(index, 1);
        }
        
        this.showDeleteModal = false;
        this.equipmentToDelete = null;
        
      } catch (error) {
        alert('Erro ao excluir equipamento. Tente novamente.');
      } finally {
        this.isDeleting = false;
      }
    },

    async saveEquipment() {
      this.isSaving = true;
      
      try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1500));
        
        if (this.showAddModal) {
          // Add new equipment
          const newId = Math.max(...this.equipments.map(eq => eq.id)) + 1;
          this.equipments.push({
            ...this.equipmentForm,
            id: newId
          });
        } else {
          // Update existing equipment
          const index = this.equipments.findIndex(eq => eq.id === this.equipmentForm.id);
          if (index > -1) {
            this.equipments[index] = { ...this.equipmentForm };
          }
        }
        
        this.closeModal();
        
      } catch (error) {
        alert('Erro ao salvar equipamento. Tente novamente.');
      } finally {
        this.isSaving = false;
      }
    },

    // Attribute methods
    addAttribute() {
      this.equipmentForm.atributos.push({
        nome_atributo: '',
        valor_atributo: '',
        unidade_medida: ''
      });
    },

    removeAttribute(index) {
      this.equipmentForm.atributos.splice(index, 1);
    },

    // Location methods
    loadMunicipios() {
      if (this.equipmentForm.estado_id) {
        this.municipios = this.allMunicipios.filter(m => m.estado_id == this.equipmentForm.estado_id);
      } else {
        this.municipios = [];
      }
      this.equipmentForm.municipio_id = '';
      this.equipmentForm.unidade_id = '';
      this.unidades = [];
    },

    loadUnidades() {
      if (this.equipmentForm.municipio_id) {
        this.unidades = this.allUnidades.filter(u => u.municipio_id == this.equipmentForm.municipio_id);
      } else {
        this.unidades = [];
      }
      this.equipmentForm.unidade_id = '';
    },

    // Helper methods
    getTypeName(typeId) {
      const type = this.equipmentTypes.find(t => t.id === typeId);
      return type ? type.nome_tipo : 'N/A';
    },

    getStatusName(statusId) {
      const status = this.equipmentStatuses.find(s => s.id === statusId);
      return status ? status.nome_situacao : 'N/A';
    },

    getStatusClass(statusId) {
      const classes = {
        1: 'bg-green-100 text-green-800', // Funcionando
        2: 'bg-yellow-100 text-yellow-800', // Manutenção
        3: 'bg-red-100 text-red-800' // Inativo
      };
      return classes[statusId] || 'bg-gray-100 text-gray-800';
    },

    getUnitName(unitId) {
      const unit = this.allUnidades.find(u => u.id === unitId);
      return unit ? unit.nome : 'N/A';
    },

    formatDate(dateString) {
      if (!dateString) return 'N/A';
      const date = new Date(dateString);
      return date.toLocaleDateString('pt-BR');
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
  justify-content: flex-end;
  gap: 5px;
  align-items: center;
  background-color: #EBF7F7;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  box-sizing: border-box; 
}
.return-btn.mr-auto {
  margin-right: auto;
  width: 40px;
  height: 40px;
  border: none;
  background-color: transparent;
  cursor: pointer;
  background-repeat: no-repeat;
  background-position: center;
  background-size: 30px 30px; 
  background-image: url('/resources/assets/ICON/returnICON.svg');
  transition: background-image 0.0s ease-in-out;
}
.return-btn.mr-auto:hover {
  background-image: url('/resources/assets/ICON/backIntICON.svg');
  background-size: 40px 40px; 
}
</style>

