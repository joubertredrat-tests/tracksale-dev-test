FROM php:7.1-fpm-alpine

MAINTAINER Joubert RedRat <eu@redrat.com.br>

RUN apk update && apk add sqlite && apk add socat

COPY . /var/www/html

RUN chown -Rf www-data:www-data /var/www/html

RUN rm -Rf /var/www/html/var/logs/*.log

USER www-data

RUN cd /var/www/html && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');"

RUN php /var/www/html/composer.phar install

RUN echo "APP_ENV=prod" > /var/www/html/.env && \
    echo "APP_SECRET=3a71a8bfa5047c1d720816a0ca077928" >> /var/www/html/.env && \
    echo "DATABASE_DRIVER=pdo_sqlite" >> /var/www/html/.env && \
    echo "DATABASE_URL=sqlite:///%kernel.project_dir%/var/data/prod.sqlite" >> /var/www/html/.env && \
    echo "IMPACT_DAYS_INTERVAL=90" >> /var/www/html/.env

RUN mkdir /var/www/html/var/data

RUN php /var/www/html/bin/console doctrine:database:create

RUN php /var/www/html/bin/console doctrine:schema:create