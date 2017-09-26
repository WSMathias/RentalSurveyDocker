#! /bin/bash
docker-compose up -d
docker exec -it rent_mysql_1 bash /var/www/html/dump.sh
exit

