FROM php:7.1-fpm-alpine

#WORKDIR /usr/local/bin

ENV APCU_VERSION 5.1.8

RUN apk add --update --no-cache \
        icu-libs && \
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        icu-dev && \
    docker-php-ext-install \
        intl \
        pdo_mysql && \
    pecl install apcu-${APCU_VERSION} && \
    docker-php-ext-enable apcu && \
    docker-php-ext-enable opcache && \
    echo "memory_limit = 1024M" >> /usr/local/etc/php/php.ini && \
    echo "short_open_tag = off" >> /usr/local/etc/php/php.ini && \
    echo "date.timezone = UTC" >> /usr/local/etc/php/conf.d/symfony.ini && \
    echo "opcache.max_accelerated_files = 20000" >> /usr/local/etc/php/conf.d/symfony.ini && \
    echo "realpath_cache_size=4096K" >> /usr/local/etc/php/conf.d/symfony.ini && \
    echo "realpath_cache_ttl=600" >> /usr/local/etc/php/conf.d/symfony.ini && \
    apk del .build-deps && \
    apk add --no-cache su-exec && \
    addgroup bar && \
    adduser -D -h /home -s /bin/sh -G bar foo

ADD ./bin/* /usr/local/bin/
#RUN chmod 755 entrypoint.sh

COPY entrypoint.sh /usr/local/bin/docker-entrypoint.sh
#RUN chmod +x /usr/local/bin/docker-entrypoint.sh
#ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

ENTRYPOINT ["docker-entrypoint.sh"]