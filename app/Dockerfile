FROM php:7.2.10-apache
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
COPY . /var/www/html/olympic-registration-system