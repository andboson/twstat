<?php
include('modules/config.php');

function get_lang(){
     $file="modules/lang.ini";
     $lang_arr=array_keys (parse_ini_file($file,true));
     foreach ($lang_arr as $value) {
       $output[]="<a href=\"index.php?lg={$value}\">[{$value}]</a>";
     }

return $output;
}


function load_lang($language) {
 $file="modules/lang.ini";
 if (file_exists($file ))  {
        $var = parse_ini_file($file,true);
        } else die("lang file not exists !");
  return $var[$language];
}

function check_lang(){
global $language;
  if (isset($_COOKIE['tw_lang'])) {
     $language=$_COOKIE['tw_lang'];
     }
return $language;
}

function set_lang($lg){
global $language;
   setcookie("tw_lang",$lg, time() + 904800);
  // print_r($_COOKIE);
$language=$lg;
header("Location: index.php");
}


function set_password() {
$passw=$_POST['passw'];
  $passw=md5($passw);
       $result = mysql_query("UPDATE twstat_config SET cvalue=\"$passw\" WHERE ckey='admin'");
    if (!$result) {
      die("Can`t change password !:" . mysql_error());
      } else  {
        unset($_SESSION['pwd']);
        }
}


function hide_player() {
$id=$_POST['hide'];
       if (!is_numeric($id)) die("PlayerId must be a Number".$id);
       $result = mysql_query("UPDATE twstat_players SET hidden=1 WHERE id=\"$id\"");
    if (!$result) die("Can`t change player !:" . mysql_error());
}


function del_player() {
$id=$_POST['del'];
       if (!is_numeric($id)) die("PlayerId must be a Number".$id);
  $name=get_player_name($id);
        $result = mysql_query("DELETE FROM twstat_players WHERE id=\"$id\"");
    if (!$result) die("Can`t delete player  from Players!:" . mysql_error());

        $result = mysql_query("DELETE FROM twstat_ctf WHERE player=\"$name\"");
    if (!$result) die("Can`t delete player  from CTF !:" . mysql_error());

        $result = mysql_query("DELETE FROM twstat_weapon WHERE player=\"$name\"");
    if (!$result) die("Can`t delete player  from Weapon !:" . mysql_error());
}

function checkuser($pas)
{     $password = md5($pas);
    $result = mysql_query("SELECT * FROM twstat_config WHERE cvalue=\"$password\"");
    if (!$result)
        die("can`t check user !:" . mysql_error());
    $data = mysql_fetch_row($result);
    if (mysql_affected_rows() < 1) {
        $errstr[] = "User with this password not exists !   <br>";
        return $errstr;
    }
}

function checkauth() {
//print_r($_SESSION);
 if(isset($_SESSION['pwd'])) {
    $pwd=$_SESSION['pwd'];
    $errstr = checkuser($pwd);
    if ($errstr) die($errstr[0]);

  } else die("Not logged !");
}

function login() {
$log_pass=$_POST['log_pass'];
$_SESSION['pwd']=$log_pass;
//print_r($_SESSION);
}

function auth(){
$out="<div style=\"width:100%; height:100%; position:absolute;top:0;left:0; background:#91c5ff\">";
$out.="<div style=\"width:200px; height:200px; position:absolute;top:35%;left:35%\"><center>";
$out.="<br><fieldset s><legend>Login:</legend>";
$out.="<form method=\"POST\" name=\"login\" action=\"index.php?mode=logged\">";
$out.="Password:<input type=pasword name=log_pass size=10><br><br>";
$out.="<input type=submit value=login style=\"border:1px solid gray; height:30px;width:150px\">";
$out.="</form></fieldset></div></div>";
echo $out;
}

