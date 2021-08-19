#
# Stage 'dist' creates project distribution.
#

# https://hub.docker.com/_/php
FROM php:7.3-fpm-alpine AS dist

ARG VERSION

# This is awkward, but required: https://github.com/moby/moby/issues/15858
COPY conf/ /app/conf/
COPY public/ /app/public/
COPY src/ /app/src/
COPY templates/ /app/templates/
COPY vendor/ /app/vendor/

RUN rm -rf /app/vendor/twig/twig/doc \
           /app/vendor/twig/twig/ext \
           /app/vendor/twig/twig/test
RUN find /app/ -name .git -type d -prune | \
        while read d; do rm -rf $d; done
RUN find /app/ -name .gitignore -type f -prune | \
        while read d; do rm -rf $d; done

RUN printf "$VERSION" > /app/public/version




#
# Stage 'runtime' creates final Docker image to use in runtime.
#

# https://hub.docker.com/_/php
FROM php:7.3-fpm-alpine AS runtime

# Install required packages and PHP extensions
RUN apk update \
 && apk upgrade \
 && update-ca-certificates \
 && apk add --no-cache \
        ssmtp \
 && apk add --no-cache --virtual .php-ext-deps \
        libmemcached-libs zlib \
    \
 # TODO: drop
 #&& apk add --no-cache --virtual .pecl-deps \
 #&& apk add --no-cache --virtual .build-deps \
 #       libmemcached-dev zlib-dev \
 #   \
 && docker-php-ext-install \
           pdo_mysql \
 && pecl install memcached \
 && docker-php-ext-enable \
           memcached \
    \
 && apk del .pecl-deps .build-deps \
 && rm -rf /var/cache/apk/*


COPY rootfs/ /

RUN chmod +x /docker-entrypoint.sh


COPY --from=dist /app/ /app/

RUN chown -R www-data:www-data /app

ENV PHP_SESSION_SERVERS="" \
    SERVE_AT=/var/www \
    \



WORKDIR /app

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["php-fpm"]
