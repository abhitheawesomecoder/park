<div id="red_table_media"> <? $table_name = "categories"; ?>
<div class="bg_red_table_header"><?=$LANG['TITLE_CATEGORIES'];?></div>

<div class="bg_body_table">
<? if($_GET['subaction'] == '') {  ?><!-- Main Page -->
<? if($_POST['remove_all']){ $checkbox = $_POST['checkbox'];$countCheck = count($_POST['checkbox']); for($i=0;$i<$countCheck;$i++){$del_id  = $checkbox[$i];$result = mysql_query("DELETE from $table_name WHERE id = $del_id");}if($result){$header_url = $root."/view/admin/".$_GET['action'];header('Location: '.$header_url.'');}else{}} ?>
<form name="form" id="form" method="post"><center>
<a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/add" class="remove_all_submit" style="top: -5px;left: 15px;position: relative;float: left;background: #0087F7;border-color: #0087F7;font-weight: bold;width: 80px;padding: 5px 20px;margin-top: 5px;margin-bottom: 5px;"><?=$LANG['TITLE_ADD_CATEGORY'];?></a>
<table style="border-collapse:collapse; border: 1px solid #E5E5E5; background-color: #FFF;width: 97%;" border="1" cellpadding="3" cellspacing="1">
<tr style="padding: 5px;background: gray;color: #fff;">
<td width="20px" class="tdcheckall"><input type="checkbox" name='checkall' onclick='checkedAll(form);' title="Check/Uncheck ALL" /></td>
<td class="tdcheck" style="font-size: 14px;"><strong><?=$LANG['TITLE_CATEGORIES'];?></strong></td>
<td class="tdcheck" style="font-size: 14px;"><strong><?=$LANG['TITLE_CATEGORY_ID'];?></strong></td>
<td class="tdcheck" style="font-size: 14px;width: 110px;"><strong><?=$LANG['TITLE_NSFW'];?></strong></td>
<td class="tdcheck" style="height: 30px; font-size: 14px;"><strong><?=$LANG['TITLE_FUNCTION'];?></strong></td>
</tr>


<? $news = get_admin_categories(); ?>
<? foreach(array_slice($news, $startResults, $resultsPerPage) as $media): ?>
<tr>
<td class="tdcheckall"><input type='checkbox' name='checkbox[]' id='checkbox[]' value="<?=$media['id'];?>"></td>
<td class="tdcheck"><a class="td_link" href="<?=$root;?>/<?=str_replace(' ', '.', urldecode($media['cat_id']));?>" target="_blank"><?=$media['name']?></a></td>
<td class="tdcheck"><?=$media['cat_id']?></td>

<td class="tdcheck" style="width: 94px;">
<? if($media['nsfw'] == '1') { ?>
<a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/inactive/<?=$media['id'];?>" style="font-size: 12px;color: #fff;width: 62px;background: #D80707;padding: 3px 16px;border: 1px solid #AD1515;border-radius: 5px;cursor: pointer;margin-left: 9px;"><?=$LANG['TITLE_TURN_OFF'];?></a>
<? } elseif($media['nsfw'] == '0') { ?>
<a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/active/<?=$media['id'];?>" style="font-size: 12px;color: #fff;width: 52px;background: #3EAC0A;padding: 3px 15px;border: 1px solid #2D8603;border-radius: 5px;cursor: pointer;margin-left: 9px;"><?=$LANG['TITLE_TURN_ON'];?></a>
<? } ?>
</td>


<td class="tdcheck" style="width: 94px;">
<div class="btn-group btn-group-sm">
<a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/edit/<?=$media['id'];?>" class="btn_td btn-success"><i class="fa fa-pencil"></i></a>
<a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/delete/<?=$media['id'];?>" onclick="return confirm('<?=$LANG['confirm_to_delete_this_post'];?>');" class="btn_td btn-danger"><i class="fa fa-times"></i></a>
</div>
</td>
</tr>
<? endforeach; ?>

</table>
</center>
<div style="margin-left: 14px; width: 97%; display: inline-block;">
<div style="float: left;margin: 20px 0;"><input class="remove_all_submit" name="remove_all" type="submit" id="remove_all" value="<?=$LANG['TITLE_REMOVE'];?>" onclick="return confirm('<?=$LANG['confirm_to_delete_this_post'];?>');" /></div>
<div style="float: right; height: 0;"><? include_once ('pagination.tpl.php'); ?></div>
</div>
</form>
<? } ?><!-- Main Page -->



