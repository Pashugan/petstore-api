FROM php:fpm-alpine

WORKDIR /usr/src/app

RUN apk update && \
    \
    apk upgrade && \
    \
    docker-php-ext-install -j$(nproc) pdo_mysql

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY install-composer.sh /usr/local/bin/
RUN install-composer.sh

COPY composer.json .
RUN php composer.phar install

COPY public/ public/
COPY src/ src/

RUN mkdir data && chown www-data:www-data data
