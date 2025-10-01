<template>
  <div class="min-h-screen" style="background-color: #EBF7F7;">
    <!-- Header -->
    <header class="shadow-sm border-b border-gray-200" style="background-color: #EBF7F7;">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end items-center h-16">
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

    <div class="flex">
      <!-- Sidebar -->
      <aside class="w-64 shadow-lg min-h-screen" style="background-color: #EBF7F7;">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-center h-16 px-4 border-b border-gray-200">
          <img src="../../assets/ICON/logo2.svg" alt="Logo" class="w-[211px] h-[150px]">
        </div>
        <nav class="mt-8">
          <div class="px-4">
            <ul class="space-y-2">
              <li>
                <a href="/dashboard" class="bg-white text-gray-900 shadow-sm group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                  <svg class="text-blue-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v0"></path>
                  </svg>
                  Dashboard
                </a>
              </li>
              <li>
                <a href="/equipment-management" class="text-gray-700 hover:bg-white hover:text-gray-900 hover:shadow-sm group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all">
                  <svg class="text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  Gerenciamento de Equipamentos
                </a>
              </li>
              <li>
                <a href="/generate-report" class="text-gray-700 hover:bg-white hover:text-gray-900 hover:shadow-sm group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all">
                  <svg class="text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                  </svg>
                  Gerar Relatório
                </a>
              </li>
              <li>
                <a href="/support" class="text-gray-700 hover:bg-white hover:text-gray-900 hover:shadow-sm group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all">
                  <svg class="text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                  </svg>
                  Suporte
                </a>
              </li>
              <li v-if="userAccessLevel >= 3">
                <a href="/users" class="text-gray-700 hover:bg-white hover:text-gray-900 hover:shadow-sm group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all">
                  <svg class="text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                  </svg>
                  Gerenciamento de Usuário
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <!-- Total Equipamentos -->
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                  </svg>
                </div>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total de Equipamentos</p>
                <p class="text-2xl font-bold text-gray-900">{{ stats.totalEquipments }}</p>
                <p class="text-xs text-gray-400">100% do total</p>
              </div>
            </div>
          </div>

          <!-- Total Poços -->
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                  </svg>
                </div>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total de Poços</p>
                <p class="text-2xl font-bold text-gray-900">{{ stats.totalWells }}</p>
                <p class="text-xs text-gray-400">{{ getPercentage(stats.totalWells) }}% do total</p>
              </div>
            </div>
          </div>

          <!-- Total Bombas -->
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                  </svg>
                </div>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total de Bombas</p>
                <p class="text-2xl font-bold text-gray-900">{{ stats.totalPumps }}</p>
                <p class="text-xs text-gray-400">{{ getPercentage(stats.totalPumps) }}% do total</p>
              </div>
            </div>
          </div>

          <!-- Reservatórios -->
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                  </svg>
                </div>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Reservatórios</p>
                <p class="text-2xl font-bold text-gray-900">{{ stats.totalReservoirs }}</p>
                <p class="text-xs text-gray-400">{{ getPercentage(stats.totalReservoirs) }}% do total</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Map Section -->
        <div class="bg-white rounded-lg shadow">
          <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
              <h2 class="text-lg font-medium text-gray-900">Mapa de Equipamentos</h2>
              <div class="flex items-center space-x-4">
                <!-- Location Filters -->
                <div class="flex items-center space-x-2">
                  <!-- Estado/Empresa -->
                  <div class="relative">
                    <button @click="toggleStateDropdown" class="flex items-center space-x-1 bg-gray-700 text-white px-3 py-1 rounded-full text-sm hover:bg-gray-800 transition-colors">
                      <span>{{ selectedStateLabel }}</span>
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                    </button>
                    <div v-if="showStateDropdown" class="absolute top-full left-0 mt-1 bg-white border border-gray-200 rounded-md shadow-lg z-10 min-w-[150px]">
                      <button @click="selectState('')" class="block w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Coruripe
                      </button>
                      <button v-for="state in states" :key="state.id" @click="selectState(state.id)" class="block w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        {{ state.name }}
                      </button>
                    </div>
                  </div>
                  
                  <!-- Município -->
                  <div class="relative">
                    <button @click="toggleMunicipalityDropdown" class="flex items-center space-x-1 bg-teal-500 text-white px-3 py-1 rounded-full text-sm hover:bg-teal-600 transition-colors">
                      <span>{{ selectedMunicipalityLabel }}</span>
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                    </button>
                    <div v-if="showMunicipalityDropdown" class="absolute top-full left-0 mt-1 bg-white border border-gray-200 rounded-md shadow-lg z-10 min-w-[180px]">
                      <button @click="selectMunicipality('')" class="block w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Todas as localidades
                      </button>
                      <button v-for="municipality in availableMunicipalities" :key="municipality.id" @click="selectMunicipality(municipality.id)" class="block w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        {{ municipality.name }}
                      </button>
                    </div>
                  </div>
                  
                  <!-- Tipo de Equipamento -->
                  <div class="relative">
                    <button @click="toggleTypeDropdown" class="flex items-center space-x-1 bg-teal-500 text-white px-3 py-1 rounded-full text-sm hover:bg-teal-600 transition-colors">
                      <span>{{ selectedTypeLabel }}</span>
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                    </button>
                    <div v-if="showTypeDropdown" class="absolute top-full left-0 mt-1 bg-white border border-gray-200 rounded-md shadow-lg z-10 min-w-[150px]">
                      <button @click="selectType('')" class="block w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Todos os tipos
                      </button>
                      <button v-for="type in equipmentTypes" :key="type" @click="selectType(type)" class="block w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        {{ type }}
                      </button>
                    </div>
                  </div>
                  
                  <!-- Status -->
                  <div class="relative">
                    <button @click="toggleStatusDropdown" class="flex items-center space-x-1 bg-teal-500 text-white px-3 py-1 rounded-full text-sm hover:bg-teal-600 transition-colors">
                      <span>{{ selectedStatusLabel }}</span>
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                    </button>
                    <div v-if="showStatusDropdown" class="absolute top-full left-0 mt-1 bg-white border border-gray-200 rounded-md shadow-lg z-10 min-w-[150px]">
                      <button @click="selectStatus('')" class="block w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Todas as bombas
                      </button>
                      <button @click="selectStatus('funcionando')" class="block w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Funcionando
                      </button>
                      <button @click="selectStatus('manutencao')" class="block w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Manutenção
                      </button>
                      <button @click="selectStatus('inativo')" class="block w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Inativo
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Map Container -->
          <div class="p-6">
            <div id="map" class="w-full h-[600px] rounded-lg"></div>
          </div>
        </div>

        <!-- Equipment Details Modal -->
        <div v-if="selectedEquipment" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
          <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="flex justify-between items-start mb-4">
              <h3 class="text-lg font-semibold text-gray-900">{{ selectedEquipment.nome }}</h3>
              <button @click="closeEquipmentModal" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>
            
            <div class="space-y-3">
              <div>
                <span class="text-sm font-medium text-gray-500">Código:</span>
                <span class="ml-2 text-sm text-gray-900">{{ selectedEquipment.codigo_ativo }}</span>
              </div>
              
              <div>
                <span class="text-sm font-medium text-gray-500">Tipo:</span>
                <span class="ml-2 text-sm text-gray-900">{{ selectedEquipment.tipo }}</span>
              </div>
              
              <div>
                <span class="text-sm font-medium text-gray-500">Status:</span>
                <span :class="getStatusClass(selectedEquipment.situacao)" class="ml-2 px-2 py-1 text-xs font-medium rounded-full">
                  {{ selectedEquipment.situacao }}
                </span>
              </div>
              
              <div>
                <span class="text-sm font-medium text-gray-500">Localização:</span>
                <span class="ml-2 text-sm text-gray-900">{{ selectedEquipment.localizacao }}</span>
              </div>
              
              <div v-if="selectedEquipment.descricao">
                <span class="text-sm font-medium text-gray-500">Descrição:</span>
                <p class="mt-1 text-sm text-gray-900">{{ selectedEquipment.descricao }}</p>
              </div>
              
              <div v-if="selectedEquipment.atributos && selectedEquipment.atributos.length > 0">
                <span class="text-sm font-medium text-gray-500">Atributos:</span>
                <div class="mt-2 space-y-1">
                  <div v-for="attr in selectedEquipment.atributos" :key="attr.nome_atributo" class="flex justify-between text-sm">
                    <span class="text-gray-600">{{ attr.nome_atributo }}:</span>
                    <span class="text-gray-900">{{ attr.valor_atributo }} {{ attr.unidade_medida }}</span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
              <button @click="closeEquipmentModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                Fechar
              </button>
              <button @click="editEquipment" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Editar
              </button>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'

