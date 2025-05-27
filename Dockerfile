FROM php:8.2-fpm

# Installer les dépendances système et PHP nécessaires
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
    libsqlite3-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www

# Copier les fichiers du projet
COPY . .

# Copier le fichier .env si présent
COPY .env /var/www/.env

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Créer le fichier SQLite et donner les droits
RUN touch database/database.sqlite \
    && chmod -R 775 storage bootstrap/cache database/database.sqlite

# Générer la clé d'application
RUN php artisan config:clear \
    && php artisan key:generate

# Donner les bons droits
RUN chown -R www-data:www-data /var/www

# Exposer le port Laravel
EXPOSE 8000

# Lancer le serveur Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
