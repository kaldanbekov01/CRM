# Use official PHP image with necessary extensions
FROM php:8.2-cli

# Set working directory
WORKDIR /var/www

# Install PHP + system dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    nodejs npm \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        zip

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Copy all project files
COPY . .

# Set correct permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# ✅ Install Node.js dependencies & build assets with Vite
RUN npm install && npm run build

# Laravel config cache and migrate at runtime (using Railway-injected .env)
CMD php artisan config:cache && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=8000

# Expose port
EXPOSE 8000
