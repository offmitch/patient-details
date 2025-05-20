# Use PHP with Apache
FROM php:8.1-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Install "vlucas/phpdotenv" if you're using it in your project (optional)
# You need composer installed in your project for this to work

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
