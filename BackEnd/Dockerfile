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

# 2. Cài đặt PHP extensions
RUN docker-php-ext-install -j1 pdo_mysql exif pcntl bcmath gd

# 3. Cấu hình Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# 4. Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Thiết lập thư mục làm việc
WORKDIR /var/www/html

# 6. Copy file composer để tận dụng Docker Cache
COPY composer.json composer.lock* ./
RUN composer install --no-interaction --no-dev --no-scripts --ignore-platform-reqs --no-autoloader

# 7. Copy toàn bộ code vào
COPY . .

# 8. Xử lý thư mục và phân quyền (Dùng lệnh mkdir -p để tự tạo nếu thiếu)
RUN mkdir -p storage/framework/sessions \
             storage/framework/views \
             storage/framework/cache/data \
             storage/logs \
             bootstrap/cache

# Dọn dẹp các file cache cũ lỡ có trong code
RUN rm -rf bootstrap/cache/*.php storage/framework/views/*.php

# Phân quyền (Thêm kiểm tra thư mục tồn tại để tránh lỗi exit code 1)
RUN if [ -d "/var/www/html/storage" ]; then chown -R www-data:www-data /var/www/html/storage; fi
RUN if [ -d "/var/www/html/bootstrap/cache" ]; then chown -R www-data:www-data /var/www/html/bootstrap/cache; fi

RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 9. Chạy Autoload
RUN composer dump-autoload --optimize --no-scripts