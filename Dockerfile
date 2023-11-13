# Set the base image for subsequent instructions
FROM php:8.2-fpm

# Update packages and install composer and PHP dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configure the gd library
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Remove default server definition and add our own
RUN rm -rf /var/www/html

# Prevent the container from running as root
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# Copy existing application directory contents to the working directory
COPY . /var/www

# Change the permissions of the working directory
RUN chown -R www-data:www-data /var/www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
