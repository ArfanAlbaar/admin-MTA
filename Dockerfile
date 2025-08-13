FROM php:8.2.12-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    supervisor

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy source code
COPY . /var/www

# Salin file-file konfigurasi ke lokasi yang BENAR di dalam image
COPY nginx.conf /etc/nginx/sites-enabled/default
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Salin dan siapkan entrypoint script untuk otomatisasi
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Atur entrypoint untuk menjalankan script kita
ENTRYPOINT ["entrypoint.sh"]

# CMD sekarang akan menjadi argumen untuk entrypoint script ("$@")
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]