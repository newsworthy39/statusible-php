FROM ubuntu:18.04 

COPY index.php /var/www/html/index.php
COPY config.php /var/www/html/config.php
COPY composer.json /var/www/html/composer.json

RUN apt-get update \
 && DEBIAN_FRONTEND=noninteractive apt-get install -y gnupg \
 && apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 14AA40EC0831756756D7F66C4F4EA0AAE5267A6C \
 && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu bionic main" >> /etc/apt/sources.list

LABEL maintainer="newsworthy39@github.com"

ENV PHP_VERSION=7.2 \
    PHP_FPM_USER=www-data

#COPY --from=add-apt-repositories /etc/apt/trusted.gpg /etc/apt/trusted.gpg
#COPY --from=add-apt-repositories /etc/apt/sources.list /etc/apt/sources.list

RUN apt-get update \
 && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
      php${PHP_VERSION}-fpm php${PHP_VERSION}-cli php${PHP_VERSION}-gd \
      php${PHP_VERSION}-pgsql php${PHP_VERSION}-mysql php${PHP_VERSION}-xml \
      php${PHP_VERSION}-mbstring composer php${PHP_VERSION}-zip git \
      && mkdir -p /run/php/ \
      && sed -i 's/^listen = .*/listen = 0.0.0.0:9000/' /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf \
      && sed -i 's/^;clear_env = .*/clear_env=no/' /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf \
      && rm -rf /var/lib/apt/lists/*


WORKDIR /var/www/html/

RUN composer install --no-dev

CMD ["/usr/sbin/php-fpm7.2", "-F"]
