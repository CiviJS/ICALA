FROM php:8.2-fpm

# Instalar PostgreSQL para PHP
RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql

# Composer desde imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar composer.json primero
COPY composer.json composer.lock ./

# Instalar dependencias sin scripts (porque artisan aún no existe)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copiar el proyecto
COPY . .

# Ejecutar scripts ahora que artisan existe
RUN composer run-script post-autoload-dump

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
