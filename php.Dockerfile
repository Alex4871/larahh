FROM php:8.2-fpm-alpine

ARG USER_ID=1000
ARG GROUP_ID=1000

WORKDIR /var/www/larahh

RUN apk add --no-cache \
    git \
    curl \
    unzip \
    libzip-dev \
    zlib-dev \
    shadow \
    && docker-php-ext-install pdo pdo_mysql zip

RUN addgroup -g $GROUP_ID larahh && \
    adduser -D -u $USER_ID -G larahh larahh

USER larahh

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer