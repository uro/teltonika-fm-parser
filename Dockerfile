FROM php:8.1-cli AS php-81-dev
RUN apt-get update && apt-get install -y git zip
COPY --from=composer:2.5 /usr/bin/composer /usr/local/bin/composer
RUN docker-php-ext-install bcmath