function show_pages() {
     global $all_pages,$posts_on_page,$sort_order,$page, $min_kills;
       $sql="SELECT COUNT(*) FROM twstat_players WHERE kills>$min_kills ";
       $result=mysql_query($sql)or die("not COUNT PLAYERS ! error:".mysql_error());
       $data=mysql_fetch_row($result);
       $all_pages=ceil($data[0]/$posts_on_page);
     $pag=array();
      $base_url="index.php?sort=$sort_order";
           for ($i=1;$i<($all_pages+1);$i++) {
                 if ($i==($page)) { $pag[]="[<B>".($i)."</B>]";
                  }  else  $pag[]="<a href=\"$base_url&page=$i\">[".($i)."]</a>";
             }
      return $pag;
  }

function get_player($id){
           $sql="SELECT * FROM twstat_players WHERE id=\"$id\"";
           $result=mysql_query($sql)or die("player in PLAYERS not selected ! error:".mysql_error());
           if (mysql_num_rows($result)<1) die("Player not exists !");
           $data=mysql_fetch_array($result);
           $output['name']=$data['name'];
           $output['kills']=$data['kills'];
           $output['death']=$data['death'];
           $output['id']=$id;

           if ($data['death']==0) { $output['kpd']=$data['kills'];
                } else $output['kpd']=$data['kills']/$data['death'];

           $output['skill']=$data['skill'];

           $pl_name=$data['name'];
           $sql="SELECT * FROM twstat_ctf WHERE player=\"$pl_name\"";
           $result=mysql_query($sql)or die("player in CTF not selected ! error:".mysql_error());
           $data=mysql_fetch_array($result);
           $output['event_capt']=$data['flag_capture'];
           $output['event_grab']=$data['flag_grab'];
           $output['event_return']=$data['flag_return'];
           $output['event_drop']=$data['flag_drop'];
            $output['event_special1']=$data['1'];
            $output['event_special2']=$data['2'];
            $output['event_special3']=$data['3'];

           $sql="SELECT * FROM twstat_weapon WHERE player=\"$pl_name\"";
           $result=mysql_query($sql)or die("player in WEAPON not selected ! error:".mysql_error());
           $data=mysql_fetch_array($result);
            $output['0']=$data['0'];
            $output['1']=$data['1'];
            $output['2']=$data['2'];
            $output['3']=$data['3'];
            $output['4']=$data['4'];
            $output['5']=$data['5'];
return $output;
}

function get_player_id($name) {
           $sql="SELECT id FROM twstat_players WHERE name=\"$name\"";
           $result=mysql_query($sql)or die("playerId in PLAYERS not selected ! error:".mysql_error());
           if (mysql_num_rows($result)<1) die("Player not exists !");
           $data=mysql_fetch_row($result);
return $data[0];
}


function get_player_name($id) {
           $sql="SELECT name FROM twstat_players WHERE id=\"$id\"";
           $result=mysql_query($sql)or die("player name in PLAYERS not selected ! error:".mysql_error());
           if (mysql_num_rows($result)<1) die("Player not exists !");
           $data=mysql_fetch_row($result);
return $data[0];
}

