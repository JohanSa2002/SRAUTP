# ─────────────────────────────────────────────────────────────────
# Stage 1: Build frontend assets (Node)
# ─────────────────────────────────────────────────────────────────
FROM node:20-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build

# ─────────────────────────────────────────────────────────────────
# Stage 2: PHP application
# ─────────────────────────────────────────────────────────────────
FROM php:8.2-fpm-alpine AS app

# System dependencies
RUN apk add --no-cache \
    bash \
    curl \
    sqlite \
    sqlite-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    git \
    oniguruma-dev

# PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_sqlite \
        gd \
        mbstring \
        opcache \
        bcmath \
        pcntl

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files and install PHP dependencies (no dev)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy full application source
COPY . .

# Copy compiled frontend assets from Stage 1
COPY --from=frontend /app/public/build ./public/build

# Keep a copy of compiled assets for volume initialization at runtime
RUN cp -r public/build .build-artifacts

# Finalize composer autoloader
RUN composer dump-autoload --optimize

# Create SQLite database file if it doesn't exist
RUN mkdir -p database \
    && touch database/database.sqlite

# Storage & bootstrap folders writable
RUN chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache database

# Configuración PHP de seguridad
COPY docker/php.ini /usr/local/etc/php/conf.d/99-security.ini

# Entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000

ENTRYPOINT ["entrypoint.sh"]
