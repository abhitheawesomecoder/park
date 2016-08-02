<?
$all_posts = mysql_query("SELECT * FROM news");
		$all_posts_row = mysql_num_rows($all_posts);
$daily_posts = mysql_query("SELECT * FROM news WHERE date='".date("Y-m-d")."'");
		$daily_posts_row = mysql_num_rows($daily_posts);
$all_comments = mysql_query("SELECT * FROM comments");
		$all_comments_row = mysql_num_rows($all_comments);
$daily_comments = mysql_query("SELECT * FROM comments WHERE date='".date("Y-m-d")."'");
		$daily_comments_row = mysql_num_rows($daily_comments);
$all_users = mysql_query("SELECT * FROM users");
		$all_users_row = mysql_num_rows($all_users);
$daily_users = mysql_query("SELECT * FROM users WHERE register_date='".date("Y-m-d")."'");
		$daily_users_row = mysql_num_rows($daily_users);
?>
<table>
<tr>
<td style="padding-right: 24px;">
<div id="clock" class="light">
			<div class="display">
				<div id="weekdays" style="top: -20px; position: relative; font-size: 18px;"></div>
				<div class="digits" style="width: 250px; position: relative; top: 10px; left: 0px;"></div>
			</div>
		</div>
</td>

<td>

<div id="column_s25">
<div class="tiles red" style="zoom: 1;">
<div class="circle-icon bg-success"><i class="fa fa-map-marker"></i></div>
<div class="bg-title"><?=$LANG['DAILY_POSTS'];?><br><font style="font-size: 28px;position: relative;top: 5px;"><?=$daily_posts_row?></font></div>
</div>
</div>


<div id="column_s25">
<div class="tiles green" style="zoom: 1;">
<div class="circle-icon bg-success"><i class="fa fa-comments"></i></div>
<div class="bg-title"><?=$LANG['DAILY_COMMENTS'];?><br><font style="font-size: 28px;position: relative;top: 5px;"><?=$daily_comments_row?></font></div>
</div>
</div>


<div id="column_s25">
<div class="tiles purple" style="zoom: 1;">
<div class="circle-icon bg-success"><i class="fa fa-users"></i></div>
<div class="bg-title"><?=$LANG['DAILY_NEW_USERS'];?><br><font style="font-size: 28px;position: relative;top: 5px;"><?=$daily_users_row?></font></div>
</div>
</div>




<div id="column_s25">
<div class="tiles red" style="zoom: 1;">
<div class="circle-icon bg-success"><i class="fa fa-map-marker"></i></div>
<div class="bg-title"><?=$LANG['ALL_POSTS'];?><br><font style="font-size: 28px;position: relative;top: 5px;"><?=$all_posts_row?></font></div>
</div>
</div>


<div id="column_s25">
<div class="tiles green" style="zoom: 1;">
<div class="circle-icon bg-success"><i class="fa fa-comments"></i></div>
<div class="bg-title"><?=$LANG['ALL_COMMENTS'];?><br><font style="font-size: 28px;position: relative;top: 5px;"><?=$all_comments_row?></font></div>
</div>
</div>


<div id="column_s25">
<div class="tiles purple" style="zoom: 1;">
<div class="circle-icon bg-success"><i class="fa fa-users"></i></div>
<div class="bg-title"><?=$LANG['ALL_USERS'];?><br><font style="font-size: 28px;position: relative;top: 5px;"><?=$all_users_row?></font></div>
</div>
</div>

</td>
</tr>
</table>


<br />
<? $submit_notes = $_POST['submit_notes'];
if($submit_notes) {
	$notes = $_POST['notes'];
		mysql_query("UPDATE settings SET notes='$notes'"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action'];
		header('Location: '.$header_url.'');
}
?>
<form name="upload_action" action="" method="post">
<div style="border-radius: 3px; width: 92.4%; padding: 5px 15px; display: inline-block; background-color: #dddddd; box-shadow: 0 1px 1px rgba(0,0,0,0.08) inset, 0 1px 1px #fafafa;">
<div class="field website_description">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['NOTES'];?></label>
<textarea class="upload_textarea3" name="notes" placeholder="<?=$LANG['WRITE_YOUR_NOTES'];?> ..." style="width: 97.8%; height: 165px; border: 1px solid #ddd;"><?=WRITE_NOTES;?></textarea>
</div>

<div id="setting" style="float: right; display: inline-block; position:relative; top: -2px;"><div class="btn">
  <input name="submit_notes" type="submit" value="<?=$LANG['SAVE_NOTE'];?>">
</div></div>
</form>





</div>