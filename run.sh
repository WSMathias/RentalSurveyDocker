#! /bin/bash
docker-compose up --build  -d
docker exec -it rentalsurveydocker_mysql_1 bash /var/www/html/dump.sh
exit

