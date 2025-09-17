# Hidro-Monitoring-Group

## Estrutura de Arquivos

laravel_project/
├── app/                                # Lógica principal da aplicação
│   ├── Console/                        # Comandos Artisan personalizados
│   ├── Exceptions/                     # Manipulação de exceções
│   ├── Http/                           # Camada HTTP
│   │   ├── Controllers/                # Controladores (lógica entre rotas e models)
│   │   ├── Middleware/                 # Filtros de requisições
│   ├── Models/                         # Modelos Eloquent (representam tabelas do BD)
│   └── Providers/                      # Service Providers (registro de serviços)
│
├── bootstrap/                          # Inicialização do framework
│   └── cache/                          # Cache de configuração
│
├── config/                             # Arquivos de configuração (app, db, mail, etc.)
│
├── database/                           # Banco de dados
│   ├── factories/                      # Geradores de dados falsos
│   ├── migrations/                     # Estrutura do banco (versões das tabelas)
│   └── seeders/                        # Dados iniciais para popular tabelas
│
├── public/                             # Pasta pública do servidor (raiz do site)
│   ├── index.php                       # Arquivo inicial que carrega o Laravel
│   └── storage/                        # Link simbólico para /storage/app/public
│
├── resources/                          # Recursos da aplicação
│   ├── js/                             # Scripts JS (Vite, Vue, etc.)
│   ├── lang/                           # Arquivos de tradução (pt, en, etc.)
│   ├── sass/                           # Estilos CSS/SCSS
│   └── views/                          # Views Blade (HTML + Blade)
│
├── routes/                             # Definição de rotas
│   ├── api.php                         # Rotas da API
│   ├── web.php                         # Rotas web
│   ├── console.php                     # Rotas de comandos Artisan
│   └── channels.php                    # Rotas de broadcast
│
├── storage/                            # Armazenamento de arquivos
│   ├── app/                            # Arquivos da aplicação
│   ├── framework/                      # Sessões, cache e views compiladas
│   └── logs/                           # Arquivos de log
│
├── tests/                              # Testes automatizados
│   ├── Feature/                        # Testes de funcionalidades
│   └── Unit/                           # Testes unitários
│
├── vendor/                             # Dependências do Composer
│
├── .env                                # Configurações de ambiente (BD, API keys, etc.)
├── artisan                             # CLI do Laravel
├── composer.json                       # Dependências PHP do projeto
├── package.json                        # Dependências JS do projeto
└── README.md                           # Documentação do projeto