<?php
//**********************
//***Scripted by Lexy***
//  modified by dreamW
//**********************


$servers[]='cs.uch.net:8303';
$servers[]='cs.uch.net:8305';

// $servers[]='yorserver1:yourport1';
// $servers[]='yorserver..N:yourport..N';

$timeout=16;
$i=1;

if (!isset($_GET['serverId'])) {   //servers
echo "<div class='buttons'><table align='center' border=0  cellspacing=0 cellpadding=4 width=50% class=liner>";
echo "<tr><td width=15px>&nbsp</td><td>&nbsp</td><td width=22%>&nbsp</td><td>&nbsp</td></tr>";
echo "<tr><td width=15px><small>#</small></td><td><b><small>Server name</small></b></td><td width=22%><b><small>Map</small></b></td><td align='right'><b><small>Players</small></b></td></tr>";
foreach ($servers as $server) {

  $info=get_serverdata($server, $timeout);
        switch ($info[2])
                {
                        case '1' : $gt  = 'Team Deathmatch'; break;
                        case '2' : $gt  = 'Capture the Flag'; break;
                        default: $gt  = 'Deathmatch'; break;
                }
echo "<tr><td width=15px>$i</td><td><a href='?serverId=".$i."#mon'>".$info[0]."</a></td><td>".$info[1]."</td><td align='right'>".$info[5].'/'.$info[6]."</td></tr>";
$i++;
}
echo "</table></div>";

} else { //players
$ghtml='';
 $serverid=$_GET['serverId'];
 $server=$servers[$serverid-1];
 $info=get_serverdata($server, $timeout);

echo "<div class='buttons'><table align='center' border=0  cellspacing=0 cellpadding=4 width=50% class=liner>";
echo "<tr><td width=15px>&nbsp</td><td>&nbsp</td><td width=22%>&nbsp</td><td>&nbsp</td></tr>";
echo "<tr><td width=15px><small>#</small></td><td><b><small>Server name</small></b></td><td width=22%><b><small>Map</small></b></td><td align='right'><b><small>Players</small></b></td></tr>";
 echo "<tr><td width=15px>$serverid</td><td>".$info[0]."</td><td>".$info[1]."</td><td align='right'>".$info[5].'/'.$info[6]."</td></tr>";
 echo "</table></div>";
 
 if($info[5]>0)  {
        $ghtml.='<br><table style="font-family: tahoma; font-size: 11px; text-align:center; border: 1px #eeeeee solid;" width="50%" align=center ><tr style=" background-color: #f0f0f0"><td>Player</td><td>Score</td></tr>';
        for($i=7;$i<=sizeof($info)-2;$i+=2) $ghtml.='<tr><td><b>'.$info[$i].'</b></td><td>'.$info[$i+1].'</td></tr>';
        $ghtml.='</table>';
           }  else $ghtml.='<center>No players online</center>';
     echo   $ghtml;
}

function get_serverdata($server, $timeout) {
 $data=explode(":",$server);
 $s_addr=$data[0];
 $s_port=$data[1];

$os = @fsockopen('udp://'.@gethostbyname($s_addr), $s_port, $errno, $errstr, $timeout);
if($os) {
fwrite($os,"\xff\xff\xff\xff\xff\xff\xff\xff\xff\xffgief");
$info=explode(chr(00), substr(fread($os,1024),20));        $size = sizeof($info);
if($size>5)
        {
        fclose($os);
        return $info;
        }
        else
        {
               echo 'TeeWars Server Not Detected';
               return;
        }
}
else
{
        echo 'Connection failed';
        return;
}

}
?>
