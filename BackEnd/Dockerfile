FROM php:8.2-apache

# Cài đặt các extension cần thiết cho Laravel & MySQL
RUN apt-get update && apt-get install -is --no-install-recommends \
    libpng-dev libonig-dev libxml2-dev zip unzip git
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Cấu hình Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Copy code vào container
WORKDIR /var/www/html
COPY . .

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Phân quyền cho storage
RUN chown -R www-data:www-data storage bootstrap/cache