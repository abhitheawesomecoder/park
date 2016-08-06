<?  $THEME_CONTENT_WRAP_RIGHT = 'off';  ?>
<div class="Container_Page">

<form id="setting">

  <div id="red_table_media"> <? $table_name = "news"; ?>

<?php $_GET['action'] = 'posts'; ?>

  <? if($_GET['subaction'] == '') {  ?><!-- Main Page -->
  <? if($_POST['remove_all']){ $checkbox = $_POST['checkbox'];$countCheck = count($_POST['checkbox']); for($i=0;$i<$countCheck;$i++){$del_id  = $checkbox[$i];$result = mysql_query("DELETE from $table_name WHERE id = $del_id");}if($result){$header_url = $root."/view/admin/".$_GET['action'];header('Location: '.$header_url.'');}else{}}
     if($_POST['active_all']){ $checkbox = $_POST['checkbox'];$countCheck = count($_POST['checkbox']); for($i=0;$i<$countCheck;$i++){$act_id  = $checkbox[$i];$result = mysql_query("UPDATE $table_name SET status='on' WHERE id = $act_id");}if($result){$header_url = $root."/view/admin/".$_GET['action'];header('Location: '.$header_url.'');}else{}}
     if($_POST['inactive_all']){ $checkbox = $_POST['checkbox'];$countCheck = count($_POST['checkbox']); for($i=0;$i<$countCheck;$i++){$act_id  = $checkbox[$i];$result = mysql_query("UPDATE $table_name SET status='off' WHERE id = $act_id");}if($result){$header_url = $root."/view/admin/".$_GET['action'];header('Location: '.$header_url.'');}else{}}
     ?>
  <form name="form" id="form" method="post"><center>
  <table style="border-collapse:collapse; border: 1px solid #E5E5E5; background-color: #FFF;width: 97%;" border="1" cellpadding="3" cellspacing="1">
  <tr style="padding: 5px;background: gray;color: #fff;">

  <td class="tdcheck" style="font-size: 14px;"><strong><?=$LANG['TITLE_POST_TITLE'];?></strong></td>
  <td class="tdcheck" style="font-size: 14px;"><strong><?=$LANG['TITLE_CATEGORY'];?></strong></td>

  <td class="tdcheck" style="font-size: 14px;"><strong><?=$LANG['TITLE_DATE'];?></strong></td>
  <td class="tdcheck" style="font-size: 14px;width: 110px;"><strong><?=$LANG['TITLE_ACTIVE_INACTIVE'];?></strong></td>
  <td class="tdcheck" style="height: 30px; font-size: 14px;"><strong><?=$LANG['TITLE_FUNCTION'];?></strong></td>
  </tr>


  <? $news = get_admin_posts($members["id"]); ?>
  <? foreach(array_slice($news, $startResults, $resultsPerPage) as $media): ?>
  <? $user_query = mysql_query("SELECT * FROM users WHERE id=".$media['author'].""); $user_row = mysql_fetch_row($user_query); $cat_query2 = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row2 = mysql_fetch_row($cat_query2); ?>
  <tr>

  <td class="tdcheck"><a class="td_link" href="<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>" target="_blank"><?=$media['title']?></a></td>
  <td class="tdcheck"><?=$cat_row2['1'];?></td>

  <td class="tdcheck">
  <font><?=$media['date']?></font></td>

  <td class="tdcheck" style="width: 94px;">
  <? if($media['status'] == 'on') { ?>
  <a href="<?=$root;?>/view/myproducts/<?=$_GET['action'];?>/inactive/<?=$media['id'];?>" style="font-size: 12px;color: #fff;width: 62px;background: #D80707;padding: 3px 10px;border: 1px solid #AD1515;border-radius: 5px;cursor: pointer;margin-left: 9px;">Set Inactive</a>
  <? } elseif($media['status'] == 'off') { ?>
  <a href="<?=$root;?>/view/myproducts/<?=$_GET['action'];?>/active/<?=$media['id'];?>" style="font-size: 12px;color: #fff;width: 52px;background: #3EAC0A;padding: 3px 15px;border: 1px solid #2D8603;border-radius: 5px;cursor: pointer;margin-left: 9px;">Set Active</a>
  <? } ?>
  </td>

  <td class="tdcheck" style="width: 94px;">
  <div class="btn-group btn-group-sm">
  <a href="<?=$root;?>/view/myproducts/<?=$_GET['action'];?>/delete/<?=$media['id'];?>" onclick="return confirm('<?=$LANG['confirm_to_delete_this_post'];?>');" class="btn_td btn-danger"><i class="fa fa-times"></i></a>
  </div>
  </td>
  </tr>
  <? endforeach; ?>

  </table>
  </center>
  <div style="margin-left: 14px; width: 97%; display: inline-block;">

  <div style="float: right; height: 0;"><? include_once ('pagination.tpl.php'); ?></div>
  </div>
  </form>
  <? } ?><!-- Main Page -->


  <? if($_GET['subaction'] == 'active') { ?><!-- Active Page -->

  <?  if($_GET['id']) {
  			mysql_query("UPDATE news SET status='on' WHERE id='".$_GET['id']."'");
  			$header_url = $root."/view/myproducts/".$_GET['action'];
  			header('Location: '.$header_url.'');
      } ?>

  <? } ?><!-- Active Page -->


  <? if($_GET['subaction'] == 'inactive') { echo "test"; ?><!-- Inactive Page -->

  <?  if($_GET['id']) {
  			mysql_query("UPDATE news SET status='off' WHERE id='".$_GET['id']."'");
  			$header_url = $root."/view/myproducts/".$_GET['action'];
  			header('Location: '.$header_url.'');
      } ?>

  <? } ?><!-- Inactive Page -->


  <? if($_GET['subaction'] == 'delete') { ?><!-- Delete Page -->

  <?  if($_GET['id']) {
  			$news_filter = mysql_query("SELECT * FROM news WHERE news_id='".$news_id."'");
  			while($row = mysql_fetch_array($news_filter)) {
  				$target = 'uploads/media_photos/'.$row["file"];
  				$target2 = 'uploads/media_photos/'.$row["thumb"];
  				if (file_exists($target)) { unlink($target); } if (file_exists($target2)) { unlink($target2); }
  				if (file_exists($target)) { } else { } if (file_exists($target2)) { } else { }
  			}
  			mysql_query("DELETE FROM news WHERE id='".$_GET['id']."'");
  			if($_GET['page'] == '') { $page = "1"; } else { $page = $_GET['page']; }
  			$header_url = $root."/view/myproducts/".$_GET['action'];
  			header('Location: '.$header_url.'');
      } ?>

  <? } ?><!-- Delete Page -->



  <? if($_GET['subaction'] == 'edit') { ?><!-- Edit Page -->
  <? $id = $_GET['id']; $media = get_admin_edit_posts($id);
  $submit_info = $_POST['submit_info'];
  if($submit_info) {
        $title = mysql_real_escape_string($_POST['title']);
  	  $category = $_POST['category'];
  	  $source = $_POST['source'];
  	  $description = mysql_real_escape_string($_POST['description']);
  		mysql_query("UPDATE $table_name SET title='$title', source='$source', description='$description', cat='$category' WHERE id='".$id."'");
  		//print success message.
  		$header_url = $root."/view/myproducts/".$_GET['action'];
  		header('Location: '.$header_url.'');
  } ?>
  <section style="display: inline-block;">
  <form name="upload_action" action="" method="post">
  <div style="float: left; padding: 7px 15px;">
  <img src="<?=$root;?>/uploads/media_photos/<?=$media['file'];?>" width="300" />
  </div>

  <div style="float:right; width: 60%; margin-right: 20px; margin-top: 7px;">
                          <? if($_GET['post_url']) { echo "<img src='".$root."/uploads/meme_photos/".$_GET['post_url'].".jpg"."' width='200'>"; }?>
                          <div class="field title"><label><?=$LANG['TITLE_TITLE'];?></label><p id="count_upload1" class="count ">120</p>
  							<textarea class="upload_textarea3" name="title" maxlength="120"><?=$media['title'];?></textarea>
  						</div>
                          <div class="field description"><label><?=$LANG['TITLE_DESCRIPTION'];?></label>
  							<textarea class="upload_textarea3" name="description" maxlength="120"><?=$media['description'];?></textarea>
  						</div>
                          <div class="field category">
                          	<select name="category" style="height: 36px;width: 560px;border-radius: 3px;border: 1px solid #ddd;">
                          		<option><?=$LANG['Select_Category_title'];?>…</option>
                                  <? $option_cat = get_option_cat();
  								   foreach($option_cat as $option_cat): ?>
                          		<option value="<?=$option_cat['id']?>" <? if($media['cat'] == $option_cat['id']) {?>selected="selected"<? }?>><?=$option_cat['name']?></option>
                                  <? endforeach; ?>
                          	</select>
                          </div>
                          <div class="field checkbox"><label><input type="checkbox" name="source" onclick="showMe('text_source')"> <?=$LANG['Attribute_original_creator_title'];?></label>
  						<div class="field source" id="text_source" style="display: none;"><input type="url" name="source" value="<?=$media['source'];?>" placeholder="http://" style="width: 540px;border: 1px solid #ddd;"></div>
  						</div>
                          <div id="btn-container2"><input type="submit" name="submit_info" value="<?=$LANG['upload_title'];?>"></div>
  </div>
  </form>
  </section>
  <? } ?><!-- Edit Page -->







  </div>

</form>



    <ul class="form-nav">
        <li><a href="<?=$root;?>/view/messages/new" <? if($_GET['action'] == 'new') { echo 'class="selected"'; }?>><?=$LANG['TITLE_MESSAGES_SEND_MESSAGE'];?></a></li>
        <li><a href="<?=$root;?>/view/messages" <? if($_GET['action'] == '') { echo 'class="selected"'; }?>><?=$LANG['TITLE_MESSAGES'];?><?php if($count_messages_seen == '0') { echo ""; } else { echo " (".$count_messages_seen.")"; } ?></a></li>
    </ul>

<div class="clearfix"></div>
</div>
