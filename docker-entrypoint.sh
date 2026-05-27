#!/bin/bash
set -e

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Run migrations
php artisan migrate --force

# Link storage for any local fallback files
php artisan storage:link --force 2>/dev/null || true

# Clear and cache config/routes for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec "$@"
