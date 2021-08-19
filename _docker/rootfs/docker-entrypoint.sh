#!/bin/sh


logMsg() {
  echo "["`date +%d'-'%b'-'%Y' '%H':'%M':'%S`"] $1" >> /proc/self/fd/2
}


rm -f /usr/local/etc/php/conf.d/zz-session.ini
if [ "$PHP_SESSION_SERVERS" != "" ]; then
  echo "session.save_path = \"$PHP_SESSION_SERVERS\"" \
    >> /usr/local/etc/php/conf.d/zz-session.ini
  logMsg "STARTUP: PHP session.save_path is set to '$PHP_SESSION_SERVERS'"
  num=$(echo "$PHP_SESSION_SERVERS" | tr -dc ',' | wc -c | tr -d ' \n')
  echo "memcached.sess_number_of_replicas = $num" \
    >> /usr/local/etc/php/conf.d/zz-session.ini
  logMsg "STARTUP: PHP memcached.sess_number_of_replicas is set to '$num'"
fi


appDir=/app
mkdir -p "$SERVE_AT"
rm -rf "$SERVE_AT"
ln -sf $appDir "$SERVE_AT"
chown -R www-data:www-data "$SERVE_AT"


exec "$@"
