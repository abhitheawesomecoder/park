<?
$IMPORTANT_SQL = mysql_query("SELECT * FROM users WHERE username='".str_replace('.', ' ', urldecode($_GET['profile']))."'");
$Users = mysql_fetch_array($IMPORTANT_SQL);
$session_query = ("SELECT * FROM users WHERE username='".$_SESSION['username']."' OR email='".$_SESSION['username']."' ");
$Session_Users = mysql_fetch_row($session_query);
?>

<?  if($_GET['action'] == 'profile') { $wrap_right = 'on'; ?>

<div class="profile_wrapper">
<div class="profile_wrapper_panel">
<div class="profile_wrapper_photo">
<? if($Users['2'] == '') {?><img src="<?=$root;?>/uploads/avatars/<?=$Users['9']?>" alt="Avatar"><? }elseif($Users['2'] == 'facebook') {?><img src="<?=$Users['9']?>" alt="Avatar"><? }elseif($Users['2'] == 'twitter') {?><img src="<?=$root;?>/uploads/avatars/<?=$Users['9']?>" alt="Avatar"><? }?>
<div class="profile_wrapper_name"><?=$Users['6']?> <?=$Users['7']?></div>
<br>
</div><br>

<div class="profile_wrapper_topmenu">
<ul>
<li <? if($_GET['subaction'] == '') { ?>class="selected_li"<? }?>><a href="<?=$root;?>/u/<?=$_GET['profile']?>"><?=$LANG['overview_title'];?></a></li>
<li <? if($_GET['subaction'] == 'posts') { ?>class="selected_li"<? }?>><a href="<?=$root;?>/u/<?=$_GET['profile']?>/posts/"><?=$LANG['posts_title'];?></a></li>
<li <? if($_GET['subaction'] == 'upvotes') { ?>class="selected_li"<? }?>><a href="<?=$root;?>/u/<?=$_GET['profile']?>/upvotes/"><?=$LANG['upvotes_title'];?></a></li>
<li <? if($_GET['subaction'] == 'comments') { ?>class="selected_li"<? }?>><a href="<?=$root;?>/u/<?=$_GET['profile']?>/comments/"><?=$LANG['comments_title'];?></a></li>

</ul>
</div>


</div>
</div>


<div class="profile_content">

<?
if($Users['admin'] == '0') {

	include 'test.tpl.php' ;

}

if($Users['admin'] == '1') {
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

<style>
#container { width: 800px; }

@media all and (max-width: 1200px) {
	.Theme_Content_Wrap_Right {
		display: none;

	}
}
</style>
<?  }
    if($_GET['action'] == 'settings') {
	include_once ('settings.tpl.php');
    } ?>
