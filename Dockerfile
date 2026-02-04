FROM php:8.1-cli AS php-81-dev
RUN apt-get update && apt-get install -y git zip
RUN pecl install pcov && docker-php-ext-enable pcov
COPY --from=composer:2.7 /usr/bin/composer /usr/local/bin/composer
RUN docker-php-ext-install bcmath

FROM php:8.2-cli AS php-82-dev
RUN apt-get update && apt-get install -y git zip
RUN pecl install pcov && docker-php-ext-enable pcov
COPY --from=composer:2.7 /usr/bin/composer /usr/local/bin/composer
RUN docker-php-ext-install bcmath

FROM php:8.3-cli AS php-83-dev
RUN apt-get update && apt-get install -y git zip
RUN pecl install pcov && docker-php-ext-enable pcov
COPY --from=composer:2.7 /usr/bin/composer /usr/local/bin/composer
RUN docker-php-ext-install bcmath
