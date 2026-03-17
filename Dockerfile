# Production Dockerfile for Symfony (FrankenPHP)
FROM dunglas/frankenphp:1-php8.4

# Set non-interactive mode for apt
ENV DEBIAN_FRONTEND=noninteractive

# Install system dependencies
RUN apt-get update && apt-get install -y \
    acl \
    file \
    gettext \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions using the official installer provided in frankenphp
RUN install-php-extensions \
    intl \
    zip \
    opcache \
    pdo_mysql

# Install Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-progress

# Copy application files
COPY . .

# Set environment variables for production
ENV APP_ENV=prod
ENV APP_RUNTIME=Symfony\\Component\\Runtime\\GenericRuntime
ENV FRANKENPHP_CONFIG="worker ./public/index.php"
ENV SERVER_NAME=:8080

# Build assets and finalize setup
RUN composer dump-autoload --optimize --classmap-authoritative --no-dev \
    && DATABASE_URL="sqlite:///:memory:" php bin/console importmap:install \
    && DATABASE_URL="sqlite:///:memory:" php bin/console asset-map:compile \
    && chmod -R 777 var/

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

# Expose the port (Railway uses $PORT, but we'll default to 8080)
EXPOSE 8080

ENTRYPOINT ["docker-entrypoint"]
