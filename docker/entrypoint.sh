#!/bin/sh
set -e

echo "==> Running Laravel setup..."

# Sync public/build volume with baked-in assets (volume may hold a stale build)
if ! diff -q /var/www/html/.build-artifacts/manifest.json /var/www/html/public/build/manifest.json > /dev/null 2>&1; then
    echo "==> Refreshing compiled frontend assets..."
    rm -rf /var/www/html/public/build/*
    cp -r /var/www/html/.build-artifacts/. /var/www/html/public/build/
fi

# Ensure SQLite file exists
touch /var/www/html/database/database.sqlite

# Sync migrations into the database volume (it shadows the baked-in database/ dir)
mkdir -p /var/www/html/database/migrations
cp -r /var/www/html/.migration-artifacts/. /var/www/html/database/migrations/

# Ensure required Laravel storage directories exist (missing on fresh volumes)
mkdir -p /var/www/html/storage/framework/views \
         /var/www/html/storage/framework/cache/data \
         /var/www/html/storage/framework/sessions \
         /var/www/html/storage/logs \
         /var/www/html/storage/app/public

# Fix permissions before running artisan
chown -R www-data:www-data /var/www/html/storage /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/database

# Run migrations and storage link
php artisan migrate --force
php artisan storage:link --force

# Cache configuration for production (skip view:cache — compiled on demand)
php artisan config:cache
php artisan route:cache

echo "==> Starting PHP-FPM..."
exec php-fpm
