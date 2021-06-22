FROM composer:1 AS composer
FROM php:7.4-fpm

USER root
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apt-get update \
    && apt-get install -y \
        autoconf \
        git \
        zip \
        unzip \
        zlib1g-dev \
        libssl-dev \
    && useradd -m tracking
RUN docker-php-ext-install \
        mysqli \
        pdo_mysql \
        pdo
WORKDIR /tracking-api

RUN chown -R tracking:tracking /tracking-api
USER tracking

