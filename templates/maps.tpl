<center><b><u>{$lang.maps}:</u><sup>*</sup></b></center>
  {section name=mapa loop=$name}
<table align="center" border="0"  cellspacing="20" cellpadding="0" width=60% border=1px>

        <tr><td><b>{$id[mapa]}.</b></td>
        <td class="block" width=40% align=center valign=center>
          <a href="{$image[mapa]}" target="_blank"><img src="{$image[mapa]}" width="160" hegiht="160"></a>
        </td><td>
        <table align="center" border="0"  cellspacing="0" cellpadding="10" width=100%>
          <tr><td class="board" align=center colspan=2><b>{$name[mapa]}</b></td></tr>
          <tr><td class="board" align=right>{$lang.pl_games}:</td><td class="board" >{$used[mapa]}</td></tr>
          <tr><td class="board" align=right>{$lang.killed_on_map}:</td><td class="board" >{$kills[mapa]}</td></tr>
          <tr><td class="board" align=right>{$lang.flag_capt}:</td><td class="board" >{$captured[mapa]}</td></tr>
          <tr><td >&nbsp</td><td >&nbsp</td></tr>
        </table>
          </td></tr>
</table>
<br><br>
{/section}
<br>
<p align=center><sup>*</sup>{$lang.maps_note}</p>

