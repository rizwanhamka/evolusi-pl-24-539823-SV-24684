# ===== Stage 1: Install dependencies PHP =====
FROM php:8.2-fpm AS base

# Install ekstensi dan tools sistem yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# --- PENTING: urutan cache ---
# Salin HANYA composer.json dan composer.lock dulu, lalu install.
# Selama kedua file ini tidak berubah, layer ini akan diambil dari cache
# walaupun kode aplikasi di bawahnya berubah.
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist --no-autoloader

# Baru sekarang salin seluruh kode aplikasi
COPY . .

# Generate autoloader setelah semua file ada
RUN composer dump-autoload --optimize

# Pastikan permission folder storage & cache benar
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
