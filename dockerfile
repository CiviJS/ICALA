FROM php:8.2-fpm

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip unzip git \
    && docker-php-ext-install pdo_pgsql

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar proyecto
WORKDIR /var/www
COPY . .

# Instalar dependencias PHP y construir Laravel
RUN composer install --no-dev --optimize-autoloader
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Exponer puerto
EXPOSE 8000

# Comando por defecto
CMD php artisan serve --host=0.0.0.0 --port=8000