function get_awards(){

 $sql[]="select player from twstat_ctf where flag_grab=(select MAX(flag_grab) from twstat_ctf)";
 $sql[]="select player from twstat_ctf where flag_capture=(select MAX(flag_capture) from twstat_ctf)";
 $sql[]="select player from twstat_ctf where flag_drop=(select MAX(flag_drop) from twstat_ctf)";
 $sql[]="select player from twstat_ctf where flag_return=(select MAX(flag_return) from twstat_ctf)";
 $sql[]="select player from twstat_ctf where 3=(select MAX(3) from twstat_ctf)"; //special 3
 $sql[]="select player from twstat_weapon where `0`=(select MAX(`0`) from twstat_weapon)";
 $sql[]="select player from twstat_weapon where `1`=(select MAX(`1`) from twstat_weapon)";
 $sql[]="select player from twstat_weapon where `2`=(select MAX(`2`) from twstat_weapon)";
 $sql[]="select player from twstat_weapon where `3`=(select MAX(`3`) from twstat_weapon)";
 $sql[]="select player from twstat_weapon where `4`=(select MAX(`4`) from twstat_weapon)";
 $sql[]="select player from twstat_weapon where `5`=(select MAX(`5`) from twstat_weapon)";
  $sql[]="select name, kills from twstat_players ORDER BY kills DESC LIMIT 1";
  $sql[]="select name, death from twstat_players ORDER BY death DESC LIMIT 1";

 $i=0;
 while ($i<13) {
   $result=mysql_query($sql[$i])or die("AWARDS not selected ! error:".mysql_error());
  $data=mysql_fetch_row($result);
  $i++;
   $data2[]=$data[0];
 }
  $output['grabber']=$data2[0];
  $output['grabberId']=get_player_id($data2[0]);
  $output['dropper']=$data2[1];
  $output['dropperId']=get_player_id($data2[1]);
  $output['returner']=$data2[2];
  $output['returnerId']=get_player_id($data2[2]);
  $output['capturer']=$data2[3];
  $output['capturerId']=get_player_id($data2[3]);
  $output['w_f_killer']=$data2[4];
  $output['w_f_killerId']=get_player_id($data2[4]);
  $output['hammer']=$data2[5];
  $output['hammerId']=get_player_id($data2[5]);
  $output['gun']=$data2[6];
  $output['gunId']=get_player_id($data2[6]);
  $output['shotgun']=$data2[7];
  $output['shotgunId']=get_player_id($data2[7]);
    $output['grenade']=$data2[8];
    $output['grenadeId']=get_player_id($data2[8]);
      $output['rifle']=$data2[9];
      $output['rifleId']=get_player_id($data2[9]);
        $output['ninja']=$data2[10];
        $output['ninjaId']=get_player_id($data2[10]);
        $output['mkills']=$data2[11];
        $output['mkillsId']=get_player_id($data2[11]);
        $output['mdeath']=$data2[12];
        $output['mdeathId']=get_player_id($data2[12]);

  //        print_r($output);
 return $output;
}


