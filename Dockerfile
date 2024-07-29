FROM richarvey/nginx-php-fpm:1.7.2

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install application dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy application files again to ensure they are up to date after dependency installation
COPY . .

# Set permissions for storage and cache directories
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose the port for nginx
EXPOSE 80

CMD ["/start.sh"]
