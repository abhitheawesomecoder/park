<?
$IMPORTANT_SQL = mysql_query("SELECT * FROM users WHERE username='".str_replace('.', ' ', urldecode($_GET['profile']))."'");
$Users = mysql_fetch_row($IMPORTANT_SQL);
$session_query = ("SELECT * FROM users WHERE username='".$_SESSION['username']."' OR email='".$_SESSION['username']."' ");
$Session_Users = mysql_fetch_row($session_query);
?>

<?  if($_GET['action'] == 'profile') { $wrap_right = 'on'; ?>

<div class="profile_wrapper">
<div class="profile_wrapper_panel">
<div class="profile_wrapper_photo">
<center>
<? if($Users['2'] == '') {?><img src="<?=$root;?>/uploads/avatars/<?=$Users['9']?>" alt="Avatar"><? }else{?><img src="<?=$Users['9']?>" alt="Avatar"><? }?>
</center>


<div class="profile_wrapper_name"><?=$Users['6']?> <?=$Users['7']?></div>


<div class="profile_wrapper_topmenu">
<ul>
<li <? if($_GET['subaction'] == '') { ?>class="selected_li"<? }?>><a href="<?=$root;?>/u/<?=$_GET['profile']?>"><?=$LANG['posts_title'];?></a></li>
<li <? if($_GET['subaction'] == 'upvotes') { ?>class="selected_li"<? }?>><a href="<?=$root;?>/u/<?=$_GET['profile']?>/upvotes/"><?=$LANG['upvotes_title'];?></a></li>

</ul>
</div>


</div>


</div>
</div>
    

<div class="profile_content"> 

<? 
if($Users['11'] == '0') {
	include_once ('account_content.tpl.php');
}

if($Users['11'] == '1') {
	if($members['username'] == str_replace('.', ' ', urldecode($_GET['profile']))) { 
   
      include_once ('account_content.tpl.php');
	  
   } else {
	
	 ?>
	<div class="blank-state">
    <h3><?=$Users['6']?> <?=$Users['7']?> <?=$LANG['has_hidden_profile'];?></h3>
    <div class="btn-container" style="text-align: center; width: auto;"><a class="btn" href="<?=$root?>/u/<?=str_replace(' ', '.', urldecode($members['username']));?>"><?=$LANG['go_to_your_profile'];?></a></div>
    </div>
<? }
}
?>


</div>
    
<style>.Theme_Content_Wrap_Right{position:absolute;top:301px;margin-left:645px;}</style>
<?  }
    if($_GET['action'] == 'settings') { 
	include_once ('settings.tpl.php');
    } ?>
    
    