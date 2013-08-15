<center><b><u>Admin panel:</u></b></center>
<br>
<center>
<fieldset style="width:60%">
<legend>Database:</legend>
<form metod="POST" action="parselog.php">
<p align="center"><input type=submit value="Update Data" style="border:1px solid gray; height:30px; width:150px"/></p>
</form>
<form method="POST" name="erase" action="index.php?mode=admin&erase=yes">
<p align="center"><input onclick="return confirm('DELETE ALL RECORDS from database: yes ?');" type=submit value="Clear Database" style="border:1px solid gray; height:30px;width:150px"/></p>
</form>
</fieldset>

<br>
<fieldset style="width:60%">
<legend>Player:</legend>
<form method="POST" name="hide" action="index.php?mode=admin&hideplayer=yes">
<p align="center">PlayerId:<input type=text size=4 maxlenght=5 name="hide">&nbsp<input onclick="return confirm('HIDE this Player ?');" type=submit value="Hide" style="border:1px solid gray; height:20px;width:100px" /></p>
</form>
<form method="POST" name="delete" action="index.php?mode=admin&delplayer=yes">
<p align="center">PlayerId:<input type=text size=4 maxlenght=5 name="del">&nbsp<input onclick="return confirm('DELETE this Player ?');" type=submit value="Delete" style="border:1px solid gray; height:20px;width:100px" /></p>
</form>
</fieldset>


<br>
<fieldset style="width:60%">
<legend>Password:</legend>
<form method="POST" name="setpassword" action="index.php?mode=admin&pass=new">
<p align="center"><input type=password size=22 name="passw"></p>
<p align="center"><input onclick="return confirm('set new password for ADMIN ?');" type=submit value="Set new pass" style="border:1px solid gray; height:30px;width:150px" /></p>
</form>
</fieldset>
</center>
