FROM php:8.0-apache

WORKDIR /var/www
COPY . /var/www

# https://www.twilio.com/blog/get-started-docker-laravel
# https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose
RUN apt-get update \
        && apt-get install -y \
           git \
            zip \
            curl \
            sudo \
            unzip \
            libicu-dev \
            libbz2-dev \
            libpng-dev \
            libjpeg-dev \
            libonig-dev \
            libmcrypt-dev \
            libreadline-dev \
            libfreetype6-dev \
            libzip-dev \
            g++ \
        && docker-php-ext-install \
            bz2 \
            intl \
            iconv \
            bcmath \
            opcache \
            calendar \
            mbstring \
            pdo_mysql \
            zip\
            mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# https://github.com/veevidify/laravel-apache-docker/blob/master/Dockerfile
# mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite
RUN sed -i 's/www\/html/www\/public/g' /etc/apache2/sites-enabled/000-default.conf

# https://github.com/rogerpence/docker-laravel/blob/master/app/Dockerfile
RUN groupadd -g 1000 www
RUN useradd --uid 1000 --create-home --shell /bin/bash --gid www www
RUN chown --recursive www:www /var/www
USER www

