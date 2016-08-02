<div id="red_table_media"> <? $table_name = "comments"; ?>
<div class="bg_red_table_header"><?=$LANG['TITLE_COMMENTS'];?></div>

<div class="bg_body_table">
<? if($_GET['subaction'] == '') {  ?><!-- Main Page -->
<? if($_POST['remove_all']){ $checkbox = $_POST['checkbox'];$countCheck = count($_POST['checkbox']); for($i=0;$i<$countCheck;$i++){$del_id  = $checkbox[$i];$result = mysql_query("DELETE from $table_name WHERE c_id = $del_id");}if($result){$header_url = $root."/view/admin/".$_GET['action'];header('Location: '.$header_url.'');}else{}} ?>
<form name="form" id="form" method="post"><center>
<table style="border-collapse:collapse; border: 1px solid #E5E5E5; background-color: #FFF;width: 97%;" border="1" cellpadding="3" cellspacing="1">
<tr style="padding: 5px;background: gray;color: #fff;">
<td width="20px" class="tdcheckall"><input type="checkbox" name='checkall' onclick='checkedAll(form);' title="Check/Uncheck ALL" /></td>
<td class="tdcheck" style="font-size: 14px;"><strong><?=$LANG['TITLE_COMMENT'];?></strong></td>
<td class="tdcheck" style="font-size: 14px;"><strong><?=$LANG['TITLE_USERNAME'];?></strong></td>
<td class="tdcheck" style="font-size: 14px;"><strong><?=$LANG['TITLE_DATE'];?></strong></td>
<td class="tdcheck" style="height: 30px; font-size: 14px;"><strong><?=$LANG['TITLE_FUNCTION'];?></strong></td>
</tr>


<? $news = get_admin_comments(); ?>
<? foreach(array_slice($news, $startResults, $resultsPerPage) as $media): ?>
<? $user_query = mysql_query("SELECT * FROM users WHERE id=".$media['member_id'].""); $user_row = mysql_fetch_row($user_query); ?>
<tr>
<td class="tdcheckall"><input type='checkbox' name='checkbox[]' id='checkbox[]' value="<?=$media['c_id'];?>"></td>
<td class="tdcheck"><a class="td_link" href="<?=$media['domain'];?>" target="_blank"><?=$media['comment']?></a></td>
<td class="tdcheck"><?=$user_row['3'];?></td>
<td class="tdcheck"><?=$media['date'];?></td>

<td class="tdcheck" style="width: 94px;">
<div class="btn-group btn-group-sm">
<a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/delete/<?=$media['c_id'];?>" onclick="return confirm('<?=$LANG['confirm_to_delete_this_post'];?>');" class="btn_td btn-danger" style="border-top-left-radius: 3px; border-bottom-left-radius: 3px;"><i class="fa fa-times"></i></a>
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


<? if($_GET['subaction'] == 'delete') { ?><!-- Delete Page -->

<?  if($_GET['id']) {
			mysql_query("DELETE FROM $table_name WHERE c_id='".$_GET['id']."'");
			if($_GET['page'] == '') { $page = "1"; } else { $page = $_GET['page']; }
			$header_url = $root."/view/admin/".$_GET['action'];
			header('Location: '.$header_url.'');
    } ?>

<? } ?><!-- Delete Page -->


</div>






</div>