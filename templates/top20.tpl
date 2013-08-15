<br>
<center><u>{$lang.top20}: <b>{$lang.$cat}</b></u></center>
<br>
<table align="center" border="0"  cellspacing="0" cellpadding="5" width=30%>
<tr><td class="board">&nbsp</td><td class="board">&nbsp</td><td class="board">&nbsp</td></tr>
<tr><td class="board">#</td><td class="board"><small><b>{$lang.name}</b></small></td><td class="board" align="right"><small><b>{$lang.value}</b></small></td></tr>

{section name=top20 loop=$top.id}
<tr><td class="board" align="left">{$top.id[top20]}</td><td class="board" align="left"><a href="index.php?playerId={$top.pl_id[top20]}">{$top.player[top20]}</a></td><td class="board" align="right">{$top.cat_value[top20]}</td></tr>
{/section}
</table>
<br>
