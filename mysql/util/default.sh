#!/bin/bash 
echo "creating tables...."
mysql -uroot -proot surveydb < /var/lib/default.sql
exit
