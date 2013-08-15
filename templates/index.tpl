{include file="header.tpl" }
<table align="center" border="0"  cellspacing="0" cellpadding="0" width=100% height=100%>
<tr><td valign=top>

<br>
{include file="menu.tpl"}

{if $playerId}
{include file="player.tpl"}

{elseif $mode=="maps"}
{include file="maps.tpl"}

{elseif $mode=="top20"}
{include file="top20.tpl"}

{elseif $mode=="awards"}
{include file="awards.tpl"}

{elseif $mode=="login"}

{elseif $mode=="admin" or $mode=="logged"}
{include file="admin.tpl"}

{else}
{include file="players.tpl"}
{/if}

</td></tr></table>


{include file="footer.tpl"}

<div style="position:absolute; top:20%; left:-90px;"><img src="images/sun2.gif" style="-moz-opacity:0.4;filter:alpha(opacity=40);">
