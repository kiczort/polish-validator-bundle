FROM php:cli-alpine as php-base

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /var/www/.composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk add --update icu && \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    apk del .build-deps && \
    rm -Rf /tmp/*