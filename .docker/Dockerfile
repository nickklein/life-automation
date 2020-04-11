FROM php:7.3.1-apache

COPY . /var/www/html
COPY .docker/vhosts.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y nano cron build-essential

RUN useradd -ms /bin/bash tyrion
RUN chown -R tyrion:www-data /var/www/html/ && a2enmod rewrite

RUN apt-get install -y make nano build-essential libssl-dev zlib1g-dev libbz2-dev libreadline-dev libsqlite3-dev wget curl llvm libncurses5-dev libncursesw5-dev xz-utils libmcrypt-dev mysql-client && docker-php-ext-install mysqli pdo_mysql
