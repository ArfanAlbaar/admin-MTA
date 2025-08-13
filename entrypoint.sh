#!/bin/sh

# Setel kepemilikan dan izin folder.
# Ini akan berjalan setiap kali container start, memastikan izin selalu benar.
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Membuat direktori cache view jika belum ada
mkdir -p /var/www/storage/framework/views

# Menjalankan migrasi database secara otomatis (opsional, tapi praktik yang baik)
echo "Running database migrations..."
php artisan migrate --force

# Membersihkan cache untuk memastikan semuanya baru
echo "Clearing caches..."
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan cache:clear

echo "Setup complete. Starting services..."

# Baris ini SANGAT PENTING.
# "exec" akan menggantikan proses script ini dengan proses utama (CMD dari Dockerfile).
# Ini memastikan Supervisor menjadi proses utama (PID 1) dan bisa menerima sinyal stop/kill.
exec "$@"