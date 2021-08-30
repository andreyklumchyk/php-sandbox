#!/bin/sh

sed -i 's/8080/'"$PORT"'/' /etc/nginx/conf.d/default.conf

exec "$@"
