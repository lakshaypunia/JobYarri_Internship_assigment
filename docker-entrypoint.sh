#!/bin/bash
set -e

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Ensure Laravel framework directories exist
mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions storage/logs
chown -R www-data:www-data storage bootstrap/cache

# Run migrations
php artisan migrate --force

# Link storage for any local fallback files
php artisan storage:link --force 2>/dev/null || true

# Clear and cache config/routes for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec "$@"
