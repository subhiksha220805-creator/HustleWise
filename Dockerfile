FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

# Allow Composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install Laravel dependencies
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --optimize-autoloader

# Laravel / Nginx configuration
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1

# Laravel production configuration
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# We already installed Composer dependencies above
ENV SKIP_COMPOSER=1

CMD ["/start.sh"]
