<?php
include('modules/functions.php');
//check_date($save_days);

parse_file('/store/gs/Teewars/tw_dm.log');
echo "\r\n";
parse_file('/store/gs/Teewars/tw_ctf.log');
echo "\r\n";
echo date("T");
?>
