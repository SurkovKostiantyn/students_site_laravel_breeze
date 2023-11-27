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
    wget \
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

# Copy existing application directory contents to the working directory
COPY . /var/www

# Run composer update
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer update --no-interaction --no-ansi

# Change the permissions of the artisan file to make it executable
RUN chmod +x artisan

# Remove default server definition and add our own
RUN rm -rf /var/www/html

# Prevent the container from running as root
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

# Change the permissions of the working directory
RUN chown -R www-data:www-data /var/www

# Expose port 9000 and start php-fpm server
EXPOSE 9000

COPY entrypoint.sh /usr/local/bin/
ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
