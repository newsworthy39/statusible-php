FROM ubuntu:19.04 

WORKDIR /var/www/html/

COPY composer.json composer.json

LABEL maintainer="newsworthy39@github.com"

ENV PHP_VERSION=7.2 \
    PHP_FPM_USER=www-data 

RUN apt-get update \
 && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
      php${PHP_VERSION}-fpm php${PHP_VERSION}-cli php${PHP_VERSION}-gd \
      php${PHP_VERSION}-pgsql php${PHP_VERSION}-mysql php${PHP_VERSION}-xml \
      php${PHP_VERSION}-mbstring composer php${PHP_VERSION}-zip php${PHP_VERSION}-curl \
      git unzip docker.io && mkdir -p /run/php/ \
      && sed -i 's/^listen = .*/listen = 0.0.0.0:9000/' /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf \
      && sed -i 's/^;clear_env = .*/clear_env=yes/' /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf \
      && rm -rf /var/lib/apt/lists/*

RUN composer install --no-dev

COPY boyle.php boyle.php
COPY index.php index.php
COPY templates/ templates/
COPY src/ src/
COPY assets/ assets/

CMD ["/usr/sbin/php-fpm7.2", "-F"]
