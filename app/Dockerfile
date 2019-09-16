FROM php:7.2.10-apache
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
COPY . /var/www/html/olympic-registration-system
ENV HOSTNAME_IP=10.200.58.163 \
    BASE_URL=http://localhost:8888/olympic-registration-system/ \
    DB_USER=root \
    DB_PASSWORD=asdasdasd \
    DB_SCHEMA=olympic_registration_schema