# Gunakan image PHP + Apache
FROM php:8.2-apache

# Salin semua file proyek ke dalam container
COPY . /var/www/html/

# Atur permission (opsional, kalau butuh)
RUN chown -R www-data:www-data /var/www/html \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && a2enmod rewrite

# Buka port 80
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
