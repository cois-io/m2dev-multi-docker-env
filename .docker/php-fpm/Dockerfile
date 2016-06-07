FROM php:7.0.7-fpm

MAINTAINER Francois Raubenheimer <cois.io>

RUN apt-get update \
  && apt-get install -y \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng12-dev \
    libxslt1-dev

RUN docker-php-ext-configure \
        gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/

COPY docker-php-pecl-install /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-php-pecl-install

ENV XDEBUG_VERSION 2.4.0
RUN docker-php-pecl-install xdebug-$XDEBUG_VERSION && \
    echo "xdebug.remote_enable=1\nxdebug.remote_port=\"9001\"\nxdebug.remote_connect_back=1\nxdebug.profiler_enable=0\nxdebug.profiler_enable_trigger=1" > /usr/local/etc/php/conf.d/xdebug.ini \
    && mkdir -p /usr/local/etc/php/xdebug.d \
    && mv /usr/local/etc/php/conf.d/*xdebug.ini /usr/local/etc/php/xdebug.d/ \
    && rm -rf /tmp/pear

RUN docker-php-ext-enable xdebug

ENV PHPREDIS_VERSION php7
RUN curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz \
        && tar xfz /tmp/redis.tar.gz \
        && rm -r /tmp/redis.tar.gz \
        && mv phpredis-$PHPREDIS_VERSION /usr/src/php/ext/redis

RUN docker-php-ext-install \
        gd \
        intl \
        mbstring \
        mcrypt \
        pdo_mysql \
        xsl \
        zip \
        redis

RUN { \
    echo 'session.save_handler = redis'; \
    echo 'session.save_path = tcp://redis:6379'; \
} >> /usr/local/etc/php/conf.d/docker-php-ext-redis.ini

WORKDIR /www

EXPOSE 9000 9001
