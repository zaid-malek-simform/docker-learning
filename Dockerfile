FROM php:8.2-apache

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    redis-server \
    libtidy-dev \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libpq-dev \
    zlib1g \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install zip \
    && docker-php-ext-install tidy

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN apt-get update && apt-get install curl -y && apt-get install -y npm && apt-get install -y iputils-ping && apt-get install -y cron
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer -v

COPY . .

# COPY .env.example .env
# COPY ./docker/99-xdebug.ini /etc/php/8.2/apache2/conf.d/99-xdebug.ini

RUN composer install \
    && chown -R www-data:www-data vendor

RUN php artisan key:generate

# RUN php artisan migrate

# RUN php artisan migrate --env=pgsql

RUN chmod 777 -R storage/

CMD php -S 0.0.0.0:8000 -t public

EXPOSE 8000
