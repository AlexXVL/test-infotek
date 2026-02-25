FROM php:8.4-fpm

# Установим системные зависимости
RUN apt-get update && apt-get install -y \
    zip unzip curl libpq-dev libonig-dev libxml2-dev \
    wget apt-transport-https gnupg

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo pdo_mysql mbstring xml

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/app

# Очистка кэша
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/*