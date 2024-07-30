#!/bin/bash

# Start PHP-FPM
php-fpm

# Check if PHP-FPM is running
if [ ! -S /var/run/php/php7.4-fpm.sock ]; then
  echo "PHP-FPM failed to start."
  exit 1
fi

# Start Nginx
nginx -g 'daemon off;'
