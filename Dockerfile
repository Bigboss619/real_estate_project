# Use an official PHP runtime as the base image
FROM php:8.1-apache

# Copy application files to the container
COPY . /var/www/html

# Set permissions for the web server
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Enable Apache mod_rewrite for routing
RUN a2enmod rewrite
