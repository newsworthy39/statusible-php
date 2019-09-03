FROM ubuntu:19.04 

COPY worker.php /var/www/html/worker.php
COPY index.php /var/www/html/index.php
COPY src/ /var/www/html/src/
COPY composer.json /var/www/html/composer.json

LABEL maintainer="newsworthy39@github.com"

ENV PHP_VERSION=7.2 \
    PHP_FPM_USER=www-data \
    COMPOSER_AUTH='{"github-oauth": {"github.com": "eae69c067063f5eb3de450739a38eca6ee6cc74c" }}'

RUN apt-get update \
 && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
      php${PHP_VERSION}-fpm php${PHP_VERSION}-cli php${PHP_VERSION}-gd \
      php${PHP_VERSION}-pgsql php${PHP_VERSION}-mysql php${PHP_VERSION}-xml \
      php${PHP_VERSION}-mbstring composer php${PHP_VERSION}-zip git unzip \
      && mkdir -p /run/php/ \
      && sed -i 's/^listen = .*/listen = 0.0.0.0:9000/' /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf \
      && sed -i 's/^;clear_env = .*/clear_env=no/' /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf \
      && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html/

RUN composer install --no-dev

CMD ["/usr/sbin/php-fpm7.2", "-F"]