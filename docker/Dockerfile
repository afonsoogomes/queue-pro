# Use a imagem oficial do PHP com FPM
FROM --platform=linux/amd64 php:8.3-fpm

# Instale dependências necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip pcntl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Crie o diretório de trabalho e copie o código-fonte do Laravel para dentro do contêiner
WORKDIR /var/www/html
COPY ../ ./

# Ajuste as permissões do diretório do Laravel
RUN chmod -R 777 storage bootstrap

# Instale as dependências do Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs

# Configure o Supervisor para iniciar o Queue Worker
COPY ./docker/queue-worker.conf /etc/supervisor/conf.d/queue-worker.conf

# Exponha a porta 80
EXPOSE 80

# Adicione uma instrução VOLUME para persistência dos dados
VOLUME /var/www/html/database

# Inicia a aplicação
ENTRYPOINT touch /var/www/html/database/database.sqlite && \
    php artisan migrate --force && \
    php artisan db:seed --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    supervisord && \
    php artisan serve --host=0.0.0.0 --port=80
