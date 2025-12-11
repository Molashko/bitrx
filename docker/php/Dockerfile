FROM php:8.1-fpm

ARG TZ=Europe/Moscow
ENV TZ=${TZ}

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      cron \
      libzip-dev \
      libpng-dev \
      libjpeg62-turbo-dev \
      libfreetype6-dev \
      libwebp-dev \
      libicu-dev \
      libxml2-dev \
      libonig-dev \
      libssl-dev \
      libcurl4-openssl-dev \
      libmariadb-dev \
      libmariadb-dev-compat \
      zlib1g-dev \
      unzip \
      procps \
      net-tools \
      psmisc && \
    docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install -j"$(nproc)" \
      bcmath \
      exif \
      gd \
      intl \
      mbstring \
      mysqli \
      opcache \
      pdo_mysql \
      soap \
      sockets \
      xml \
      zip && \
    pecl install redis && docker-php-ext-enable redis && \
    ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime && echo ${TZ} > /etc/timezone && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY php.ini /usr/local/etc/php/conf.d/zz-bx-php.ini
COPY opcache.ini /usr/local/etc/php/conf.d/zz-bx-opcache.ini
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]

