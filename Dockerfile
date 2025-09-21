# Usar a imagem oficial do PHP 8.2 com FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# Definir o diretório de trabalho dentro do contêiner
WORKDIR /var/www

# Instalar dependências do sistema necessárias para extensões comuns do Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client

# Instalar as extensões do PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar o Composer (gerenciador de dependências do PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar os arquivos de dependência primeiro para aproveitar o cache do Docker
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist

# Copiar o restante dos arquivos da aplicação
COPY . .

# Gerar o arquivo de autoload otimizado do Composer
RUN composer dump-autoload --optimize

# Ajustar permissões das pastas que o Laravel precisa escrever
RUN chown -R www-data:www-data storage bootstrap/cache

# Expor a porta 9000 para o serviço FPM
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]