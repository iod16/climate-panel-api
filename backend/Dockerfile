FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    libzip-dev \
    pkg-config \
    unzip \
    git \
    && docker-php-ext-install curl zip \
    && a2enmod rewrite

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .env /var/www/html/.env

COPY ./public /var/www/html/
COPY . /var/www/html/

WORKDIR /var/www/html/
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
