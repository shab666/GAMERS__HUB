# Image PHP avec Apache et extensions courantes
FROM php:8.2-apache

# Activer PDO SQLite
RUN docker-php-ext-install pdo pdo_sqlite

# Copier le projet
WORKDIR /var/www/html
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
