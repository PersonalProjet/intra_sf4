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

# Install yarn + nodejs
RUN apt-get update
RUN apt-get install -y gnupg gnupg2 gnupg1
RUN apt-get install -y gnupg gnupg2 gnupg1
RUN curl -sL https://deb.nodesource.com/setup_8.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN apt-get install -y nodejs
RUN rm nodesource_setup.sh

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
    apt-get update && apt-get install yarn

# Install Ruby + SASS + Compass
RUN apt-get update
RUN apt-get install ruby-full -y
RUN apt-get install ruby-ffi -y
RUN gem install --no-rdoc --no-ri sass -v 3.4.22
RUN gem install --no-rdoc --no-ri compass

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
