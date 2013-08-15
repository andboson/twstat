<?php
require 'Smarty/libs/Smarty.class.php';
include_once ("modules/functions.php");
  session_start();

$smarty = new Smarty;

$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->clear_compiled_tpl();

$lang_arr=get_lang();
$smarty->assign("lang_arr",$lang_arr);

if (isset($_GET['lg'])) {
        $lg=$_GET['lg'];
        set_lang($lg);
        }
        
$language=check_lang();

$lang=load_lang($language); //load language
$smarty->assign("lang",$lang);

$r_ip=$_SERVER["REMOTE_ADDR"];

$smarty->assign("title",$title);
$smarty->assign("r_ip",$r_ip);


$lastupdate=lastparse_check();
$smarty->assign("lastupdate",$lastupdate);

$page=$_GET['page'];
    if (!isset($page)) $page=1;
    if (!is_numeric($page))  die ("Page must be a NUMBER !");

$sort_order=$_GET['sort'];
    if (!isset($sort_order)) $sort_order=0;
    if (!is_numeric($sort_order))  die ("Sort_order must be a NUMBER !");
    
$playerId=$_GET['playerId'];

    if (isset($playerId)) {
         if (!is_numeric($playerId))  die ("playerId must be a NUMBER !");
         $smarty->assign("playerId",$playerId);
         $data_player=get_player($playerId);
         $smarty->assign("data_player",$data_player);
         }
         

$mode=$_GET['mode'];
  if (isset($mode)) {
    if ($mode!=="awards" and $mode!=="maps" and $mode!=="admin" and $mode!=="login" and $mode!=="logged" and $mode!=="top20") die ("wrong mode!");
        $smarty->assign("mode",$mode);
        if ($mode=="maps") {
        $mapstat=get_maps();
        $smarty->assign("name",$mapstat['name']);
        $smarty->assign("id",$mapstat['id']);
        $smarty->assign("used",$mapstat['used']);
        $smarty->assign("kills",$mapstat['kills']);
        $smarty->assign("captured",$mapstat['captured']);
        $smarty->assign("image",$mapstat['image']);
        }
        if ($mode=="awards") {
        $all_awards=get_awards();
        $smarty->assign("all_awards",$all_awards);
        }
        if ($mode=="top20") {
        $cat=$_GET['cat'];
        $top=get_top20($cat);
        $smarty->assign("top",$top);
        $smarty->assign("cat",$cat);
        }

       if ($mode=="logged") {
          login();
          checkauth();
        }
        if ($mode=="login") {
          auth();
        }
        if ($mode=="admin") {
          checkauth();
          if (isset($_GET['pass'])) set_password();
          if (isset($_GET['erase'])) truncate_logs();
          if (isset($_GET['hideplayer'])) hide_player();
          if (isset($_GET['delplayer'])) del_player();
        }
        
  } else {  //mode not selected
$pages_band=show_pages();
$smarty->assign("pages_band",$pages_band);
$all_players=all_players();
//print_r($all_players);

$smarty->assign("id",$all_players['id']);
$smarty->assign("player_id",$all_players['player_id']);
$smarty->assign("name",$all_players['name']);
$smarty->assign("kills",$all_players['kills']);
$smarty->assign("death",$all_players['death']);
$smarty->assign("kpd",$all_players['kpd']);
$smarty->assign("ctf",$all_players['ctf']);
$smarty->assign("skill",$all_players['skill']);
}

$smarty->display('index.tpl');
?>
