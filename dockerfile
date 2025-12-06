# Imagen base con PHP y extensiones necesarias
FROM php:8.2-fpm

# Instalar dependencias del sistema necesarias para extensiones
RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer globalmente
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar SOLO composer.json y composer.lock primero (importante para caching)
COPY composer.json composer.lock ./

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copiar todo el proyecto
COPY . .

# Permisos correctos
RUN chown -R www-data:www-data storage bootstrap/cache

# Generar clave si no existe
RUN php artisan key:generate --force

# Exponer puerto interno
EXPOSE 8080

# Comando de inicio del servidor Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
