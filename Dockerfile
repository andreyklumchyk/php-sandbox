#
# Stage 'composer-dist' process composer dependencies.
#

# https://hub.docker.com/_/composer
FROM composer:latest AS composer-dist

COPY composer.* /deps/

WORKDIR /deps

RUN bash -c "composer install --no-interaction --no-progress --no-dev --optimize-autoloader"

RUN rm -rf /app/vendor/twig/twig/doc \
           /app/vendor/twig/twig/ext \
           /app/vendor/twig/twig/test



#
# Stage 'php-dist' creates project distribution.
#

# https://hub.docker.com/_/php
FROM php:7.3-fpm-alpine AS php-dist

ARG VERSION

# This is awkward, but required: https://github.com/moby/moby/issues/15858
COPY _dev/conf/ /app/conf/
COPY public/ /app/public/
COPY src/ /app/src/
COPY templates/ /app/templates/
COPY --from=composer-dist /deps/vendor/ /app/vendor/

RUN printf "$VERSION" > /app/public/version


#
# Stage 'runtime' creates final Docker image to use in runtime.
#

# https://hub.docker.com/_/alpine
FROM alpine:3.12

# TODO: remove obsolete packages
# Install packages and remove default server definition
RUN apk --no-cache add php7 php7-fpm php7-opcache php7-mysqli php7-json php7-openssl php7-curl \
    php7-zlib php7-xml php7-phar php7-intl php7-dom php7-xmlreader php7-ctype php7-session \
    php7-mbstring php7-gd nginx supervisor curl && \
    rm /etc/nginx/conf.d/default.conf

# Configure services
COPY --chown=nobody _docker/rootfs/ /
RUN chmod +x /docker-entrypoint.sh

# Setup document root
RUN mkdir -p /var/www/app

ENTRYPOINT ["/docker-entrypoint.sh"]

# Expose the port nginx is reachable on
EXPOSE 8080

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nobody.nobody /var/www/app && \
  chown -R nobody.nobody /run && \
  chown -R nobody.nobody /var/lib/nginx && \
  chown -R nobody.nobody /var/log/nginx

# Switch to use a non-root user from here on
USER nobody

# Add application
WORKDIR /var/www/app
COPY --chown=nobody --from=php-dist /app/ /var/www/app/


# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
