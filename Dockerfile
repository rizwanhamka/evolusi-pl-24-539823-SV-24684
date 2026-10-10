# syntax=docker/dockerfile:1

# ========== STAGE 1: BUILD (boleh besar) ==========
FROM composer:2.8 AS build

WORKDIR /app

# Cache: salin composer.json & composer.lock lebih dulu (sama seperti Tugas 4)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader \
    --no-interaction --prefer-dist --ignore-platform-reqs

# Baru salin kode aplikasi, lalu buat autoloader
COPY . .
RUN composer dump-autoload --optimize --no-dev

# ========== STAGE 2: RUNTIME (hanya yang dibutuhkan) ==========
FROM php:8.2.27-cli-alpine AS runtime

LABEL org.opencontainers.image.source="https://github.com/rizwanhamka/evolusi-pl-24-539823-sv-24684"

# User non-root
RUN addgroup -S app && adduser -S -G app app

WORKDIR /var/www/html

# Hanya hasil dari stage build (tanpa Composer, tanpa cache build)
COPY --from=build --chown=app:app /app ./

# Siapkan file SQLite dan folder yang harus bisa ditulis
RUN touch database/database.sqlite \
    && mkdir -p storage/framework/cache/data storage/framework/sessions \
                storage/framework/views storage/logs bootstrap/cache \
    && chown -R app:app storage bootstrap/cache database

USER app

EXPOSE 8000

HEALTHCHECK --interval=30s --timeout=5s --start-period=15s --retries=3 \
  CMD wget -q -O /dev/null http://127.0.0.1:8000/up || exit 1

CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]
