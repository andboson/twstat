TWSTAT v1.25  (c) dreamW

Free PHP statistics for TeeWorlds servers, based on logfile parsing.
Product provide as is. No warranties. No complaints.

It uses Smarty Template Engine (http://www.smarty.net/) 
You can change design on yor own.
Multilanguage (en, ru  at this moment), add your language section to modules/lang.ini !
You can use it full or part in yor product.


TODO:

edit:
modules/config.php
change db_user, pass, etc.

import file
tables.sql into your database

add map images to /maps folder for display it on "maps" page. (few images already exists)

edit:
parselog.php

write full path to your TW log
ex:
parse_file('/store/gs/Teewars/tw_dm.log');

in Windows system, path must be like that:
parse_file('c:\\Games\\Teewars\\tw_dm.log');   // !double backslashes!

NOTE:
to enable log for TW server:

open your-server-config.cfg
add line:
logfile logname.log
save cfg and restart server


NOTE:
add to your crontab task for exec parselog.php

////example for FreeBSD:

SHELL=/bin/sh
PATH=/etc:/bin:/sbin:/usr/bin:/usr/sbin
HOME=/var/logs/
MAILTO=""
#minute        hour        mday        month        wday        who        command
1        *       *       *       *       /store/gs/import.sh


import.sh contens:
#!/bin/sh
echo "Importing TW logs"
sleep 1
/usr/local/bin/php /store/gs/wwwcs/twstat/parselog.php



NOTE:
to login in admin page:
admin-passw: 1  (you can change it after)

NOTE:
Directory "templates_c" must be writable ! It`s Smarty needed.

FOR USE MONITORING:
open file /teewars.mon.php
edit(or delete old) lines:
$servers[]='cs.uch.net:8303';
$servers[]='cs.uch.net:8305';

you can use monitoring file (for including) in another pages or standalone (but add header before)

enjoy!
________________________________________
dreamW 
Cherkassy, Ukraine
visit http://www.andboson.com
