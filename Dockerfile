FROM php:apache

RUN a2enmod rewrite

RUN apt-get update && apt-get upgrade -y && apt-get install -y \
      procps \
      nano \
      git \
      unzip \
      libicu-dev \
      zlib1g-dev \
      libxml2 \
      libxml2-dev \
      libreadline-dev \
      supervisor \
      cron \
      sudo \
      libzip-dev \
      libcurl4-openssl-dev\
      pkg-config\
      libssl-dev\
      && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
      && docker-php-ext-configure intl \
      && docker-php-ext-install \
      pdo \
      pdo_mysql \
      sockets \
      intl \
      opcache \
      zip \
      && rm -rf /tmp/* \
      && rm -rf /var/list/apt/* \
      && rm -rf /var/lib/apt/lists/* \
      && apt-get clean

RUN docker-php-ext-configure calendar && docker-php-ext-install calendar

WORKDIR /var/www/html

## COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
## RUN install-php-extensions gd bcmath zip intl opcache

# instalación de Composer
COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer

# instalación de phpDocumentor
COPY --from=phpdoc/phpdoc /opt/phpdoc/bin/phpdoc /usr/local/bin/phpdoc

# instalación de XDebug
RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY ./debug.ini "${PHP_INI_DIR}/conf.d"

# instalación de phpunit
RUN composer global require phpunit/phpunit && ln -s /var/www/html/vendor/bin/phpunit /usr/local/bin/phpunit