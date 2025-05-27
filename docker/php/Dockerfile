# Use the official PHP image with FPM and necessary extensions
FROM php:8.4-fpm

# Set working directory
WORKDIR /var/www/html

# Install required packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    curl \
    && docker-php-ext-install intl pdo pdo_mysql opcache

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/local/bin/

# Copy application files
COPY ../.. .

RUN chown -R www-data:www-data /var/www/html

# Copy custom PHP configuration (optional)
COPY docker/php/php.ini /usr/local/etc/php/conf.d/zz-local.ini

# Expose port
EXPOSE 9000

CMD ["php-fpm"]