function get_top20($award) {
 switch ($award) {
    case 'm_kills':
      $sql="select name, kills, id FROM twstat_players ORDER BY kills DESC LIMIT 20";
      break;
    case 'm_death':
      $sql="select name, death, id FROM twstat_players ORDER BY death DESC LIMIT 20";
      break;

    case 'f_capturer':
      $sql="SELECT twstat_ctf.player,twstat_ctf.flag_capture, twstat_players.id  FROM twstat_ctf,twstat_players WHERE twstat_players.name=twstat_ctf.player ORDER BY twstat_ctf.flag_capture DESC LIMIT 20";
      break;
    case 'f_dropper':
      $sql="SELECT twstat_ctf.player,twstat_ctf.flag_drop, twstat_players.id  FROM twstat_ctf,twstat_players WHERE twstat_players.name=twstat_ctf.player ORDER BY twstat_ctf.flag_drop DESC LIMIT 20";
      break;
    case 'f_grabber':
      $sql="SELECT twstat_ctf.player,twstat_ctf.flag_grab, twstat_players.id  FROM twstat_ctf,twstat_players WHERE twstat_players.name=twstat_ctf.player ORDER BY twstat_ctf.flag_grab DESC LIMIT 20";
      break;
    case 'f_returner':
      $sql="SELECT twstat_ctf.player,twstat_ctf.flag_return, twstat_players.id  FROM twstat_ctf,twstat_players WHERE twstat_players.name=twstat_ctf.player ORDER BY twstat_ctf.flag_return DESC LIMIT 20";
      break;
    case 'w_f_killer':
      $sql="SELECT twstat_ctf.player,twstat_ctf.3, twstat_players.id  FROM twstat_ctf,twstat_players WHERE twstat_players.name=twstat_ctf.player ORDER BY twstat_ctf.3 DESC LIMIT 20";
      break;



   case 'hammer':
      $sql="SELECT twstat_weapon.player,twstat_weapon.0, twstat_players.id  FROM twstat_weapon,twstat_players WHERE twstat_players.name=twstat_weapon.player ORDER BY `0` DESC LIMIT 20";
      break;
   case 'gun':
      $sql="SELECT twstat_weapon.player,twstat_weapon.1, twstat_players.id  FROM twstat_weapon,twstat_players WHERE twstat_players.name=twstat_weapon.player ORDER BY `1` DESC LIMIT 20";
      break;
   case 'shotgun':
      $sql="SELECT twstat_weapon.player,twstat_weapon.2, twstat_players.id  FROM twstat_weapon,twstat_players WHERE twstat_players.name=twstat_weapon.player ORDER BY `2` DESC LIMIT 20";
      break;
   case 'grenade':
      $sql="SELECT twstat_weapon.player,twstat_weapon.3, twstat_players.id  FROM twstat_weapon,twstat_players WHERE twstat_players.name=twstat_weapon.player ORDER BY `3` DESC LIMIT 20";
      break;
   case 'rifle':
      $sql="SELECT twstat_weapon.player,twstat_weapon.4, twstat_players.id  FROM twstat_weapon,twstat_players WHERE twstat_players.name=twstat_weapon.player ORDER BY `4` DESC LIMIT 20";
      break;
   case 'ninja':
      $sql="SELECT twstat_weapon.player,twstat_weapon.5, twstat_players.id  FROM twstat_weapon,twstat_players WHERE twstat_players.name=twstat_weapon.player ORDER BY `5` DESC LIMIT 20";
      break;
  default:
       $sql="SELECT twstat_weapon.player,twstat_weapon.0, twstat_players.id  FROM twstat_weapon,twstat_players WHERE twstat_players.name=twstat_weapon.player ORDER BY `0` DESC LIMIT 20";
      break;
  }

  $result=mysql_query($sql)or die("top20 not selected ! error:".mysql_error());
  $i=1;
 while ($data=mysql_fetch_row($result)) {
   $out['id'][]=$i;
 //  $out['pl_id'][]=get_player_id($data[0]);
  $out['pl_id'][]=$data[2];
   $out['player'][]=$data[0];
   $out['cat_value'][]=$data[1];
   $i++;
   }
  return $out;
}

//$r=get_top20('hammer');
//echo $r['name'][0]."==".$r['weapon'][0];

function all_players(){
    global $posts_on_page,$all_pages,$sort_order,$page, $min_kills;
  //$start=$posts_on_page*$page;
    $page_curr=$page-1;
    $start=$posts_on_page*$page_curr;

    $sql="SELECT * FROM twstat_players";
    $sql.=" WHERE kills>$min_kills AND hidden=0";
       switch ($sort_order) {
       case 0:
        $sql.=" ORDER BY skill ";
       break;
       case 1:
        $sql.=" ORDER BY name ";
       break;
       case 2:
        $sql.=" ORDER BY kills ";
       break;
       case 3:
        $sql.=" ORDER BY death ";
       break;
       case 4:
        $sql.=" ORDER BY skill ";
       break;
       case 5:
        $sql.=" ORDER BY skill ";
       break;
       }
       $sql.=" DESC LIMIT $start,$posts_on_page";
        $result=mysql_query($sql)or die("in PLAYERS not selected ! error:".mysql_error());
        $i=0;
        while ($p_data=mysql_fetch_array($result)) {
        if (strlen($p_data['name'])<2) continue;
          $i++;
          $output['id'][]=$start+$i;
          $output['player_id'][]=$p_data['id'];
          $output['name'][]=html_entity_decode(htmlspecialchars($p_data['name']));
          $output['kills'][]=$p_data['kills'];
          $output['death'][]=$p_data['death'];
          if ($p_data['death']>0)  { $output['kpd'][]=number_format(($p_data['kills']/$p_data['death']),2);
                } else  $output['kpd'][]=$p_data['kills'];
          $output['ctf'][]=$p_data['ctf'];
          $output['skill'][]=$p_data['skill'];
        }
     return $output;
}


