FROM php:5.6-apache
COPY config/php.ini /usr/local/etc/php/
RUN apt-get update -qq && apt-get install -y build-essential libmysqlclient-dev git
RUN cd /usr/bin && curl -sS https://getcomposer.org/installer | php && mv composer.phar composer && chmod +x composer
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip

RUN mkdir /app
WORKDIR /app
ADD composer.json /app/composer.json
ADD composer.lock /app/composer.lock
ADD . /app
RUN composer install
