FROM php:7.2-fpm

RUN docker-php-ext-install mysqli

RUN apt-get update && \
    apt-get install -y git zip

RUN curl --silent --show-error https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

COPY conf/nginx.conf /etc/nginx/nginx.conf