function get_maps() {
        $sql="SELECT * FROM twstat_maps ORDER BY name";
        $m_result=mysql_query($sql)or die("in MAPS not selected ! error:".mysql_error());
        $i=0;
        while ($m_data=mysql_fetch_array($m_result)) {
          $i++;
          $output['id'][]=$i;
          $output['name'][]=$m_data['name'];
          $output['kills'][]=$m_data['kills'];
          $output['used'][]=$m_data['used'];
          $output['captured'][]=$m_data['captured'];
          $map="maps/".$m_data['name'].".jpg";
          if (!file_exists($map)) $map="maps/noimage.jpg";
          $output['image'][]=$map;
       }
 return $output;
}



//////// for parsefile functions:

function truncate_logs() {
          $sql="TRUNCATE TABLE twstat_weapon ";
          $result=mysql_query($sql)or die("in twstat_dm_log not truncated ! error:".mysql_error());
          $sql="TRUNCATE TABLE twstat_ctf ";
          $result=mysql_query($sql)or die("in twstat_ctf_log not truncated ! error:".mysql_error());
          $sql="TRUNCATE TABLE twstat_log_seek ";
          $result=mysql_query($sql)or die("in twstat_log_seek not truncated ! error:".mysql_error());
          $sql="TRUNCATE TABLE twstat_players ";
          $result=mysql_query($sql)or die("in twstat_players not truncated ! error:".mysql_error());
          $sql="TRUNCATE TABLE twstat_maps ";
          $result=mysql_query($sql)or die("in twstat_maps not truncated ! error:".mysql_error());
          $sql="UPDATE twstat_config SET cvalue=\"0\" WHERE ckey='check_date'";
          $result=mysql_query($sql)or die("in twstat_config not truncated ! error:".mysql_error());
          echo "<BR>==truncate all logs done !!==";

return "<br>=ALL LOGS TRUNCATED=";
}



function lastparse(){
     $sql="SELECT * FROM twstat_config WHERE ckey=\"lastparse\"";
     $result=mysql_query($sql)or die("lastparse in Config not selected ! error:".mysql_error());

     $time=time();
     if (mysql_num_rows($result)<1) {
             $sql="INSERT INTO twstat_config(ckey, cvalue) VALUES (\"lastparse\",\"$time\")";
     } else {
        $sql="UPDATE twstat_config SET cvalue=\"$time\" WHERE ckey=\"lastparse\"";
        }
       $result2=mysql_query($sql);
       if (!$result2) die("lastparse in config not inserted ! error:".mysql_error());
return;
}
function lastparse_check(){
     $sql="SELECT cvalue FROM twstat_config WHERE ckey=\"lastparse\"";
     $result=mysql_query($sql)or die("lastparse check in Config not selected ! error:".mysql_error());
     $data=mysql_fetch_row($result);
     $date=date("H:i d.m.y",$data[0]);
return $date;
}

function check_date($save_days){
             $sql="SELECT * FROM twstat_config WHERE ckey=\"check_date\"";
          $result=mysql_query($sql)or die("in Config not selected ! error:".mysql_error());
          $data=mysql_fetch_row($result);
          $ctime=$data[2];
          $now_time=time();
          if ($ctime==0) {
          $sql="UPDATE twstat_config SET cvalue=\"$now_time\" WHERE ckey=\"check_date\"";
          $result=mysql_query($sql)or die("in Config not updated ! error:".mysql_error());
          } else {
          $seven_days_last = mktime(0, 0, 0, date("m"), date("d")-$save_days,   date("Y"));
          //echo "===|".$seven_days_last."NOW: ".$now_time." last:".$ctime;
               if ($seven_days_last>$ctime) {
                  echo truncate_logs();
                  $sql="UPDATE twstat_config SET cvalue=\"$now_time\" WHERE ckey=\"check_date\"";
                  $result=mysql_query($sql)or die("in Config not updated ! error:".mysql_error());
                        }
                 }
return;
}

