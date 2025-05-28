FROM php:8.2-fpm

# Installer les dépendances système nécessaires à Laravel, PHP et Vite
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

# Définir le répertoire de travail
WORKDIR /var/www

# Copier tous les fichiers du projet (y compris package.json, vite.config.js, etc.)
COPY . .

# Installer Node.js (pour Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Installer les dépendances front-end
RUN npm install

# Compiler les assets Vite
RUN npm run build

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Définir les permissions sur les dossiers Laravel
RUN mkdir -p bootstrap/cache storage/framework/{cache,sessions,views} storage/logs \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data /var/www

# Générer la clé d'application
RUN php artisan config:clear && php artisan key:generate

# Copier la configuration Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Copier la configuration Supervisor (php-fpm + nginx)
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Exposer le port 80 pour HTTP
EXPOSE 80

# Démarrer les services via Supervisor
CMD ["/usr/bin/supervisord"]
