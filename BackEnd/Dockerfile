FROM php:8.2-apache

# 1. Cài đặt thư viện hệ thống và dọn dẹp ngay để tiết kiệm dung lượng
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Cài đặt PHP extensions - GIỚI HẠN 1 luồng biên dịch (-j1) để không treo RAM
RUN docker-php-ext-install -j1 pdo_mysql mbstring exif pcntl bcmath gd

# 3. Cấu hình Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# 4. Thiết lập Working Directory
WORKDIR /var/www/html

# 5. Cài đặt Composer (Tách riêng bước copy file cấu hình để tối ưu cache)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock* ./

# 6. Chạy Composer Install với các cờ giảm tải RAM
# --no-scripts: Bỏ qua các lệnh Artisan tốn RAM lúc build
# --no-dev: Không cài thư viện testing
RUN composer install --no-interaction --no-dev --no-scripts --optimize-autoloader

# 7. Copy toàn bộ code sau khi đã cài xong vendor
COPY . .

# 8. Phân quyền
RUN chown -R www-data:www-data storage bootstrap/cache