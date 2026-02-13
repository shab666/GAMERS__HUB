# Utiliser une image PHP avec extensions nécessaires
FROM php:8.2-cli

# Installer les dépendances système pour Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    sqlite3 \
    && docker-php-ext-install pdo pdo_sqlite zip

# Copier le projet dans le container
WORKDIR /var/www
COPY . .

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer les dépendances PHP
RUN composer install

# Générer la clé Laravel
RUN php artisan key:generate

# Exposer le port fourni par Render
EXPOSE 1000
ENV PORT=1000

# Lancer Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT
