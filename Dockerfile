#
# Stage 'php-dist' creates project distribution.
#

# https://hub.docker.com/_/php
FROM php:7.3-fpm-alpine AS php-dist

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

# https://hub.docker.com/_/scratch
FROM ubuntu:bionic

RUN apt-get update \
    && apt-get install software-properties-common -y --no-install-recommends \
    && add-apt-repository ppa:ondrej/php -y

RUN apt-get install -y --no-install-recommends \
    php7.3 \
    php7.3-fpm \
    php7.3-mysql \
    php7.3-mbstring \
    php-pear \
    curl \
    unzip

RUN apt-get -qq install nginx

COPY _docker/nginx/rootfs/ /
RUN chmod +x /docker-entrypoint.sh

COPY --from=php-dist /app/ /var/www
RUN chown -R www-data:www-data /var/www

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["sh","-c","php-fpm7.3 -D && nginx -g \"daemon off;\""]

EXPOSE 8080
