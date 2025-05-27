FROM php:8.2-fpm

RUN apt-get update && apt-get install -y git curl libpng-dev libjpeg-dev libonig-dev libxml2-dev zip unzip sqlite3 libsqlite3-dev

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

WORKDIR /var/www

COPY . .

# Copier le fichier .env si tu l'as localement configuré
COPY .env /var/www/.env

RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:clear || true
RUN php artisan key:generate || true

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]