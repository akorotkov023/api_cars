FROM php:8.3-cli-alpine as cars
RUN apk add --no-cache git zip bash

# Setup php extensions
RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install pdo_pgsql pdo_mysql

RUN apk add --no-cache icu-dev \
    && docker-php-ext-install intl

ENV COMPOSER_CACHE_DIR=/tmp/composer-cache
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Setup php app user
ARG USER_ID=1000
RUN adduser -u ${USER_ID} -D -H app
USER app

COPY --chown=app . /app
WORKDIR /app

EXPOSE 8383

CMD ["php", "-S", "0.0.0.0:8383", "-t", "public"]
