FROM php:8.2.24-apache

WORKDIR /var/www/html

COPY . .

RUN docker-php-ext-install mysqli

RUN a2enmod rewrite

EXPOSE 80

CMD [ "apache2-foreground" ]