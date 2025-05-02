FROM php:8.4-fpm-alpine

WORKDIR /var/www/html/

RUN docker-php-ext-install pdo pdo_mysql

RUN echo "sendmail_path = /usr/local/bin/mailpit sendmail" > /usr/local/etc/php/conf.d/php-sendmail.ini

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer