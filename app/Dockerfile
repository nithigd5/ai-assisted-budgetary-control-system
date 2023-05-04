FROM webdevops/php-nginx:8.2
#
#RUN apk update
#
#RUN apk add --update linux-headers
#
#RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
#    && pecl install xdebug \
#    && docker-php-ext-enable xdebug \
#    && apk del -f .build-deps
#
#RUN apk add oniguruma-dev libxml2-dev postgresql-dev supervisor
#RUN apk add openssh-server
#
#ENV ROOT_PASSWORD password


#RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.mode=debug,coverage" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.log=/var/logs/xdebug.log" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.client_port=9001" >> /usr/local/etc/php/conf.d/xdebug.ini

# Copy Composer binary from the Composer official Docker image
#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update --fix-missing && \
    apt-get install -y sudo openssh-server supervisor

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.3/install.sh | bash

RUN systemctl enable ssh

RUN service ssh start

ENV ROOT_PASSWORD password
RUN echo "application:${ROOT_PASSWORD}" | chpasswd
RUN usermod -aG sudo application


ENV WEB_DOCUMENT_ROOT /app/public

WORKDIR /app

#COPY . .

#ENV COMPOSER_ALLOW_SUPERUSER 1

#RUN composer install --no-interaction --optimize-autoloader --no-dev

## Optimizing Configuration loading
#RUN php artisan config:cache
## Optimizing Route loading
#RUN php artisan route:cache
## Optimizing View loading
#RUN php artisan view:cache

RUN chown -R application:application .

RUN mkdir -p /etc/supervisor/conf.d

#COPY supervisor /supervisor
# Create a Supervisor configuration file for the queue:work command
#RUN mv /supervisor/* /opt/docker/etc/supervisor.d/

#RUN (crontab -l ; echo "* * * * * cd /app && php artisan schedule:run >> /dev/null 2>&1") | crontab -
