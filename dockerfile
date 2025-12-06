# Imagen base con PHP 8.2
FROM php:8.2-fpm

# Instala extensiones necesarias y herramientas
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Carpeta de trabajo dentro del contenedor
WORKDIR /var/www

# Copia todos los archivos de tu proyecto
COPY . .

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Expone el puerto que Render asignará
EXPOSE 10000

# Comando para levantar Laravel
CMD php artisan serve --host 0.0.0.0 --port 10000