function weapon($i){
   switch ($i) {
        case 0:
         // array("Weapon", Skill multiplier)
          $weap=array('HAMMER',1.8);
          return $weap;
        case 1:
          $weap=array('GUN',1.5);
          return $weap;
        case 2:
          $weap=array('SHOTGUN',1.1);
          return $weap;
        case 3:
          $weap=array('GRENADE',1.2);
          return $weap;
        case 4:
          $weap=array('RIFLE',1.3);
          return $weap;
        case 5:
          $weap=array('NINJA',1.4);
          return $weap;
   }
}

function special($i){
   switch ($i) {
        case 0:
          $spec=array('nothing',0);
          return $spec;
        case 1:
          $spec=array('kill flag invaders',1.2);
          return $spec;
        case 2:
          $spec=array('kill haved flag',1.4);
          return $spec;
        case 3:
          $spec=array('kill flag invades haved flag',1.6);
          return $spec;
   }
}


 function update_skill($player, $skill, $role) { //role: 1 - killer, -1 - victim, 0 - ctf event
       $player=htmlentities($player);
       $player=mysql_escape_string($player);
         $sql="SELECT * FROM twstat_players WHERE name=\"$player\"";
         $result=mysql_query($sql)or die("in twstat_players not selected ! error:".mysql_error());
         if (mysql_num_rows($result)<1) {
               $sql="INSERT INTO twstat_players (name, skill) Values (\"$player\",\"$skill\")\n";
               } else {
                switch ($role) {
                 case 1:
                  $sql="UPDATE twstat_players SET skill=\"$skill\", kills=kills+1 WHERE name=\"$player\"";
                  break;
                 case -1:
                  $sql="UPDATE twstat_players SET skill=\"$skill\", death=death+1 WHERE name=\"$player\"";
                  break;
                 case 0:
                  $sql="UPDATE twstat_players SET skill=\"$skill\" WHERE name=\"$player\"";
                  break;
                  }
               }
         $result_2=mysql_query($sql);
         if (!$result_2) die("SKILL ib PLAYERS not inserted or updated ! error:".mysql_error());
}


function player_skill($player){
      $player=htmlentities($player);
       $player=mysql_escape_string($player);

        $sql="SELECT skill FROM twstat_players WHERE name=\"$player\"";
        $result=mysql_query($sql)or die("in player skill in PLAYERS not selected ! error:".mysql_error());
        $data=mysql_fetch_row($result);
        //echo "<br>player=".$player."  |=".$data[0];
        if (!$data[0]) $data[0]=1000;
        return $data[0];
        }

function update_map($name, $kills, $captured){
           $sql="SELECT * FROM twstat_maps WHERE name=\"$name\"";
           $result=mysql_query($sql)or die("in MAPS not selected ! error:".mysql_error());
        if (mysql_num_rows($result)<1) {
               $sql="INSERT INTO twstat_maps (name, used, kills, captured) Values (\"$name\", 1, \"$kills\", \"$captured\")";
               } else {
               $sql="UPDATE twstat_maps SET used=used+1, kills=kills+\"$kills\", captured=captured+\"$captured\" WHERE name=\"$name\"";
               }
         $result=mysql_query($sql);
    //   if (!$result) die("in MAPS not inserted ! error:".mysql_error());
return;
}

