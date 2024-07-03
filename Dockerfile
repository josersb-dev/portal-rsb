FROM php:8.2-apache

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd mysqli opcache zip

# Baixar e instalar o Joomla
RUN curl -L -o /tmp/joomla.zip https://downloads.joomla.org/cms/joomla4/4-2-3/Joomla_4-2-3-Stable-Full_Package.zip?format=zip && \
    unzip /tmp/joomla.zip -d /var/www/html && \
    rm /tmp/joomla.zip

# Ajustar permissões
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Habilitar mod_rewrite do Apache
RUN a2enmod rewrite
