FROM mysql:5.7

RUN sed -i 's/port\s*=\s*3306/port = $PORT/' /etc/mysql/my.cnf

COPY init.sql /docker-entrypoint-initdb.d/init.sqlo

ENV MYSQL_ROOT_PASSWORD="qwerty"
ENV MYSQL_TCP_PORT="$PORT"
