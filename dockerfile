# Image Laravel officielle avec PHP 8.2 et SQLite
FROM ghcr.io/coderocker/php:8.2-laravel

# Copier tout le projet
WORKDIR /var/www/html
COPY . .

# Installer les dépendances Laravel
RUN composer install --no-interaction --optimize-autoloader

# Générer la clé Laravel
RUN php artisan key:generate

# Exposer le port fourni par Render
EXPOSE 1000
ENV PORT=1000

# Lancer Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT
