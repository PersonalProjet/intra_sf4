FROM php:7.2-apache

RUN systemMods=" \
        net-tools \
        vim \
        dialog \
        apt-utils \
        xterm \
        man-db \
        manpages-fr \
        curl \
        wget \
        openssl \
        acl \
        htop \
        git \
        graphicsmagick \
        apache2 \
        apache2-utils \
    " \
    && apt-get update \
    && apt-get install -y $systemMods \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug && \

    # opcache setup
    docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install opcache && \

    # APCu
    pecl install apcu && \
    docker-php-ext-enable apcu

# PDO
RUN docker-php-ext-install pdo pdo_mysql

# Install composer
RUN cd $HOME && \
    wget http://getcomposer.org/composer.phar && \
    chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer

COPY ./intra.conf /etc/apache2/sites-available/
COPY ./custom.ini /etc/php7/mods-available/custom.ini
COPY ./run.sh /run.sh
RUN chmod +x /run.sh

RUN a2enmod rewrite \
    && a2enmod headers \
    && a2enmod deflate \
    && a2enmod ssl \
    && a2enmod proxy

RUN a2ensite intra.conf

WORKDIR /var/www/html

CMD ["/run.sh"]