function update_weapons($player,$weapon) {
         $player=htmlentities($player);
         $player=mysql_escape_string($player);
     //    $player=addslashes($player);
          if ($weapon==-1) return;
           $sql="SELECT * FROM twstat_weapon WHERE player=\"$player\"";
           $result0=mysql_query($sql)or die("in WEAPONS not selected ! error:".mysql_error());
        if (mysql_num_rows($result0)<1) {
               $sql="INSERT INTO twstat_weapon (player, `$weapon`) Values (\"$player\", 1)";
               } else {
               $sql="UPDATE twstat_weapon SET `$weapon`=`$weapon`+1 WHERE player=\"$player\"";
               }
         $result=mysql_query($sql);
     //  if (!$result) die("in WEAPON not inserted or updated ! error:".mysql_error());
}


function update_ctf($player,$event) {
         $player=htmlentities($player);
         $player=mysql_escape_string($player);
           $sql="SELECT * FROM twstat_ctf WHERE player=\"$player\"";
           $result=mysql_query($sql)or die("in CTF not selected ! error:".mysql_error());
        if (mysql_num_rows($result)<1) {
               $sql="INSERT INTO twstat_ctf (player, `$event`) Values (\"$player\", 1)";
               } else {
               $sql="UPDATE twstat_ctf SET `$event`=`$event`+1 WHERE player=\"$player\"";
               }
         $result=mysql_query($sql);
      // if (!$result) die("in CTF not inserted or updated ! error:".mysql_error()."||".$sql);
}

function log_seek($file,$mode) {  ///check last position in log
           $sql="SELECT log_position, hash FROM twstat_log_seek WHERE log_name=\"$file\"";
           $result=mysql_query($sql)or die("in LOG_SEEK not selected ! error:".mysql_error());

      if ($mode=="in") {
       if (mysql_num_rows($result)>0) {
           $position=mysql_fetch_row($result);
           if ($position[1]==md5_file($file)) {
             echo "<br>This log already parsed and not updated ! file:".$file;
             return -99;
           }

           if ($position[0]>filesize($file)) {  // new file ?
            $position[0]=0;
            }
           echo "<br>pos:".$position[0]."  size:".filesize($file);
           return $position[0];
          //fseek($file_open, $position[0]);
         }
      }
      if ($mode=="out") {
        $position=(filesize($file)-100);
         $hash=md5_file($file);
        if (mysql_num_rows($result)<1) {

               $sql="INSERT INTO twstat_log_seek (log_name, log_position, hash) Values (\"$file\", \"$position\", \"$hash\")";
               } else {
               $sql="UPDATE twstat_log_seek SET log_position=\"$position\", hash=\"$hash\" WHERE log_name=\"$file\"";
               }
              $result=mysql_query($sql)or die("in LOG_SEEK not INSERTED ! error:".mysql_error());
          //echo "<br>|>position:".$position." size:".filesize($file);
        }
return;
}

function parse_line($line) {

//echo "<br>".$line;
        if (strstr($line,"invalid client")) return;

        if (strstr($line,"flag_grab")) {
        //[game]: flag_grab player='1:VizorRU'
              $pattern="~flag_grab\splayer='\d{1,2}:(.*)'~";
              preg_match($pattern, $line, $matches);
              $output['mode']="ctf";
              $output['event']="flag_grab";
              $output['player']=$matches[1];
        }
        if (strstr($line,"flag_return")) {
        //[game]: flag_return player='2:jonte'
              $pattern="~flag_return\splayer='\d{1,2}:(.*)'~";
              preg_match($pattern, $line, $matches);
              $output['mode']="ctf";
              $output['event']="flag_return";
              $output['player']=$matches[1];
        }
        if (strstr($line,"flag_capture")) {
        //[game]: flag_capture player='2:jonte'
              $pattern="~flag_capture\splayer='\d{1,2}:(.*)'~";
              preg_match($pattern, $line, $matches);
              $output['mode']="ctf";
              $output['event']="flag_capture";
              $output['player']=$matches[1];
        }
        if (strstr($line,"datafile loading")) {
        //[datafile]: datafile loading. filename='maps/dm1.map'
            $pattern="~filename='maps/(.*).map'~";
        //if (strstr($line,"rotating map to")) {
        // rotating map to dm1
            // $pattern="~rotating\smap\sto\s(.*)~";
              preg_match($pattern, $line, $matches);
             $output['mode']="map";
             $output['mapname']=$matches[1];
        }

        if (strstr($line,"kill killer")) {
        //[game]: kill killer='1:eschen' victim='0:nooby_shot' weapon=3 special=0
           $pattern="~killer='\d{1,2}:(.*)'\svictim='\d{1,2}:(.*)'\sweapon=(.*)\sspecial=(.*)~";
        preg_match($pattern, $line, $matches);
        $output['mode']="kill";
        $output['killer']=$matches[1];
        $output['victim']=$matches[2];
        $output['weapon']=$matches[3];
        $output['special']=$matches[4];
       }
     //  echo "<br>output:";
     //  print_r($output);
   return $output;
}


