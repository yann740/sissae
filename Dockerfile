FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer les extensions PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Copier le projet
COPY . /var/www
WORKDIR /var/www

# Copier les fichiers du projet
COPY . .

COPY . .

# Copier le fichier .env si tu l'as localement configuré
COPY .env /var/www/.env

RUN composer install --no-dev --optimize-autoloader

# Donner les droits corrects
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Générer la clé d'application
RUN php artisan key:generate

# Port par défaut utilisé par Laravel
EXPOSE 8000

# Lancer le serveur Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
