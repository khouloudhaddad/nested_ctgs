# Use the official PHP 8.0 image with Apache
FROM php:8.0-apache

# Enable mod_rewrite module
RUN a2enmod rewrite

# Set the ServerName globally to suppress warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install necessary PHP extensions, including PDO MySQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql pdo

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory in the container
WORKDIR /var/www/html

# Copy application files into the container
COPY . /var/www/html/

# Set the Apache DocumentRoot to the public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# Allow .htaccess overrides in Apache
RUN echo "<Directory /var/www/html/public>" >> /etc/apache2/apache2.conf && \
    echo "    AllowOverride All" >> /etc/apache2/apache2.conf && \
    echo "    Require all granted" >> /etc/apache2/apache2.conf && \
    echo "</Directory>" >> /etc/apache2/apache2.conf

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set proper permissions for the application
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
