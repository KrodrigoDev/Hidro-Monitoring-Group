<template>
  <div class="min-h-screen" style="background-color: #EBF7F7;">
    <!-- Header -->
    <header class="shadow-sm border-b border-gray-200" style="background-color: #EBF7F7;">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <div class="flex items-center">
            <button @click="goBack" class="text-gray-600 hover:text-gray-800 focus:outline-none focus:text-gray-800 mr-4 p-2 rounded-md hover:bg-gray-200 transition-colors">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
            </button>
            <h1 class="text-2xl font-bold text-gray-900">Gerenciamento de Usuários</h1>
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Header Section -->
      <div class="flex justify-between items-center mb-6">
        <div>
          <h2 class="text-xl font-semibold text-gray-900">Listagem de Usuários</h2>
          <p class="text-sm text-gray-600 mt-1">Gerencie os usuários do sistema</p>
        </div>
        <button @click="showCreateModal = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center space-x-2 transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          <span>Cadastrar Usuário</span>
        </button>
      </div>

      <!-- Filters Section -->
      <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <div>
            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Pesquisar Usuário</label>
            <input 
              v-model="filters.search"
              type="text" 
              id="search" 
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
              placeholder="Nome ou CPF..."
            >
          </div>
          <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Função</label>
            <select v-model="filters.role" id="role" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="">Todas as funções</option>
              <option value="admin">Administrador</option>
              <option value="user">Usuário Padrão</option>
            </select>
          </div>
          <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select v-model="filters.status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="">Todos os status</option>
              <option value="true">Ativo</option>
              <option value="false">Inativo</option>
            </select>
          </div>
          <div class="flex items-end">
            <button @click="applyFilters" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors">
              Filtrar
            </button>
          </div>
        </div>
      </div>

      <!-- Users Table -->
      <div class="bg-white rounded-lg shadow overflow-hidden">
        <div v-if="filteredUsers.length > 0" class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Nome Completo do Usuário
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  CPF
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Função
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Status
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Ações
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="user in paginatedUsers" :key="user.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="text-sm font-medium text-gray-700">{{ user.name.charAt(0).toUpperCase() }}</span>
                      </div>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                      <div class="text-sm text-gray-500">{{ user.email }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="text-sm text-gray-900 font-mono">{{ user.cpf || 'Não informado' }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="user.role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800'" class="inline-flex px-2 py-1 text-xs font-semibold rounded-full">
                    {{ user.role === 'admin' ? 'Administrador' : 'Usuário Padrão' }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="user.status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'" class="inline-flex px-2 py-1 text-xs font-semibold rounded-full">
                    {{ user.status ? 'Ativo' : 'Inativo' }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                  <button @click="editUser(user)" class="text-blue-600 hover:text-blue-900 transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar
                  </button>
                  <button @click="toggleUserStatus(user)" :class="user.status ? 'text-yellow-600 hover:text-yellow-900' : 'text-green-600 hover:text-green-900'" class="transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                    </svg>
                    {{ user.status ? 'Desativar' : 'Ativar' }}
                  </button>
                  <button @click="deleteUser(user)" class="text-red-600 hover:text-red-900 transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Excluir
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <!-- Empty State -->
        <div v-else class="text-center py-12">
          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
          </svg>
          <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum usuário encontrado</h3>
          <p class="mt-1 text-sm text-gray-500">Não há usuários cadastrados ou que correspondam aos filtros aplicados.</p>
          <div class="mt-6">
            <button @click="showCreateModal = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors">
              Cadastrar Primeiro Usuário
            </button>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div v-if="totalPages > 1" class="flex justify-center mt-6">
        <nav class="flex space-x-2">
          <button 
            @click="currentPage = Math.max(1, currentPage - 1)"
            :disabled="currentPage === 1"
            :class="currentPage === 1 ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50'"
            class="px-3 py-2 rounded-md border border-gray-300 text-sm font-medium transition-colors"
          >
            Anterior
          </button>
          
          <button 
            v-for="page in visiblePages" 
            :key="page"
            @click="currentPage = page"
            :class="page === currentPage ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
            class="px-3 py-2 rounded-md border border-gray-300 text-sm font-medium transition-colors"
          >
            {{ page }}
          </button>
          
          <button 
            @click="currentPage = Math.min(totalPages, currentPage + 1)"
            :disabled="currentPage === totalPages"
            :class="currentPage === totalPages ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50'"
            class="px-3 py-2 rounded-md border border-gray-300 text-sm font-medium transition-colors"
          >
            Próximo
          </button>
        </nav>
      </div>
    </div>

    <!-- Create/Edit User Modal -->
    <div v-if="showCreateModal || showEditModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">
              {{ showCreateModal ? 'Cadastrar Usuário' : 'Editar Usuário' }}
            </h3>
            <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
          
          <form @submit.prevent="showCreateModal ? createUser() : updateUser()">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nome Completo</label>
                <input 
                  v-model="userForm.name"
                  type="text" 
                  id="name" 
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
              </div>
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input 
                  v-model="userForm.email"
                  type="email" 
                  id="email" 
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
              </div>
              <div>
                <label for="cpf" class="block text-sm font-medium text-gray-700 mb-2">CPF</label>
                <input 
                  v-model="userForm.cpf"
                  type="text" 
                  id="cpf" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  placeholder="000.000.000-00"
                >
              </div>
              <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Data de Nascimento</label>
                <input 
                  v-model="userForm.birth_date"
                  type="date" 
                  id="birth_date" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
              </div>
              <div>
                <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Empresa</label>
                <input 
                  v-model="userForm.company"
                  type="text" 
                  id="company" 
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
              </div>
              <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Função</label>
                <select 
                  v-model="userForm.role"
                  id="role" 
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                  <option value="">Selecione uma função</option>
                  <option value="admin">Administrador</option>
                  <option value="user">Usuário Padrão</option>
                </select>
              </div>
              <div v-if="showCreateModal" class="md:col-span-2">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                <input 
                  v-model="userForm.password"
                  type="password" 
                  id="password" 
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
              </div>
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
              <button @click="closeModal" type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                Cancelar
              </button>
              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                {{ showCreateModal ? 'Cadastrar' : 'Atualizar' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UserManagementPage',
  data() {
    return {
      users: [
        { id: 1, name: "Alice Silva", email: "alice@example.com", cpf: "123.456.789-00", birth_date: "1990-01-01", company: "Empresa Exemplo", role: "admin", status: true, created_at: "2024-01-01" },
        { id: 2, name: "Bruno Costa", email: "bruno@example.com", cpf: "987.654.321-00", birth_date: "1985-05-15", company: "Empresa Exemplo", role: "user", status: true, created_at: "2024-01-05" },
        { id: 3, name: "Carla Dias", email: "carla@example.com", cpf: "111.222.333-44", birth_date: "2000-12-30", company: "Empresa Exemplo", role: "user", status: false, created_at: "2024-01-10" },
        { id: 4, name: "Daniel Santos", email: "daniel@example.com", cpf: "555.666.777-88", birth_date: "1992-08-20", company: "Empresa Exemplo", role: "user", status: true, created_at: "2024-01-15" },
        { id: 5, name: "Elena Rodrigues", email: "elena@example.com", cpf: "999.888.777-66", birth_date: "1988-03-10", company: "Empresa Exemplo", role: "admin", status: true, created_at: "2024-01-20" }
      ],
      filters: {
        search: '',
        role: '',
        status: ''
      },
      currentPage: 1,
      itemsPerPage: 10,
      showCreateModal: false,
      showEditModal: false,
      userForm: {
        id: null,
        name: '',
        email: '',
        cpf: '',
        birth_date: '',
        company: '',
        role: '',
        password: ''
      }
    }
  },
  computed: {
    filteredUsers() {
      return this.users.filter(user => {
        const matchesSearch = !this.filters.search || 
          user.name.toLowerCase().includes(this.filters.search.toLowerCase()) ||
          user.cpf.includes(this.filters.search)
        
        const matchesRole = !this.filters.role || user.role === this.filters.role
        
        const matchesStatus = this.filters.status === '' || 
          user.status.toString() === this.filters.status
        
        return matchesSearch && matchesRole && matchesStatus
      })
    },
    totalPages() {
      return Math.ceil(this.filteredUsers.length / this.itemsPerPage)
    },
    paginatedUsers() {
      const start = (this.currentPage - 1) * this.itemsPerPage
      const end = start + this.itemsPerPage
      return this.filteredUsers.slice(start, end)
    },
    visiblePages() {
      const pages = []
      const start = Math.max(1, this.currentPage - 2)
      const end = Math.min(this.totalPages, this.currentPage + 2)
      
      for (let i = start; i <= end; i++) {
        pages.push(i)
      }
      
      return pages
    }
  },
  methods: {
    goBack() {
      window.history.back()
    },
    applyFilters() {
      this.currentPage = 1
    },
    editUser(user) {
      this.userForm = { ...user }
      this.showEditModal = true
    },
    deleteUser(user) {
      if (confirm(`Tem certeza que deseja excluir o usuário ${user.name}?`)) {
        this.users = this.users.filter(u => u.id !== user.id)
        alert('Usuário excluído com sucesso!')
      }
    },
    toggleUserStatus(user) {
      const action = user.status ? 'desativar' : 'ativar'
      if (confirm(`Tem certeza que deseja ${action} o usuário ${user.name}?`)) {
        user.status = !user.status
        alert(`Usuário ${user.status ? 'ativado' : 'desativado'} com sucesso!`)
      }
    },
    createUser() {
      const newUser = {
        ...this.userForm,
        id: Math.max(...this.users.map(u => u.id)) + 1,
        status: true,
        created_at: new Date().toISOString().split('T')[0]
      }
      delete newUser.password // Remove password from display data
      
      this.users.push(newUser)
      this.closeModal()
      alert('Usuário cadastrado com sucesso!')
    },
    updateUser() {
      const index = this.users.findIndex(u => u.id === this.userForm.id)
      if (index !== -1) {
        this.users[index] = { ...this.userForm }
        this.closeModal()
        alert('Usuário atualizado com sucesso!')
      }
    },
    closeModal() {
      this.showCreateModal = false
      this.showEditModal = false
      this.userForm = {
        id: null,
        name: '',
        email: '',
        cpf: '',
        birth_date: '',
        company: '',
        role: '',
        password: ''
      }
    }
  }
}
</script>

<style scoped>
/* Additional custom styles if needed */
</style>

