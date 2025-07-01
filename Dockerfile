FROM node:24-alpine AS node-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

FROM php:8.4-fpm-alpine
# Install SQLite and other dependencies
RUN apk add --no-cache \
    nginx \
    sqlite \
    sqlite-dev \
    autoconf \
    g++ \
    make

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite

WORKDIR /var/www/html
COPY . .
COPY --from=node-builder /app/public/build ./public/build

# Install Composer dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Run migrations and other Laravel setup
RUN php artisan migrate --force
RUN php artisan config:cache
RUN php artisan route:cache

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]