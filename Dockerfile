# Usar a imagem oficial do PHP 8.2 com FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# Definir o diretório de trabalho dentro do contêiner
WORKDIR /var/www

# Instalar dependências do sistema, incluindo as do Node.js
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client

# --- Instalação do Node.js e NPM ---
# Adiciona o repositório do Node.js (v20.x LTS) e o instala
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs
# ------------------------------------

# Instalar as extensões do PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar o Composer (gerenciador de dependências do PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar os arquivos de dependência do PHP e instalar
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist --no-dev

# Copiar os arquivos de dependência do NPM e instalar
COPY package.json package-lock.json ./
RUN npm install

# Copiar o restante dos arquivos da aplicação
COPY . .

# Compilar os assets para produção com Vite
RUN npm run build

# Gerar o arquivo de autoload otimizado do Composer
RUN composer dump-autoload --optimize

# Ajustar permissões das pastas que o Laravel precisa escrever
RUN chown -R www-data:www-data storage bootstrap/cache

# Expor a porta 9000 para o serviço FPM
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]