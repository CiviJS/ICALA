FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar composer.json y composer.lock
COPY composer.json composer.lock ./

# Instalar dependencias sin scripts (para evitar error "artisan no existe")
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copiar el resto del proyecto
COPY . .

# Ahora sí ejecutar scripts porque artisan ya existe
RUN composer run-script post-autoload-dump

RUN chown -R www-data:www-data storage bootstrap/cache

RUN php artisan key:generate --force

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
