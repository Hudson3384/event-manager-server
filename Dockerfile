FROM php:8.2-fpm-bookworm

RUN apt-get update

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN mkdir -p /usr/src/app


RUN useradd -G www-data -u 1000 -d /home/app app && \
    mkdir -p /home/app/.composer && \
    chown -R app:app /home/app && \
    echo 'set -o vi' > /home/app/.bashrc && \
    echo '"\C-l":clear-screen' > /home/app/.inputrc && \
    echo 'set editing-mode vi' >> /home/app/.inputrc && \
    echo 'bind -v' > /home/app/.editrc

WORKDIR /usr/src/app

COPY composer.* package.* /usr/src/app/


COPY . /usr/src/app

RUN chown -R app: /usr/src/app

USER app





