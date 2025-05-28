FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev \
    nginx \
    supervisor \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Créer le dossier de l'application
WORKDIR /var/www

# Copier le projet
COPY . .

# Copier le .env s’il existe
COPY .env /var/www/.env

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Préparer les dossiers nécessaires et les droits
RUN mkdir -p bootstrap/cache storage \
    storage/framework/cache storage/framework/sessions storage/framework/views storage/logs \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data /var/www

# Générer la clé d’application
RUN php artisan config:clear \
    && php artisan key:generate

# Configuration nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Configuration supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Exposer le port 80 pour nginx
EXPOSE 80

# Démarrer avec Supervisor (nginx + php-fpm)
CMD ["/usr/bin/supervisord"]
