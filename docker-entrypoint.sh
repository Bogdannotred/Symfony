#!/bin/sh
set -e

# Check if DATABASE_URL is set
if [ -z "$DATABASE_URL" ]; then
    echo "ERROR: DATABASE_URL is not set! Please check your Railway environment variables."
    exit 1
fi

echo "DATABASE_URL is set (Starting with: ${DATABASE_URL%%:*})"

# Clear cache to ensure environment variables are fresh
echo "Clearing cache..."
php bin/console cache:clear --no-interaction

# Run migrations
echo "Running database migrations..."
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration || echo "Migration failed, but continuing..."

# Start FrankenPHP using the simplified PHP server mode
echo "Starting FrankenPHP on port ${PORT:-8080}..."
exec frankenphp php-server -vv -l 0.0.0.0:${PORT:-8080} -r public/index.php
