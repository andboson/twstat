<?php
include('modules/config.php');

function all_players(){
    $sql="SELECT * FROM twstat_players";
    $sql.=" WHERE hidden=0";
    $sql.=" ORDER BY skill DESC";
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


     if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "")
        preg_match("/^twstat_(.*)_(.*)_\.png$/", $_SERVER['QUERY_STRING'], $this);
    else
        preg_match("/^\/twstat_(.*)_(.*)_\.png$/", $_SERVER['PATH_INFO'], $this);

$plId=$this[1];
$type=$this[2];

$ranking=all_players();
$key = array_search($plId, $ranking['player_id']);
$rank=$key+1;
$all=count($ranking['player_id']);
$name= $ranking['name'][$key];
$skill= $ranking['skill'][$key];
$kills= $ranking['kills'][$key];
$death= $ranking['death'][$key];

$serversname="MegaStyle TeeWorlds Servers";
//print_r($ranking['player_id']);
//print_r($ranking['name']);

header("Content-type: image/png");

$font2="fonts/snap.ttf";
$font="fonts/comic.ttf";


if ($type==1) {
$im = @imagecreatefrompng('images/twbanner.png');
 $text_color = imagecolorallocate($im, 20, 20, 20);
$white = imagecolorallocate($im, 255, 255, 255);
$yellow = imagecolorallocate($im, 240, 200, 10);

imagettftext($im, 12, 0,29,17, $text_color, $font, "Tee: ");
imagettftext($im, 12, 0,30,18, $yellow, $font, "Tee: ");

imagettftext($im, 16, 0,62,18, $text_color, $font2,$name);
imagettftext($im, 16, 0,63,19, $white, $font2,$name);
imagettftext($im, 16, 0,65,20, $yellow, $font2,$name);

imagettftext($im, 12, 0,44,38, $text_color, $font, "Rank: ".$rank." from ".$all);
imagettftext($im, 12, 0,45,39, $yellow, $font, "Rank: ".$rank." from ".$all);

imagettftext($im, 12, 0,44,62, $text_color, $font, $title);
imagettftext($im, 12, 0,45,63, $yellow, $font, $title);

///stats
imagettftext($im, 10, 0,220,17, $text_color, $font, "skill: ".$skill);
imagettftext($im, 10, 0,221,18, $yellow, $font, "skill: ".$skill);

imagettftext($im, 10, 0,220,30, $text_color, $font, "kills: ".$kills);
imagettftext($im, 10, 0,221,31, $yellow, $font, "kills: ".$kills);

imagettftext($im, 10, 0,220,43, $text_color, $font, "death: ".$death);
imagettftext($im, 10, 0,221,44, $yellow, $font, "death: ".$death);


} else {

$im = @imagecreatefrompng('images/twbanner2.png');
$text_color = imagecolorallocate($im, 20, 20, 20);
$white = imagecolorallocate($im, 255, 255, 255);
$yellow = imagecolorallocate($im, 240, 200, 10);

imagettftext($im, 12, 0,39,17, $text_color, $font, "Tee: ");
imagettftext($im, 12, 0,40,18, $yellow, $font, "Tee: ");

imagettftext($im, 15, 0,17,17, $text_color, $font2,$name);
imagettftext($im, 15, 0,18,18, $white, $font2,$name);
imagettftext($im, 15, 0,20,19, $yellow, $font2,$name);

imagettftext($im, 8, 0,140,10, $text_color, $font, "Rank: ".$rank." from ".$all);
imagettftext($im, 8, 0,141,11, $white, $font, "Rank: ".$rank." from ".$all);


///stats
imagettftext($im, 8, 0,245,10, $text_color, $font, "s:".$skill." k:".$kills." d:".$death);
imagettftext($im, 8, 0,246,11, $white, $font, "s:".$skill." k:".$kills." d:".$death);


imagettftext($im, 7, 0,180,19, $text_color, $font, $title);
imagettftext($im, 7, 0,181,19, $white, $font, $title);
}


imagepng($im);
imagedestroy($im);
?>
