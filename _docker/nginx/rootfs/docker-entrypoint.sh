#!/bin/sh

sed -i 's/8080/'"$PORT"'/' /etc/nginx/conf.d/default.conf
sed -i 's/listen.owner = www-data/listen.owner = nginx/g' /etc/php/7.3/fpm/pool.d/www.conf
sed -i 's/listen.group = www-data/listen.group = nginx/g' /etc/php/7.3/fpm/pool.d/www.conf

exec "$@"
