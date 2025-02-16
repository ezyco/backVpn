FROM php:8.2-fpm

RUN apt-get update && apt-get install -y mariadb-client nano nginx libmariadb-dev libpng-dev libjpeg-dev libfreetype6-dev locales zip jpegoptim optipng pngquant gifsicle vim unzip curl libonig-dev libzip-dev libxml2-dev git libcurl4-openssl-dev libssl-dev libxslt1-dev zlib1g-dev libmcrypt-dev libfcgi-bin libxpm-dev libvpx-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd mysqli pdo pdo_mysql mbstring exif pcntl soap ftp bcmath zip opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY . .

RUN chown -R www-data:www-data /var/www/html /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
RUN chmod -R 775 /var/www/html /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

COPY docker/8.2/php.ini /usr/local/etc/php/php.ini
COPY docker/8.2/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

EXPOSE 9000
CMD ["php-fpm"]
