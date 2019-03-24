FROM php:7.3-fpm
MAINTAINER Jessica Smith <jess@mintopia.net>

RUN apt-get update \
    && apt-get install -y ${PHPIZE_DEPS} libzip-dev zlib1g-dev zip unzip \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip \
    && rm -vrf /tmp/pear \
    && rm -rf /var/lib/apt/lists/* \
    && mkdir -p /app /tmp \
    && chown -R 1000:1000 /app /tmp

WORKDIR /app/
RUN chown 1000:1000 /app
USER 1000

COPY --chown=1000:1000 --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --chown=1000:1000 ./src/composer.json /app/
COPY --chown=1000:1000 ./src/composer.lock /app/

RUN composer install --no-dev --no-autoloader --no-progress

COPY --chown=1000:1000 ./src/ /app/

RUN composer dump-autoload --optimize --apcu
