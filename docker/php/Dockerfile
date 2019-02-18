FROM php:7.2-fpm

RUN apt-get update && apt-get install -y libicu-dev && apt-get clean
RUN docker-php-ext-install pdo_mysql intl exif gd opcache zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN srm -rf /tmp/

WORKDIR /usr/share/nginx/html
