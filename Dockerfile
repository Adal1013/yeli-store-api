FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libicu-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    wget \
    libmagickwand-dev --no-install-recommends \
    poppler-utils \
    mariadb-client

RUN docker-php-ext-install pdo mysqli pdo_mysql mbstring exif pcntl bcmath gd zip mbstring intl sockets

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN sh -c "$(wget -O- https://github.com/deluan/zsh-in-docker/releases/download/v1.1.5/zsh-in-docker.sh)" -- \
    -t robbyrussell \
    -p git \
    -p https://github.com/zsh-users/zsh-autosuggestions \
    -p https://github.com/zsh-users/zsh-completions
RUN usermod -s $(which zsh) www-data

# Installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Changing Workdir
WORKDIR /var/www/html

# Changing permissions during the build
USER root
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Change current user to www
USER www-data
