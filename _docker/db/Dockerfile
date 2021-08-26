FROM mysql:5.7

COPY _data /var/lib/mysql/
COPY init.sql /docker-entrypoint-initdb.d/init.sqlo
