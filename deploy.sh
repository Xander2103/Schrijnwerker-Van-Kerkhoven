#!/bin/bash

set -euo pipefail

APP_DIR="/var/www/schrijnwerkerijvankerkhoven"
BRANCH="main"

echo "🚀 Deploy Schrijnwerkerij Van Kerkhoven"

cd "$APP_DIR"

echo "→ Productieomgeving controleren..."
APP_ENV_VALUE=$(grep '^APP_ENV=' .env | cut -d '=' -f2 | tr -d '"')

if [ "$APP_ENV_VALUE" != "production" ]; then
    echo "❌ APP_ENV is niet production. Deploy afgebroken."
    exit 1
fi

echo "→ Laatste code ophalen..."
git fetch origin
git reset --hard "origin/$BRANCH"

echo "→ Composer dependencies..."
composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

echo "→ Frontend dependencies..."
npm ci

echo "→ Frontend build..."
npm run build

echo "→ Permissions klaarzetten..."
sudo chown -R deploy:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

echo "→ Laravel caches wissen..."
php artisan optimize:clear

echo "→ Database migrations..."
php artisan migrate --force

echo "→ Laravel production caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "→ Laatste controle..."
php artisan about --only=environment

echo ""
echo "✅ Deploy voltooid!"
echo "🌍 https://schrijnwerkerijvankerkhoven.be"