<? if($_GET['subaction'] == 'active') { ?><!-- Active Page -->

<?  if($_GET['id']) {
			mysql_query("UPDATE $table_name SET nsfw='1' WHERE id='".$_GET['id']."'");
			$header_url = $root."/view/admin/".$_GET['action'];
			header('Location: '.$header_url.'');
    } ?>

<? } ?><!-- Active Page -->


<? if($_GET['subaction'] == 'inactive') { ?><!-- Inactive Page -->

<?  if($_GET['id']) {
			mysql_query("UPDATE $table_name SET nsfw='0' WHERE id='".$_GET['id']."'");
			$header_url = $root."/view/admin/".$_GET['action'];
			header('Location: '.$header_url.'');
    } ?>

<? } ?><!-- Inactive Page -->



<? if($_GET['subaction'] == 'delete') { ?><!-- Delete Page -->

<?  if($_GET['id']) {
			mysql_query("DELETE FROM $table_name WHERE id='".$_GET['id']."'");
			if($_GET['page'] == '') { $page = "1"; } else { $page = $_GET['page']; }
			$header_url = $root."/view/admin/".$_GET['action'];
			header('Location: '.$header_url.'');
    } ?>

<? } ?><!-- Delete Page -->



<? if($_GET['subaction'] == 'edit') { ?><!-- Edit Page -->
<? $id = $_GET['id']; $media = get_admin_edit_categories($id);
$submit_info = $_POST['submit_info'];
if($submit_info) {
      $name = mysql_real_escape_string($_POST['name']); 
	  $cat_id = $_POST['cat_id'];
		mysql_query("UPDATE $table_name SET name='$name', cat_id='$cat_id' WHERE id='".$id."'"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action'];
		header('Location: '.$header_url.'');
} ?>
<section style="display: inline-block;">
<form name="upload_action" action="" method="post">

<div style="float:right; width: 67%; margin-right: 20px; margin-top: 7px;">
                        <? if($_GET['post_url']) { echo "<img src='".$root."/uploads/meme_photos/".$_GET['post_url'].".jpg"."' width='200'>"; }?>
                        <div class="field title"><label><?=$LANG['TITLE_CATEGORY_NAME'];?></label>
							<input type="text" name="name" maxlength="120" value="<?=$media['name'];?>" style="width: 540px;border: 1px solid #ddd;">
						</div>
                        <div class="field category">
                        	<label><?=$LANG['TITLE_CATEGORY_ID'];?></label>
							<input type="text" name="cat_id" maxlength="120" value="<?=$media['cat_id'];?>" style="width: 540px;border: 1px solid #ddd;">
                        </div>
                        <div class="field checkbox">
						</div>
                        <div id="btn-container2"><input type="submit" name="submit_info" value="<?=$LANG['TITLE_SAVE'];?>"></div>
</div>
</form>
</section>
<? } ?><!-- Edit Page -->


<? if($_GET['subaction'] == 'add') { ?><!-- Edit Page -->
<? $submit_info = $_POST['submit_info'];
if($submit_info) {
      $name = mysql_real_escape_string($_POST['name']); 
	  $cat_id = $_POST['cat_id'];
		mysql_query("INSERT INTO $table_name (name, cat_id) VALUES ('".$name."','".$cat_id."')"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action'];
		header('Location: '.$header_url.'');
} ?>
<section style="display: inline-block;">
<form name="upload_action" action="" method="post">

<div style="float:right; width: 67%; margin-right: 20px; margin-top: 7px;">
                        <? if($_GET['post_url']) { echo "<img src='".$root."/uploads/meme_photos/".$_GET['post_url'].".jpg"."' width='200'>"; }?>
                        <div class="field title"><label><?=$LANG['TITLE_CATEGORY_NAME'];?></label>
							<input type="text" name="name" maxlength="120" value="" style="width: 540px;border: 1px solid #ddd;">
						</div>
                        <div class="field category">
                        	<label><?=$LANG['TITLE_CATEGORY_ID'];?></label>
							<input type="text" name="cat_id" maxlength="120" value="" style="width: 540px;border: 1px solid #ddd;">
                        </div>
                        <div class="field checkbox">
						</div>
                        <div id="btn-container2"><input type="submit" name="submit_info" value="<?=$LANG['TITLE_SAVE'];?>"></div>
</div>
</form>
</section>
<? } ?><!-- Edit Page -->



</div>






</div>