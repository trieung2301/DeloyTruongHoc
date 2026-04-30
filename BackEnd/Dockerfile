FROM php:8.2-apache

# 1. Cài đặt thư viện hệ thống
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Cài đặt PHP extensions (Giới hạn 1 luồng để tiết kiệm RAM)
RUN docker-php-ext-install -j1 pdo_mysql exif pcntl bcmath gd

# 3. Cấu hình Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# 4. Cài đặt Composer thực thi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Thiết lập Working Directory
WORKDIR /var/www/html

# 6. Copy file cấu hình và cài đặt vendor (Tối ưu Cache)
COPY composer.json composer.lock* ./
RUN composer install --no-interaction --no-dev --no-scripts --no-autoloader

# 7. Copy toàn bộ code Backend
COPY . .

# 8. Chạy dump-autoload và tối ưu hóa Class Map
RUN composer dump-autoload --optimize --no-scripts

# 9. PHÂN QUYỀN (Quan trọng để không bị lỗi 500)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache