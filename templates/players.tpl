<center><b><u>{$lang.pl_rating}:</u></b></center>
<div class="buttons">
<table align="center" border="0"  cellspacing="0" cellpadding="0" width=80%>
<tr><td class="board"></td><td class="board">&nbsp</td><td class="board">&nbsp</td><td class="board">&nbsp</td><td class="board">&nbsp</td><td class="board">&nbsp</td><td class="board">&nbsp</td></tr>
<tr><td class="board"></td><td class="board" ><b>#</b></td><td class="board" align="left"><a class="pl_head" href="index.php?sort=1"><b>{$lang.name}</b></a></td><td class="board" align="center"><a class="pl_head" href="?sort=2"><b>{$lang.kills}</b></a></td><td class="board" align="center"><a class="pl_head" href="?sort=3"><b>{$lang.death}</b></a></td><td class="board" align="center"><b>{$lang.kpd}</b></td><td class="board" align=right><a class="pl_head" href="?sort=5"><b>{$lang.skill}</b></a></td></tr>
        {section name=mydata loop=$name}
                 <tr>
          <td align=left valign=middle></td>
          <td class="board" >{$id[mydata]}</td>
          <td class="board" align="left"><a class="pl" href=index.php?playerId={$player_id[mydata]}>{$name[mydata]}</a></td>
          <td class="board" align="center">{$kills[mydata]}</td>
          <td class="board" align="center">{$death[mydata]}</td>
          <td class="board" align="center">{$kpd[mydata]}</td>
          <td class="board" align=right>{$skill[mydata]}</td>
          </tr>
       {/section}
    <tr ><td valign=bottom colspan=7 align="right">
    {html_table loop=$pages_band  cols=20 table_attr='width="100%"' td_attr='class=pages'}
   </td></tr>
</table>

{include file="monitoring.tpl"}
