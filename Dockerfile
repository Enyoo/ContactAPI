FROM php:8.1
WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    apt-utils \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    openssl \
    curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && NPROC=$(nproc) \
    && docker-php-ext-install -j${NPROC} pdo_mysql exif pcntl bcmath gd
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /var/www
COPY --chown=www-data:www-data . /var/www
EXPOSE 9000
RUN php -v
RUN which php-fpm
CMD ["php-fpm"]