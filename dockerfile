FROM php:8.2-fpm

# Instalar dependencias del sistema + PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar primero composer.json para cache de dependencias
COPY composer.json composer.lock ./

# Instalar dependencias sin ejecutar scripts todavía
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Copiar el resto del proyecto
COPY . .

# Ahora sí ejecutar scripts de autoload porque artisan ya existe
RUN composer run-script post-autoload-dump

# Permisos correctos
RUN chown -R www-data:www-data storage bootstrap/cache

# Exponer puerto para Render
EXPOSE 8080

# Comando para ejecutar Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
