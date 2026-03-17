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

# Set SERVER_NAME if PORT is provided by Railway
if [ ! -z "$PORT" ]; then
    export SERVER_NAME=":$PORT"
fi

echo "Starting FrankenPHP on $SERVER_NAME..."
exec frankenphp run --config /etc/caddy/Caddyfile