function parse_file($file) {
       // calc. skill rules:
       // skill_killer=skill_killer + (skill_killer / skill_victim) * weapon*5 + special*5
       // skill_victim=skill_victim - (skill_victim / skill_killer ) * weapon*5 + special*5
       // grab flag - skill=skill + 5
       // capture flag - skill=skill + 20
       // return flag - skill=skill + 10


if (file_exists($file)) {
     $file_open=fopen($file,r);
    } else  die("The logfile not exist! your file:".$file);

// check for previos log reading, if reading, change read position in file or exit
$tmp=log_seek($file,"in");
if ($tmp==-99) return; //already parsed
fseek($file_open, $tmp);

$map_kills=0;
$ctf_captures=0;
$prev_map="";
echo "\r\n <br>\r\n processing ";
while(!feof($file_open)){
$buffer=fgets($file_open);
$result=parse_line($buffer);
echo ".";
if ($result) {
    if ($result['mode']=="map") {
          update_map($result['mapname'],$map_kills,$ctf_captures);
          if ($prev_map!==$result['mapname'])  {
        $map_kills=0;
        $ctf_captures=0;
        $prev_map=$result['mapname'];
          }
        }

    if ($result['mode']=="kill") {
     $map_kills++;
           $weapon=weapon($result['weapon']);
           $special=special($result['special']);
           $skill_killer=player_skill($result['killer'])+(player_skill($result['killer']))/(player_skill($result['victim']))*$weapon[1]*5+$special[1]*5;
           $skill_victim=player_skill($result['victim'])-(player_skill($result['victim']))/(player_skill($result['killer']))*$weapon[1]*5+$special[1]*5;

         if ($result['special']==1 or $result['special']==3) {
                        update_ctf($result['victim'],"flag_drop");
                        }
         if ($result['special']!=="0" and $result['special']>0) {
                $spec=trim($result['special']);
                   update_ctf($result['killer'],$spec);
                 }
         update_weapons($result['killer'],$result['weapon']);
         update_skill($result['killer'],$skill_killer, 1);
         update_skill($result['victim'],$skill_victim, -1);
    }
    if ($result['mode']=="ctf") {
       if ($result['event']=="flag_grab") {
              update_ctf($result['player'],"flag_grab");
              $skill=player_skill($result['player'])+5;
              update_skill($result['player'],$skill, 0);
         }
       if ($result['event']=="flag_capture") {
              update_ctf($result['player'],"flag_capture");
              $skill=player_skill($result['player'])+20;
              update_skill($result['player'],$skill, 0);
              $ctf_captures++;
       }
       if ($result['event']=="flag_return") {
              update_ctf($result['player'],"flag_return");
              $skill=player_skill($result['player'])+10;
              update_skill($result['player'],$skill, 0);
       }
    }
  }
} //while

fclose($file_open);
echo "\r\n <br>===LOG: ".$file." parsed===<br>";
$tmp=log_seek($file,"out");
lastparse();
return;
}

?>
