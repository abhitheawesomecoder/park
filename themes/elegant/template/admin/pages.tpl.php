<div id="red_table_media"> <? $table_name = "pages"; ?>
<div class="bg_red_table_header">PAGES</div>

<div class="bg_body_table">
<? if($_GET['subaction'] == '') {  ?><!-- Main Page -->
<? if($_POST['remove_all']){ $checkbox = $_POST['checkbox'];$countCheck = count($_POST['checkbox']); for($i=0;$i<$countCheck;$i++){$del_id  = $checkbox[$i];$result = mysql_query("DELETE from $table_name WHERE id = $del_id");}if($result){$header_url = $root."/view/admin/".$_GET['action'];header('Location: '.$header_url.'');}else{}}
   if($_POST['active_all']){ $checkbox = $_POST['checkbox'];$countCheck = count($_POST['checkbox']); for($i=0;$i<$countCheck;$i++){$act_id  = $checkbox[$i];$result = mysql_query("UPDATE $table_name SET status='on' WHERE id = $act_id");}if($result){$header_url = $root."/view/admin/".$_GET['action'];header('Location: '.$header_url.'');}else{}}
   if($_POST['inactive_all']){ $checkbox = $_POST['checkbox'];$countCheck = count($_POST['checkbox']); for($i=0;$i<$countCheck;$i++){$act_id  = $checkbox[$i];$result = mysql_query("UPDATE $table_name SET status='off' WHERE id = $act_id");}if($result){$header_url = $root."/view/admin/".$_GET['action'];header('Location: '.$header_url.'');}else{}}
   ?>
<form name="form" id="form" method="post"><center>
<a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/add" class="remove_all_submit" style="top: -5px;left: 15px;position: relative;float: left;background: #0087F7;border-color: #0087F7;font-weight: bold;width: 80px;padding: 5px 20px;margin-top: 5px;margin-bottom: 5px;"><?=$LANG['TITLE_ADD_PAGE'];?></a>
<table style="border-collapse:collapse; border: 1px solid #E5E5E5; background-color: #FFF;width: 97%;" border="1" cellpadding="3" cellspacing="1">
<tr style="padding: 5px;background: gray;color: #fff;">
<td width="20px" class="tdcheckall"><input type="checkbox" name='checkall' onclick='checkedAll(form);' title="Check/Uncheck ALL" /></td>
<td class="tdcheck" style="font-size: 14px;"><strong><?=$LANG['TITLE_PAGE_ID'];?></strong></td>
<td class="tdcheck" style="font-size: 14px;"><strong><?=$LANG['TITLE_PAGE_TITLE'];?></strong></td>
<td class="tdcheck" style="font-size: 14px;width: 110px;"><strong><?=$LANG['TITLE_ACTIVE_INACTIVE'];?></strong></td>
<td class="tdcheck" style="height: 30px; font-size: 14px;"><strong><?=$LANG['TITLE_FUNCTION'];?></strong></td>
</tr>


<? $news = get_admin_pages(); ?>
<? foreach(array_slice($news, $startResults, $resultsPerPage) as $media): ?>
<tr>
<td class="tdcheckall"><input type='checkbox' name='checkbox[]' id='checkbox[]' value="<?=$media['id'];?>"></td>
<td class="tdcheck"><?=$media['page_id']?></td>
<td class="tdcheck"><a class="td_link" href="<?=$root;?>/pages/<?=$media['page_id']?>" target="_blank"><?=$media['page_title']?></a></td>
<td class="tdcheck" style="width: 94px;">
<? if($media['status'] == 'on') { ?>
<a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/inactive/<?=$media['id'];?>" style="font-size: 12px;color: #fff;width: 62px;background: #D80707;padding: 3px 10px;border: 1px solid #AD1515;border-radius: 5px;cursor: pointer;margin-left: 9px;"><?=$LANG['TITLE_SET_INACTIVE'];?></a>
<? } elseif($media['status'] == 'off') { ?>
<a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/active/<?=$media['id'];?>" style="font-size: 12px;color: #fff;width: 52px;background: #3EAC0A;padding: 3px 15px;border: 1px solid #2D8603;border-radius: 5px;cursor: pointer;margin-left: 9px;"><?=$LANG['TITLE_SET_ACTIVE'];?></a>
<? } ?>
</td>

<td class="tdcheck" style="width: 94px;">
<div class="btn-group btn-group-sm">
<a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/edit/<?=$media['id'];?>" class="btn_td btn-success"><i class="fa fa-pencil"></i></a>
<a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/delete/<?=$media['id'];?>" onclick="return confirm('Delete This Page ?');" class="btn_td btn-danger"><i class="fa fa-times"></i></a>
</div>
</td>
</tr>
<? endforeach; ?>

</table>
</center>
<div style="margin-left: 14px; width: 97%; display: inline-block;">
<div style="float: left;margin: 20px 0;"><input class="remove_all_submit" name="remove_all" type="submit" id="remove_all" value="<?=$LANG['TITLE_REMOVE'];?>" onclick="return confirm('Delete This Page ?');" /></div>
<div style="float: left;margin: 20px 20px;"><input value="<?=$LANG['TITLE_ACTIVE_ALL'];?>" class="remove_all_submit" name="active_all" type="submit" id="active_all" /></div>
<div style="float: left;margin: 20px 0px;"><input value="<?=$LANG['TITLE_INACTIVE_ALL'];?>" class="remove_all_submit" name="inactive_all" type="submit" id="inactive_all" /></div>

<div style="float: right; height: 0;"><? include_once ('pagination.tpl.php'); ?></div>
</div>
</form>
<? } ?><!-- Main Page -->


