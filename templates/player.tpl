<center><b><u>{$lang.player}:&nbsp;&nbsp;{$data_player.name}</u></b></center>
<br><br>
<h2 class="tab">[{$lang.general}]:</h2>


<table align="center" border="0"  cellspacing="0" cellpadding="2" width=80%>
<tr><td class="board">&nbsp</td><td class="board">&nbsp</td><td class="board">&nbsp</td><td class="board">&nbsp</td></tr>
<tr><td class="board" width="30%"><b>{$lang.kills}</b></td><td class="board" ><b>{$lang.death}</b></td><td class="board" align="center"><b>{$lang.kpd}</b></td><td class="board" align="right"><b>{$lang.skill}</b></td></tr>

<tr><td class="board" >{$data_player.kills|default:0}</td><td class="board" align="left">{$data_player.death|default:0}</td><td class="board" align="center">{$data_player.kpd|string_format:"%.2f"}</td><td class="board" align="right">{$data_player.skill}</td></tr>
</table>
<br>
<center>

<img src="twstat_userbar.php/twstat_{$data_player.id}_1_.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="twstat_userbar.php/twstat_{$data_player.id}_2_.png">
</center>

<br><br>
<h2 class="tab">[{$lang.events}]:</h2>

<table align="center" border="0"  cellspacing="0" cellpadding="2" width=80%>
<tr><td class="board">&nbsp</td><td class="board">&nbsp</td><td class="board">&nbsp</td><td class="board">&nbsp</td></tr>
<tr><td class="board" ><b>#</b></td><td class="board" align="left"><b>{$lang.event}</b></td><td class="board" align="center"><b>{$lang.count}</b></td><td class="board" align="right"><b>{$lang.b_points}</b></td></tr>

<tr><td class="board" >1</td><td class="board" align="left">{$lang.event_capt}</td><td class="board" align="center">{$data_player.event_capt|default:0}</td><td class="board" align="right">{$data_player.event_capt*5|default:0}</td></tr>
<tr><td class="board" >2</td><td class="board" align="left">{$lang.event_grab}</td><td class="board" align="center">{$data_player.event_grab|default:0}</td><td class="board" align="right">{$data_player.event_grab*5|default:0}</td></tr>
<tr><td class="board" >3</td><td class="board" align="left">{$lang.event_return}</td><td class="board" align="center">{$data_player.event_return|default:0}</td><td class="board" align="right">{$data_player.event_return*5|default:0}</td></tr>
<tr><td class="board" >4</td><td class="board" align="left">{$lang.event_drop}</td><td class="board" align="center">{$data_player.event_drop|default:0}</td><td class="board" align="right">{$data_player.event_drop*-5|default:0}</td></tr>
<tr><td class="board" >5</td><td class="board" align="left">{$lang.event_special1}</td><td class="board" align="center">{$data_player.special1|default:0}</td><td class="board" align="right">{$lang.event_special1*5|default:0}</td></tr>
<tr><td class="board" >6</td><td class="board" align="left">{$lang.event_special2}</td><td class="board" align="center">{$data_player.special2|default:0}</td><td class="board" align="right">{$lang.event_special2*5|default:0}</td></tr>
<tr><td class="board" >6</td><td class="board" align="left">{$lang.event_special3}</td><td class="board" align="center">{$data_player.special3|default:0}</td><td class="board" align="right">{$lang.event_special3*5|default:0}</td></tr>
</table>
<br><br>
<h2 class="tab">[{$lang.weapons}]:</h2>

<table align="center" border="0"  cellspacing="0" cellpadding="2" width=40%>
<tr><td class="board">&nbsp</td><td class="board">&nbsp</td><td class="board" width="30%" align="center">&nbsp</td></tr>
<tr><td class="board" align="center"><a href="?mode=top20&cat=hammer"><img src="images/hammer.gif" title="hammer"></a></td><td class="delim">&nbsp</td><td class="board" align="center">{$data_player.0|default:0}</td></tr>
<tr><td class="board" align="center"><a href="?mode=top20&cat=gun"><img src="images/gun.gif" title="gun"></a></td><td class="delim">&nbsp</td><td class="board" align="center">{$data_player.1|default:0}</td></tr>
<tr><td class="board" align="center"><a href="?mode=top20&cat=shotgun"><img src="images/shotgun.gif" title="shotgun"></a></td><td class="delim">&nbsp</td><td class="board" align="center">{$data_player.2|default:0}</td></tr>
<tr><td class="board" align="center"><a href="?mode=top20&cat=grenade"><img src="images/grenade.gif" title="grenade"></a></td><td class="delim">&nbsp</td><td class="board" align="center">{$data_player.3|default:0}</td></tr>
<tr><td class="board" align="center"><a href="?mode=top20&cat=rifle"><img src="images/rifle.gif" title="laser rifle"></a></td><td class="delim">&nbsp</td><td class="board" align="center">{$data_player.4|default:0}</td></tr>
<tr><td class="board" align="center"><a href="?mode=top20&cat=ninja"><img src="images/ninja.gif" title="ninja"></a></td><td class="delim">&nbsp</td><td class="board" align="center">{$data_player.5|default:0}</td></tr>
</table>
