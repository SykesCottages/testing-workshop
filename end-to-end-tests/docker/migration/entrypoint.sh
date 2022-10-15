#!/bin/sh

cat /sql/*.sql  > /tmp/import.sql

mysql -u root -p${MYSQL_ROOT_PASSWORD} -e "GRANT ALL ON *.* TO '${MYSQL_USER}'@'%' IDENTIFIED BY '${MYSQL_PASSWORD}';"

mysql -u${MYSQL_USER} -h${MYSQL_HOST} -p${MYSQL_PASSWORD} < /tmp/import.sql
