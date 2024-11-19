# Imagen base
FROM php:8.3.11-apache

RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html

COPY ./public/.htaccess /var/www/html/.htaccess

WORKDIR /var/www/html

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

COPY .env.example .env
RUN php artisan key:generate

RUN a2enmod rewrite

RUN chmod -R 777 storage bootstrap/cache

EXPOSE 80


CMD ["apache2-foreground"]
