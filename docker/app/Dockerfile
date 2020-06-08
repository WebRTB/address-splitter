FROM php:7.3-fpm-alpine

# Install packages
RUN apk --update --no-cache add wget \
    curl \
    git \
    grep \
    build-base \
    libmemcached-dev \
    libmcrypt-dev \
    libxml2-dev \
    imagemagick-dev \
    pcre-dev \
    libtool \
    make \
    autoconf \
    g++ \
    cyrus-sasl-dev \
    libgsasl-dev \
    supervisor \
    nano \
    libpng-dev \
    libzip-dev \
    nodejs \
    npm \
    openldap-dev

# Install composer (for now)
COPY ./docker/app/composer-installer.sh /usr/local/bin/composer-install
RUN chmod +x /usr/local/bin/composer-install
RUN composer-install
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer
RUN composer --version

# Cleanup
RUN rm -R /var/cache/apk \
 && apk del --purge autoconf g++ make

# Copy files to working directory
RUN mkdir -p /var/www/html && chown -R www-data:www-data /var/www/html
