#!/bin/sh
set -e

cd /var/www/html

if [ ! -f .env ]; then
    cp .env.example .env
fi

if [ -n "$RENDER_EXTERNAL_URL" ]; then
    export APP_URL="$RENDER_EXTERNAL_URL"
fi

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs database
touch database/database.sqlite

if [ -z "$APP_KEY" ] && ! grep -q "^APP_KEY=base64:" .env; then
    php artisan key:generate --force
fi

php artisan config:clear
php artisan package:discover --force 2>/dev/null || true
php artisan migrate --force --seed || php artisan migrate --force
php artisan optimize 2>/dev/null || true

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
