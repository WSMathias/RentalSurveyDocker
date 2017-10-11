#!/bin/bash 
echo "creating tables...."
mysql -uroot -proot -hmysql surveydb < /var/lib/default.sql
exit
