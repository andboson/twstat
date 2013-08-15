<?php
define('session.use_cookies', 1);
  // DB_NAME - The name of the database
 define("DB_NAME", "yur db name");
  // DB_USER - The username to connect to the database as
 define("DB_USER", "db user");
  // DB_PASS - The password for DB_USER
 define("DB_PASS", "your password");
 // DB_ADDR - The address of the database server, in host:port format.
 define("DB_ADDR", "127.0.0.1");
 
$title="MegaStyle TeeWorlds Stats";

$posts_on_page=30; //players on page
$min_kills=4;  //minimum kills to show on page
$language="en";  //possible values: "ru", "en" //for more languages, translate contens of file lang.ini and add your lang section.
$save_days=7; //days for saving player event
 
//  WEAPON_HAMMER = 0,
//  WEAPON_GUN = 1,
//  WEAPON_SHOTGUN = 2,
//  WEAPON_GRENADE = 3,
//  WEAPON_RIFLE = 4,
//  WEAPON_NINJA = 5,

// special=1 -kill flag invaders    //убил похитителя флага
// special=2 -kill haved flag       //убил кого-то, держа чужой флаг
// special=3 -kill flag invades haved flag  //убил похитителя флага, держа чужой флаг

//skill rule
// skill= skill_killer + (skill_killer / skill_victim) + weapon*5 + special*10

 

 $link=mysql_connect(DB_ADDR, DB_USER, DB_PASS);
 if (!$link) die("could not connect to server : ".mysql_error());
 mysql_select_db(DB_NAME, $link) or die ('Database disconnected : ' . mysql_error());

?>
