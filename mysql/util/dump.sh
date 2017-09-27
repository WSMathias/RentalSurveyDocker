#! /bin/bash 
echo "creating tables...."
 if($(mysql -uroot -proot surveydb < /var/lib/surveydb.sql))
      echo "done creating tables..";
 fi
exit
