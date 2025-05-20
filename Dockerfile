# Use PHP with Apache
FROM php:8.1-apache

# Install required PHP extensions: mysqli and pdo_mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql

# Enable Apache rewrite module (optional)
RUN a2enmod rewrite

# Copy project files into container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose Apache
EXPOSE 80