<? if($_GET['subaction'] == 'active') { ?><!-- Active Page -->

<?  if($_GET['id']) {
			mysql_query("UPDATE pages SET status='on' WHERE id='".$_GET['id']."'");
			$header_url = $root."/view/admin/".$_GET['action'];
			header('Location: '.$header_url.'');
    } ?>

<? } ?><!-- Active Page -->


<? if($_GET['subaction'] == 'inactive') { ?><!-- Inactive Page -->

<?  if($_GET['id']) {
			mysql_query("UPDATE pages SET status='off' WHERE id='".$_GET['id']."'");
			$header_url = $root."/view/admin/".$_GET['action'];
			header('Location: '.$header_url.'');
    } ?>

<? } ?><!-- Inactive Page -->


<? if($_GET['subaction'] == 'delete') { ?><!-- Delete Page -->

<?  if($_GET['id']) {
			$news_filter = mysql_query("SELECT * FROM pages WHERE news_id='".$news_id."'");
			while($row = mysql_fetch_array($news_filter)) {
				$target = 'uploads/media_photos/'.$row["file"];
				$target2 = 'uploads/media_photos/'.$row["thumb"];
				if (file_exists($target)) { unlink($target); } if (file_exists($target2)) { unlink($target2); }
				if (file_exists($target)) { } else { } if (file_exists($target2)) { } else { }
			}
			mysql_query("DELETE FROM pages WHERE id='".$_GET['id']."'");
			if($_GET['page'] == '') { $page = "1"; } else { $page = $_GET['page']; }
			$header_url = $root."/view/admin/".$_GET['action'];
			header('Location: '.$header_url.'');
    } ?>

<? } ?><!-- Delete Page -->



<? if($_GET['subaction'] == 'edit') { ?><!-- Edit Page -->
<? $id = $_GET['id']; $media = get_admin_edit_pages($id);
$submit_info = $_POST['submit_info'];
if($submit_info) {
	  $page_id = mysql_real_escape_string($_POST['page_id']); 
      $page_title = mysql_real_escape_string($_POST['page_title']);
	  $text = mysql_real_escape_string($_POST['text']);
		mysql_query("UPDATE $table_name SET page_id='$page_id', page_title='$page_title', text='$text' WHERE id='".$id."'"); 
		//print success message.
		$header_url = $root."/view/admin/".$_GET['action'];
		header('Location: '.$header_url.'');
} ?>
<section style="display: inline-block;">
<form name="upload_action" action="" method="post">

<div style="float:right; width: 67%; margin-right: 20px; margin-top: 7px;">
                        <div class="field page_id"><label><?=$LANG['TITLE_EDIT_PAGE_ID'];?></label>
                        	<input type="text" name="page_id" value="<?=$media['page_id'];?>" placeholder="" style="width: 540px;border: 1px solid #ddd;">
                        </div>
                        <div class="field page_title"><label><?=$LANG['TITLE_EDIT_PAGE_TITLE'];?></label>
                        	<input type="text" name="page_title" value="<?=$media['page_title'];?>" placeholder="" style="width: 540px;border: 1px solid #ddd;">
                        </div>
                        <div class="field title"><label><?=$LANG['TITLE_EDIT_PAGE_TEXT'];?></label>
							<textarea class="upload_textarea3" name="text"><?=$media['text'];?></textarea>
						</div>
                        <div id="btn-container2"><input type="submit" name="submit_info" value="<?=$LANG['TITLE_SAVE'];?>"></div>
</div>
</form>
</section>
<? } ?><!-- Edit Page -->


<? if($_GET['subaction'] == 'add') { ?><!-- Add Page -->
<? $submit_info = $_POST['submit_info'];
if($submit_info) {
      $page_id = mysql_real_escape_string($_POST['page_id']); 
      $page_title = mysql_real_escape_string($_POST['page_title']);
	  $text = mysql_real_escape_string($_POST['text']);
		mysql_query("INSERT INTO $table_name (page_id, page_title, text) VALUES ('".$page_id."','".$page_title."','".$text."')"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action'];
		header('Location: '.$header_url.'');
} ?>
<section style="display: inline-block;">
<form name="upload_action" action="" method="post">

<div style="float:right; width: 67%; margin-right: 20px; margin-top: 7px;">
                        <div class="field page_id"><label><?=$LANG['TITLE_EDIT_PAGE_ID'];?></label>
                        	<input type="text" name="page_id" value="<?=$media['page_id'];?>" placeholder="" style="width: 540px;border: 1px solid #ddd;">
                        </div>
                        <div class="field page_title"><label><?=$LANG['TITLE_EDIT_PAGE_TITLE'];?></label>
                        	<input type="text" name="page_title" value="<?=$media['page_title'];?>" placeholder="" style="width: 540px;border: 1px solid #ddd;">
                        </div>
                        <div class="field title"><label><?=$LANG['TITLE_EDIT_PAGE_TEXT'];?></label>
							<textarea class="upload_textarea3" name="text"><?=$media['text'];?></textarea>
						</div>
                        <div id="btn-container2"><input type="submit" name="submit_info" value="<?=$LANG['TITLE_SAVE'];?>"></div>
</div>
</form>
</section>
<? } ?><!-- Add Page -->



</div>






</div>