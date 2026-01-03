# Usamos PHP 8.2 FPM
FROM php:8.2-fpm

# Instalar dependencias del sistema + PostgreSQL + herramientas necesarias para Composer
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip unzip git \
    libonig-dev \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer globalmente
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Definir directorio de trabajo
WORKDIR /var/www/html

# Copiar primero composer.json y composer.lock para cache de dependencias
COPY composer.json composer.lock ./

# Instalar dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# Copiar el resto del proyecto
COPY . .

# Cachear configuración y rutas de Laravel para producción
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Permisos correctos para storage y bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Exponer puerto dinámico (Render asigna $PORT)
EXPOSE 8080

# Comando final para levantar Laravel
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=$PORT"]
