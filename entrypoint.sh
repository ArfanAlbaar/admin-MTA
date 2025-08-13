#!/bin/sh

# Membuat direktori framework yang penting jika belum ada
mkdir -p /var/www/storage/framework/sessions
mkdir -p /var/www/storage/framework/views
mkdir -p /var/www/storage/framework/cache/data

# Atur ulang izin untuk memastikan Laravel bisa menulis
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Menjalankan migrasi database secara otomatis saat startup
echo "Running database migrations..."
php artisan migrate --force

echo "Setup complete. Starting services..."

# Jalankan proses utama (Supervisor)
exec "$@"