#!/bin/sh
echo "importing TW stats..."
sleep 1
cd /store/gs/wwwcs/twstat/
/usr/local/bin/php /store/gs/wwwcs/twstat/parselog.php

