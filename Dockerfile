FROM ubuntu:focal

RUN DEBIAN_FRONTEND=noninteractive apt-get update

RUN DEBIAN_FRONTEND=noninteractive \
    apt-get install -yq \
    apache2 \
    build-essential \
    php7.4 \
    libapache2-mod-php7.4 \
    php7.4-bz2 \
    php7.4-cli \
    php7.4-common \
    php7.4-curl \
    php7.4-fpm \
    php7.4-gd \
    php7.4-json \
    php7.4-mbstring \
    php7.4-memcached \
    php7.4-mysql \
    php7.4-oauth \
    php7.4-opcache \
    php7.4-readline \
    php7.4-sqlite3 \
    php7.4-soap \
    php7.4-xdebug \
    php7.4-xml \
    mariadb-client \
    curl \
    git \
    imagemagick \
    vim \
    python3 \
    emacs-nox \
    elpa-php-mode \
    python-mode \
    wget \
    p7zip \
    zip

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer

CMD ["apachectl", "-D", "FOREGROUND"]

WORKDIR /var/www