export default {
  name: 'DashboardPage',
  data() {
    return {
      map: null,
      markers: [],
      selectedEquipment: null,
      selectedState: '',
      selectedMunicipality: '',
      selectedType: '',
      selectedStatus: '',
      showStateDropdown: false,
      showMunicipalityDropdown: false,
      showTypeDropdown: false,
      showStatusDropdown: false,
      userAccessLevel: 3, // Simulated user access level (1, 2, or 3)
      stats: {
        totalEquipments: 237,
        totalWells: 144,
        totalPumps: 69,
        totalReservoirs: 24
      },
      states: [
        { id: 'SP', name: 'São Paulo' },
        { id: 'RJ', name: 'Rio de Janeiro' },
        { id: 'MG', name: 'Minas Gerais' },
        { id: 'BA', name: 'Bahia' }
      ],
      municipalities: [
        { id: 1, name: 'São Paulo', state_id: 'SP' },
        { id: 2, name: 'Campinas', state_id: 'SP' },
        { id: 3, name: 'Santos', state_id: 'SP' },
        { id: 4, name: 'Rio de Janeiro', state_id: 'RJ' },
        { id: 5, name: 'Niterói', state_id: 'RJ' },
        { id: 6, name: 'Belo Horizonte', state_id: 'MG' },
        { id: 7, name: 'Salvador', state_id: 'BA' }
      ],
      equipmentTypes: ['Bomba', 'Poço', 'Reservatório', 'Sensor', 'Válvula'],
      equipments: [
        {
          id: 1,
          nome: 'Bomba Principal A1',
          codigo_ativo: 'BPA-001',
          tipo: 'Bomba',
          situacao: 'Funcionando',
          latitude: -23.5505199,
          longitude: -46.6333094,
          localizacao: 'Casa de Bombas 1',
          municipality_id: 1,
          unit_id: 1,
          descricao: 'Bomba centrífuga para abastecimento principal',
          atributos: [
            { nome_atributo: 'Capacidade', valor_atributo: '1000', unidade_medida: 'm³/h' },
            { nome_atributo: 'Potência', valor_atributo: '50', unidade_medida: 'CV' }
          ]
        },
        {
          id: 2,
          nome: 'Poço Artesiano 01',
          codigo_ativo: 'PA-001',
          tipo: 'Poço',
          situacao: 'Funcionando',
          latitude: -23.5525199,
          longitude: -46.6353094,
          localizacao: 'Área Norte',
          municipality_id: 1,
          unit_id: 2,
          descricao: 'Poço artesiano para captação de água subterrânea',
          atributos: [
            { nome_atributo: 'Profundidade', valor_atributo: '120', unidade_medida: 'm' },
            { nome_atributo: 'Vazão', valor_atributo: '800', unidade_medida: 'L/h' }
          ]
        },
        {
          id: 3,
          nome: 'Reservatório Central',
          codigo_ativo: 'RC-001',
          tipo: 'Reservatório',
          situacao: 'Manutenção',
          latitude: -23.5485199,
          longitude: -46.6313094,
          localizacao: 'Centro de Distribuição',
          municipality_id: 1,
          unit_id: 1,
          descricao: 'Reservatório principal para armazenamento',
          atributos: [
            { nome_atributo: 'Capacidade', valor_atributo: '50000', unidade_medida: 'L' },
            { nome_atributo: 'Nível Atual', valor_atributo: '75', unidade_medida: '%' }
          ]
        },
        {
          id: 4,
          nome: 'Sensor de Pressão S1',
          codigo_ativo: 'SP-001',
          tipo: 'Sensor',
          situacao: 'Funcionando',
          latitude: -23.5465199,
          longitude: -46.6373094,
          localizacao: 'Rede Principal',
          municipality_id: 2,
          unit_id: 4,
          descricao: 'Sensor de monitoramento de pressão da rede',
          atributos: [
            { nome_atributo: 'Pressão Atual', valor_atributo: '2.5', unidade_medida: 'bar' },
            { nome_atributo: 'Temperatura', valor_atributo: '22', unidade_medida: '°C' }
          ]
        },
        {
          id: 5,
          nome: 'Válvula Reguladora V1',
          codigo_ativo: 'VR-001',
          tipo: 'Válvula',
          situacao: 'Inativo',
          latitude: -23.5445199,
          longitude: -46.6393094,
          localizacao: 'Setor B',
          municipality_id: 2,
          unit_id: 5,
          descricao: 'Válvula para controle de fluxo',
          atributos: [
            { nome_atributo: 'Diâmetro', valor_atributo: '200', unidade_medida: 'mm' },
            { nome_atributo: 'Abertura', valor_atributo: '0', unidade_medida: '%' }
          ]
        }
      ],
      filteredEquipments: []
    }
  },
  computed: {
    availableMunicipalities() {
      if (!this.selectedState) return this.municipalities
      return this.municipalities.filter(m => m.state_id === this.selectedState)
    },
    selectedStateLabel() {
      if (!this.selectedState) return 'Coruripe'
      const state = this.states.find(s => s.id === this.selectedState)
      return state ? state.name : 'Coruripe'
    },
    selectedMunicipalityLabel() {
      if (!this.selectedMunicipality) return 'Todas as localidades'
      const municipality = this.municipalities.find(m => m.id == this.selectedMunicipality)
      return municipality ? municipality.name : 'Todas as localidades'
    },
    selectedTypeLabel() {
      return this.selectedType || 'Todos os tipos'
    },
    selectedStatusLabel() {
      if (!this.selectedStatus) return 'Todas as bombas'
      const statusMap = {
        'funcionando': 'Funcionando',
        'manutencao': 'Manutenção',
        'inativo': 'Inativo'
      }
      return statusMap[this.selectedStatus] || 'Todas as bombas'
    }
  },
  mounted() {
    this.initializeMap()
    this.filteredEquipments = [...this.equipments]
    this.addMarkersToMap()
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', this.closeDropdowns)
  },
  beforeUnmount() {
    if (this.map) {
      this.map.remove()
    }
    document.removeEventListener('click', this.closeDropdowns)
  },
  methods: {
    closeDropdowns(event) {
      // Check if click is outside dropdown elements
      if (!event.target.closest('.relative')) {
        this.showStateDropdown = false
        this.showMunicipalityDropdown = false
        this.showTypeDropdown = false
        this.showStatusDropdown = false
      }
    },
    getPercentage(value) {
      return Math.round((value / this.stats.totalEquipments) * 100)
    },
    
    initializeMap() {
      // Initialize the map
      this.map = L.map('map', {
        attributionControl: false // Remove Leaflet attribution
      }).setView([-23.5505199, -46.6333094], 13)

      // Add tile layer with minimal styling - using CartoDB Positron for cleaner look
      L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '', // Remove attribution
        subdomains: 'abcd',
        maxZoom: 19
      }).addTo(this.map)

      // Add custom zoom control
      L.control.zoom({
        position: 'topright'
      }).addTo(this.map)
    },
    
    addMarkersToMap() {
      // Clear existing markers
      this.markers.forEach(marker => {
        this.map.removeLayer(marker)
      })
      this.markers = []

      // Add markers for filtered equipments
      this.filteredEquipments.forEach(equipment => {
        const icon = this.getEquipmentIcon(equipment.tipo, equipment.situacao)
        
        const marker = L.marker([equipment.latitude, equipment.longitude], { icon })
          .addTo(this.map)
          .bindPopup(`
            <div class="p-2">
              <h3 class="font-semibold text-sm">${equipment.nome}</h3>
              <p class="text-xs text-gray-600">${equipment.codigo_ativo}</p>
              <p class="text-xs text-gray-600">${equipment.tipo} - ${equipment.situacao}</p>
              <button onclick="window.showEquipmentDetails(${equipment.id})" class="mt-2 px-2 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">
                Ver Detalhes
              </button>
            </div>
          `)

        this.markers.push(marker)
      })

      // Make showEquipmentDetails available globally for popup buttons
      window.showEquipmentDetails = (equipmentId) => {
        this.showEquipmentDetails(equipmentId)
      }
    },
    
    getEquipmentIcon(type, status) {
      let color = '#3B82F6' // blue default
      
      // Color based on status
      switch (status.toLowerCase()) {
        case 'funcionando':
          color = '#10B981' // green
          break
        case 'manutenção':
        case 'manutencao':
          color = '#F59E0B' // yellow
          break
        case 'inativo':
          color = '#EF4444' // red
          break
      }

      // Icon based on type
      let iconHtml = ''
      switch (type.toLowerCase()) {
        case 'bomba':
          iconHtml = '⚡'
          break
        case 'poço':
        case 'poco':
          iconHtml = '🕳️'
          break
        case 'reservatório':
        case 'reservatorio':
          iconHtml = '🏢'
          break
        case 'sensor':
          iconHtml = '📡'
          break
        case 'válvula':
        case 'valvula':
          iconHtml = '🔧'
          break
        default:
          iconHtml = '📍'
      }

      return L.divIcon({
        html: `<div style="background-color: ${color}; width: 25px; height: 25px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.2); font-size: 12px;">${iconHtml}</div>`,
        className: 'custom-div-icon',
        iconSize: [25, 25],
        iconAnchor: [12.5, 12.5]
      })
    },
    
    onStateChange() {
      this.selectedMunicipality = ''
      this.filterEquipments()
    },
    
    toggleStateDropdown() {
      this.showStateDropdown = !this.showStateDropdown
      this.showMunicipalityDropdown = false
      this.showTypeDropdown = false
      this.showStatusDropdown = false
    },
    
    toggleMunicipalityDropdown() {
      this.showMunicipalityDropdown = !this.showMunicipalityDropdown
      this.showStateDropdown = false
      this.showTypeDropdown = false
      this.showStatusDropdown = false
    },
    
    toggleTypeDropdown() {
      this.showTypeDropdown = !this.showTypeDropdown
      this.showStateDropdown = false
      this.showMunicipalityDropdown = false
      this.showStatusDropdown = false
    },
    
    toggleStatusDropdown() {
      this.showStatusDropdown = !this.showStatusDropdown
      this.showStateDropdown = false
      this.showMunicipalityDropdown = false
      this.showTypeDropdown = false
    },
    
    selectState(stateId) {
      this.selectedState = stateId
      this.selectedMunicipality = ''
      this.showStateDropdown = false
      this.filterEquipments()
    },
    
    selectMunicipality(municipalityId) {
      this.selectedMunicipality = municipalityId
      this.showMunicipalityDropdown = false
      this.filterEquipments()
    },
    
    selectType(type) {
      this.selectedType = type
      this.showTypeDropdown = false
      this.filterEquipments()
    },
    
    selectStatus(status) {
      this.selectedStatus = status
      this.showStatusDropdown = false
      this.filterEquipments()
    },
    
    filterEquipments() {
      this.filteredEquipments = this.equipments.filter(equipment => {
        const municipalityMatch = !this.selectedMunicipality || 
          equipment.municipality_id == this.selectedMunicipality
        
        const typeMatch = !this.selectedType || 
          equipment.tipo === this.selectedType
        
        const statusMatch = !this.selectedStatus || 
          equipment.situacao.toLowerCase().includes(this.selectedStatus.toLowerCase())
        
        return municipalityMatch && typeMatch && statusMatch
      })
      
      this.addMarkersToMap()
    },
    
    showEquipmentDetails(equipmentId) {
      this.selectedEquipment = this.equipments.find(eq => eq.id === equipmentId)
    },
    
    closeEquipmentModal() {
      this.selectedEquipment = null
    },
    
    editEquipment() {
      // Redirect to equipment management page with edit mode
      window.location.href = `/equipment-management?edit=${this.selectedEquipment.id}`
    },
    
    getStatusClass(status) {
      switch (status.toLowerCase()) {
        case 'funcionando':
          return 'bg-green-100 text-green-800'
        case 'manutenção':
        case 'manutencao':
          return 'bg-yellow-100 text-yellow-800'
        case 'inativo':
          return 'bg-red-100 text-red-800'
        default:
          return 'bg-gray-100 text-gray-800'
      }
    }
  }
}
</script>

<style scoped>
/* Custom styles for Leaflet map */
#map {
  z-index: 1;
}

/* Ensure Leaflet controls are properly styled */
:deep(.leaflet-control-zoom) {
  border: none !important;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
}

:deep(.leaflet-control-zoom a) {
  background-color: white !important;
  border: 1px solid #d1d5db !important;
  color: #374151 !important;
}

:deep(.leaflet-control-zoom a:hover) {
  background-color: #f9fafb !important;
}

/* Custom popup styles */
:deep(.leaflet-popup-content-wrapper) {
  border-radius: 8px !important;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1) !important;
}

:deep(.leaflet-popup-content) {
  margin: 0 !important;
}

/* Hide Leaflet attribution */
:deep(.leaflet-control-attribution) {
  display: none !important;
}
</style>

