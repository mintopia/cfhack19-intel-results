FROM php:7.3-apache
MAINTAINER Jessica Smith <jess@mintopia.net>

RUN apt-get update \
    && apt-get install -y ${PHPIZE_DEPS} libzip-dev zlib1g-dev zip unzip \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip \
    && rm -vrf /tmp/pear \
    && rm -rf /var/lib/apt/lists/* \
    && mkdir -p /app /tmp \
    && sed -ri -e 's!/var/www/html!/app/public!g' /etc/apache2/sites-available/*.conf \
	&& sed -ri -e 's!/var/www/!/app/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
	&& a2enmod rewrite

WORKDIR /app/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./src/composer.json /app/
COPY ./src/composer.lock /app/
COPY ./dotenv /app/.env

ENV HOME=/tmp

RUN composer install --no-dev --no-autoloader --no-progress

COPY ./src/ /app/

RUN composer dump-autoload --optimize --apcu \
 	&& chown -R www-data:www-data /app/storage
