#!/bin/bash 
echo "creating tables...."
mysql -uroot -proot surveydb < /var/lib/surveydb.sql
exit
