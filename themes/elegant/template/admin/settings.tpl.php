<div id="red_table_media"> <? $table_name = "settings"; ?>
<div class="bg_red_table_header"><?=$LANG['TITLE_SETTINGS'];?></div>

<div class="bg_body_table" style="display: inline-block;">
<style>ul.ulinline li { border-bottom: 1px solid #CCC; } ul.ulinline li a{ color: #fff; padding: 0px 15px; line-height: 30px; height: 30px; display: block; }</style>
<div style="display: inline-block; float: left; width: 200px; background: gray;">
<ul class="ulinline" style="margin: 0; padding: 0; list-style: none;">
<li><a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/" <? if($_GET['subaction'] == '') { ?>style="background: #fff; color: #000; font-weight: bold;"<? }?>><?=$LANG['SETTINGS_WEBSITE'];?></a></li>
<li><a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/media" <? if($_GET['subaction'] == 'media') { ?>style="background: #fff; color: #000; font-weight: bold;"<? }?>><?=$LANG['SETTINGS_MEDIA'];?></a></li>
<li><a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/social-media" <? if($_GET['subaction'] == 'social-media') { ?>style="background: #fff; color: #000; font-weight: bold;"<? }?>><?=$LANG['SETTINGS_SOCIAL_MEDIA'];?></a></li>
<li><a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/ad-management" <? if($_GET['subaction'] == 'ad-management') { ?>style="background: #fff; color: #000; font-weight: bold;"<? }?>><?=$LANG['SETTINGS_AD_MANAGEMENT'];?></a></li>
<li><a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/age-verification" <? if($_GET['subaction'] == 'age-verification') { ?>style="background: #fff; color: #000; font-weight: bold;"<? }?>><?=$LANG['SETTINGS_NSFW_MODAL'];?></a></li>
<li><a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/analytics" <? if($_GET['subaction'] == 'analytics') { ?>style="background: #fff; color: #000; font-weight: bold;"<? }?>><?=$LANG['SETTINGS_ANALYTICS'];?></a></li>
<li><a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/rss" <? if($_GET['subaction'] == 'rss') { ?>style="background: #fff; color: #000; font-weight: bold;"<? }?>><?=$LANG['SETTINGS_RSS'];?></a></li>
<li><a href="<?=$root;?>/view/admin/<?=$_GET['action'];?>/sitemap" <? if($_GET['subaction'] == 'sitemap') { ?>style="background: #fff; color: #000; font-weight: bold;"<? }?>><?=$LANG['SETTINGS_SITEMAP'];?></a></li>
</ul>
</div>
<div style="display: inline-block; float: right; width: 723px;background: #fff;">
<div style="display: inline-block; padding: 10px 50px;">


<? if($_GET['subaction'] == 'change_theme') { 
       if($_GET['id']) {
		   mysql_query("UPDATE settings SET theme='".$_GET['id']."'"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action'];
		header('Location: '.$header_url.'');
		   
	   }
   } ?>
<? if($_GET['subaction'] == '') { ?><!-- Website Page -->
<? $submit_info = $_POST['submit_info'];
if($submit_info) {
	$path = "themes/".$SETTINGS['theme']."/images/";
		$valid_formats = array("jpg", "png", "gif");
		$name = $_FILES['photoimg']['name'];
		$size = $_FILES['photoimg']['size'];
		$valid_formats2 = array("png");
		$name2 = $_FILES['faviconimg']['name'];
		$size2 = $_FILES['faviconimg']['size'];
		list($txt, $ext) = explode(".", $name);
		list($txt2, $ext2) = explode(".", $name2);
		$actual_image_name = "logo_custom.".$ext;
		$tmp = $_FILES['photoimg']['tmp_name'];
		$actual_favicon_name = "favicon_custom.".$ext2;
		$tmp2 = $_FILES['faviconimg']['tmp_name'];
		if(move_uploaded_file($tmp, $path.$actual_image_name)) { $logo="logo='$actual_image_name',"; } else { }
		if(move_uploaded_file($tmp2, $path.$actual_favicon_name)) { $favicon="favicon='$actual_favicon_name',"; } else { }
	$photoimg = $_POST['photoimg'];
	$faviconimg = $_POST['faviconimg'];
	$watermark = $_POST['watermark'];
	$website_name = $_POST['website_name'];
	$website_keywords = $_POST['website_keywords'];
	$website_description = $_POST['website_description'];
	$main_page_title = $_POST['main_page_title'];
	$sidebar_title = $_POST['sidebar_title'];
	$permalink = $_POST['permalink'];
	$upload_type = $_POST['upload_type'];
	$languages = $_POST['languages'];
	$box_type = $_POST['box_type'];
	$turn_pages = $_POST['turn_pages'];
	$turn_other_sidebar = $_POST['turn_other_sidebar'];
	if (!isset($turn_pages)) $turn_pages = 0;
	if (!isset($turn_other_sidebar)) $turn_other_sidebar = 0;
		mysql_query("UPDATE settings SET $logo $favicon upload_type='$upload_type', lang='$languages', turn_other_sidebar='$turn_other_sidebar', turn_pages='$turn_pages', box_type='$box_type', permalink='$permalink', watermark='$watermark', website_name='$website_name', website_keywords='$website_keywords', website_description='$website_description', index_page_title='$main_page_title', sidebar_title='$sidebar_title'"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action'];
		header('Location: '.$header_url.'');
	
}
?>
<form name="upload_action" action="" method="post" enctype="multipart/form-data">
<style>.item-overlay.active, .theme_item:hover .item-overlay { display: block; }
.item .opacity {
background-color: rgba(0,0,0,0.75);
}
.item-overlay {
display: none;
position: absolute;
top: 0;
right: 0;
bottom: 0;
left: 0;
}
.r-2x {
border-radius: 4px;
}
.img-full {
width: 100%;
}
img {
vertical-align: middle;
}
img {
border: 0;
}
.theme_item .opacity {
background-color: rgba(0,0,0,0.75);
}
.theme_item .center {
position: relative;
top: 50px;
color: #fff;
padding: 10px;
font-size: 24px;
text-align: center;
}
.theme_item .top {
position: absolute;
top: 0;
left: 0;
right: 0;
}
.m-r-sm {
margin-right: 10px;
}
.m-t-n-xs {
margin-top: -5px;
}
.text-white {
color: #E91D1D;
}
.pull-right {
float: right !important;
}
.i-lg {
font-size: 1.3333333333333em;
line-height: 0.75em;
vertical-align: -15%;
}
</style>
<table>
<tr>
<td>
<div class="theme_item" style="width: 310px;">
<div style="position: relative;background-color: rgba(50,50,50,0.25); border: 2px solid transparent; border-radius: 10px; background-clip: padding-box;">
<a href="<?=$root;?>/index.php?view=admin&action=settings&subaction=change_theme&id=default" class="item-overlay opacity r r-2x bg-black">
<div class="center m-t-n">Default</div>
</a>
<? if($settings['theme'] == 'default') { ?><div class="top"> <span class="pull-right m-t-n-xs m-r-sm text-white"> <i class="fa fa-bookmark i-lg"></i> </span> </div><? } ?>
<a href="<?=$root;?>/index.php?view=admin&action=settings&subaction=change_theme&id=default"><img src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/images/admin_theme_default.png" alt="" class="r r-2x img-full"></a>
</div>
</div>
</td>
<td>
<div class="theme_item" style="width: 310px;">
<div style="position: relative;background-color: rgba(50,50,50,0.25); border: 2px solid transparent; border-radius: 10px; background-clip: padding-box;">
<a href="<?=$root;?>/index.php?view=admin&action=settings&subaction=change_theme&id=elegant" class="item-overlay opacity r r-2x bg-black">
<div class="center m-t-n">Elegant</div>
</a>
<? if($settings['theme'] == 'elegant') { ?><div class="top"> <span class="pull-right m-t-n-xs m-r-sm text-white"> <i class="fa fa-bookmark i-lg"></i> </span> </div><? } ?>
<a href="<?=$root;?>/index.php?view=admin&action=settings&subaction=change_theme&id=elegant"><img src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/images/admin_theme_elegant.png" alt="" class="r r-2x img-full"></a>
</div>
</div>
</td>
</tr>
</table>

<br />
<div class="field logo">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_LOGO'];?></label>
<img src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/images/<?=LOGO;?>" />
</div>
<div class="field photo">
<label style="margin-bottom: 12px;"><?=$LANG['SETTINGS_UPLOAD_LOGO'];?></label>
<div class="file-field"><input class="file text" type="file" name="photoimg" accept="image/gif,image/jpeg,image/jpg,image/png"></div>
</div>

<div style="margin-top: 17px;"></div>

<div class="field favicon">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_FAVICON'];?></label>
<img src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/images/<?=FAVICON;?>" width="32" />
</div>
<div class="field photo">
<label style="margin-bottom: 12px;"><?=$LANG['SETTINGS_UPLOAD_FAVICON'];?></label>
<div class="file-field"><input class="file text" type="file" name="faviconimg" accept="image/gif,image/jpeg,image/jpg,image/png"></div>
</div>

<div style="margin-top: 17px;"></div>

<div class="field watermark">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_WATERMARK'];?></label>
<input type="text" name="watermark" value="<?=watermark;?>" style="width: 540px;border: 1px solid #ddd;">
</div>

<div style="margin-top: 17px;"></div>

<div id="setting"><label><input type="checkbox" name="turn_other_sidebar" value="1" <? if(TURN_OTHER_SIDEBAR == '1') {?> checked<? }?>><font style="margin-left: 5px; position: relative; top: -1px;"><?=$LANG['SETTINGS_TURN_OTHER_SIDEBAR'];?></font></label></div>

<div style="margin-top: 17px;"></div>

<div id="setting"><label><input type="checkbox" name="turn_pages" value="1" <? if(TURN_PAGES == '1') {?> checked<? }?>><font style="margin-left: 5px; position: relative; top: -1px;"><?=$LANG['SETTINGS_TURN_PAGES'];?></font></label></div>

<div style="margin-top: 17px;"></div>

<div class="field permalink">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_LANGUAGE_TYPE'];?></label>
<select name="languages" style="height: 36px;width: 560px;border-radius: 3px;border: 1px solid #ddd;">
     <option><?=$LANG['SETTINGS_LANGUAGE_TYPE'];?></option>
	  <option value="de" <? if($SETTINGS['lang'] == 'de') {?>selected<? }?>>Deutsch</option>
     <option value="en" <? if($SETTINGS['lang'] == 'en') {?>selected<? }?>>English</option>
     <option value="ge" <? if($SETTINGS['lang'] == 'ge') {?>selected<? }?>>Georgian</option>
     <option value="ja" <? if($SETTINGS['lang'] == 'ja') {?>selected<? }?>>Japanese</option>
     <option value="sk" <? if($SETTINGS['lang'] == 'sk') {?>selected<? }?>>Slovak</option>
     <option value="cz" <? if($SETTINGS['lang'] == 'cz') {?>selected<? }?>>Czech</option>
</select>
</div>

<div class="field upload_type">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_UPLOAD_TYPE'];?></label>
<select name="upload_type" style="height: 36px;width: 560px;border-radius: 3px;border: 1px solid #ddd;">
     <option><?=$LANG['SETTINGS_CHOOSE_UPLOAD_TYPE'];?></option>
     <option value="auto" <? if($SETTINGS['upload_type'] == 'auto') {?>selected<? }?>>Auto Post Media From Every Users</option>
     <option value="pend" <? if($SETTINGS['upload_type'] == 'pend') {?>selected<? }?>>Pending (Active and Inactive buttons each media)</option>
</select>
</div>

<div class="field permalink">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_PERMALINK'];?></label>
<select name="permalink" style="height: 36px;width: 560px;border-radius: 3px;border: 1px solid #ddd;">
     <option><?=$LANG['SETTINGS_CHOOSE_PERMALINK'];?></option>
     <option value="gag" <? if($SETTINGS['permalink'] == 'gag') {?>selected<? }?>>Default (<?=$root;?>/gag/$news_id)</option>
     <option value="cat" <? if($SETTINGS['permalink'] == 'cat') {?>selected<? }?>>Category (<?=$root;?>/category_name/$news_id)</option>
     <option value="cat_slugify" <? if($SETTINGS['permalink'] == 'cat_slugify') {?>selected<? }?>>Responsive Url (<?=$root;?>/category_name/news-title)</option>
</select>
</div>

<div style="margin-top: 17px;"></div>

<div class="field box_type">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_BOX_TYPE'];?></label>
<select name="box_type" style="height: 36px;width: 560px;border-radius: 3px;border: 1px solid #ddd;">
     <option><?=$LANG['SETTINGS_CHOOSE_BOX_TYPE'];?></option>
     <option value="big" <? if($SETTINGS['box_type'] == 'big') {?>selected<? }?>>Big Box</option>
     <option value="small" <? if($SETTINGS['box_type'] == 'small') {?>selected<? }?>>Small Box</option>
</select>
</div>

<div style="margin-top: 17px;"></div>

<div class="field website_name">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_WEBSITE_NAME'];?></label>
<input type="text" name="website_name" value="<?=WEBSITE_NAME;?>" style="width: 540px;border: 1px solid #ddd;">
</div>

<div style="margin-top: 17px;"></div>

<div class="field website_keywords">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_WEBSITE_KEYWORDS'];?></label>
<textarea class="upload_textarea3" name="website_keywords" maxlength="1000" style="width: 540px; height: 50px; border: 1px solid #ddd;"><?=WEBSITE_KEYWORDS;?></textarea>
</div>

<div style="margin-top: 17px;"></div>

<div class="field website_description">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_WEBSITE_DESCRIPTION'];?></label>
<textarea class="upload_textarea3" name="website_description" maxlength="1000" style="width: 540px; height: 50px; border: 1px solid #ddd;"><?=WEBSITE_DESCRIPTION;?></textarea>
</div>

<div style="margin-top: 17px;"></div>

<div class="field main_page_title">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_MAIN_PAGE_TITLE'];?></label>
<input type="text" name="main_page_title" value="<?=INDEX_PAGE_TITLE;?>" style="width: 540px;border: 1px solid #ddd;">
</div>

<div style="margin-top: 17px;"></div>

<div class="field sidebar_title">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_SIDEBAR_TITLE'];?></label>
<input type="text" name="sidebar_title" value="<?=SIDEBAR_TITLE;?>" style="width: 540px;border: 1px solid #ddd;">
</div>

<div id="setting"><br /><div class="btn">
  <input name="submit_info" type="submit" value="<?=$LANG['SETTINGS_SAVE'];?>">
</div></div>

</form>
<? } ?><!-- Website Page -->


<? if($_GET['subaction'] == 'themes') { ?><!-- Themes Page -->
<? $submit_themes = $_POST['submit_themes'];
if($submit_themes) {
	$theme_color = $_POST['theme_color'];
	$theme_header_color = $_POST['theme_header_color'];
	$theme_header_text_color = $_POST['theme_header_text_color'];
	$theme_header_auth_box_color = $_POST['theme_header_auth_box_color'];
	$theme_header_auth_box_text_color = $_POST['theme_header_auth_box_text_color'];
	$theme_content_color = $_POST['theme_content_color'];
	$theme_inner_content_color = $_POST['theme_inner_content_color'];
	$theme_sidebar_color = $_POST['theme_sidebar_color'];
	$theme_sidebar_text_color = $_POST['theme_sidebar_text_color'];
	$theme_buttons_color = $_POST['theme_buttons_color'];
	$theme_media_box_color = $_POST['theme_media_box_color'];
	$theme_media_box_hover_color = $_POST['theme_media_box_hover_color'];
	$theme_media_box_border_color = $_POST['theme_media_box_border_color'];
	$theme_profile_header_color = $_POST['theme_profile_header_color'];
		mysql_query("UPDATE settings SET theme_color='$theme_color', theme_header_color='$theme_header_color', theme_header_text_color='$theme_header_text_color', theme_header_auth_box_color='$theme_header_auth_box_color', theme_header_auth_box_text_color='$theme_header_auth_box_text_color', theme_content_color='$theme_content_color', theme_inner_content_color='$theme_inner_content_color', theme_sidebar_color='$theme_sidebar_color', theme_sidebar_text_color='$theme_sidebar_text_color', theme_buttons_color='$theme_buttons_color', theme_media_box_color='$theme_media_box_color', theme_media_box_border_color='$theme_media_box_border_color', theme_profile_header_color='$theme_profile_header_color', theme_media_box_hover_color='$theme_media_box_hover_color'"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action']."/".$_GET['subaction'];
		header('Location: '.$header_url.'');
}
?>
<form name="upload_action" action="" method="post" enctype="multipart/form-data">

<div class="field theme_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_COLOR'];?></label>
<input type="text" name="theme_color" class="color" value="<?=$SETTINGS['theme_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_header_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_HEADER_COLOR'];?></label>
<input type="text" name="theme_header_color" class="color" value="<?=$SETTINGS['theme_header_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_header_text_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_HEADER_TEXT_COLOR'];?></label>
<input type="text" name="theme_header_text_color" class="color" value="<?=$SETTINGS['theme_header_text_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_header_auth_box_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_HEADER_AUTH_BOX_COLOR'];?></label>
<input type="text" name="theme_header_auth_box_color" class="color" value="<?=$SETTINGS['theme_header_auth_box_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_header_auth_box_text_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_HEADER_AUTH_BOX_TEXT_COLOR'];?></label>
<input type="text" name="theme_header_auth_box_text_color" class="color" value="<?=$SETTINGS['theme_header_auth_box_text_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_content_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_CONTENT_COLOR'];?></label>
<input type="text" name="theme_content_color" class="color" value="<?=$SETTINGS['theme_content_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_inner_content_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_INNER_CONTENT_COLOR'];?></label>
<input type="text" name="theme_inner_content_color" class="color" value="<?=$SETTINGS['theme_inner_content_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_sidebar_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_SIDEBAR_COLOR'];?></label>
<input type="text" name="theme_sidebar_color" class="color" value="<?=$SETTINGS['theme_sidebar_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_sidebar_text_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_SIDEBAR_TEXT_COLOR'];?></label>
<input type="text" name="theme_sidebar_text_color" class="color" value="<?=$SETTINGS['theme_sidebar_text_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_buttons_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_BUTTONS_COLOR'];?></label>
<input type="text" name="theme_buttons_color" class="color" value="<?=$SETTINGS['theme_buttons_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_media_box_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_MEDIA_BOX_COLOR'];?></label>
<input type="text" name="theme_media_box_color" class="color" value="<?=$SETTINGS['theme_media_box_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_media_box_border_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_MEDIA_BOX_BORDER_COLOR'];?></label>
<input type="text" name="theme_media_box_border_color" class="color" value="<?=$SETTINGS['theme_media_box_border_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_media_box_hover_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_BOX_HOVER_COLOR'];?></label>
<input type="text" name="theme_media_box_hover_color" class="color" value="<?=$SETTINGS['theme_media_box_hover_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: -20px;"></div>

<div class="field theme_profile_header_color">
<label style="margin-bottom: 12px; font-size: 16px;"><?=$LANG['SETTINGS_THEME_PROFILE_HEADER_COLOR'];?></label>
<input type="text" name="theme_profile_header_color" class="color" value="<?=$SETTINGS['theme_profile_header_color'];?>" style="border-radius: 0px; border: 1px solid #999; width: 80px; height: 5px;" />
</div>

<div style="margin-top: 17px;"></div>


<div id="setting"><br /><div class="btn">
  <input name="submit_themes" type="submit" value="<?=$LANG['SETTINGS_SAVE'];?>">
</div></div>

</form>
<? } ?><!-- Themes Page -->




<? if($_GET['subaction'] == 'media') { ?><!-- Media Page -->
<? $submit_media = $_POST['submit_media'];
if($submit_media) {
	$posts_per_page = $_POST['posts_per_page'];
	$min_length_search = $_POST['min_length_search'];
	$turn_comments = $_POST['turn_comments'];
	$turn_share = $_POST['turn_share'];
	$turn_search = $_POST['turn_search'];
	$char_in_desc = $_POST['char_in_desc'];
	if (!isset($turn_comments)) $turn_comments = 0;
	if (!isset($turn_share)) $turn_share = 0;
	if (!isset($turn_search)) $turn_search = 0;
	$sidebar_title = $_POST['sidebar_title'];
		mysql_query("UPDATE settings SET char_in_desc='$char_in_desc', rows_per_page='$posts_per_page', min_length_search='$min_length_search', comments_turn='$turn_comments', share_social_network_turn='$turn_share', search_turn='$turn_search'"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action']."/".$_GET['subaction'];
		header('Location: '.$header_url.'');
}
?>
<form name="upload_action" action="" method="post">
<div class="field char_in_desc">
<label style="margin-bottom: 5px; font-size: 16px;">Chars In Description</label>
<input type="text" name="char_in_desc" value="<?=char_in_desc;?>" style="width: 540px;border: 1px solid #ddd;">
</div>

<div style="margin-top: 27px;"></div>

<div class="field Posts_Per_Page">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_POSTS_PER_PAGE'];?></label>
<input type="text" name="posts_per_page" value="<?=ROWS_IN_CATEGORIES_PER_PAGE;?>" style="width: 540px;border: 1px solid #ddd;">
</div>

<div style="margin-top: 27px;"></div>

<div class="field website_name">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_MIN_LENGTH_SEARCH'];?></label>
<input type="text" name="min_length_search" value="<?=MIN_LENGTH_SEARCH;?>" style="width: 540px;border: 1px solid #ddd;">
</div>

<div style="margin-top: 27px;"></div>

<div id="setting"><label><input type="checkbox" name="turn_comments" value="1" <? if(COMMENTS_TURN == '1') {?> checked<? }?>><font style="margin-left: 5px; position: relative; top: -1px;"><?=$LANG['SETTINGS_TURN_COMMENTS_ON_WEBSITE'];?></font></label></div>

<div style="margin-top: 17px;"></div>

<div id="setting"><label><input type="checkbox" name="turn_share" value="1" <? if(SHARE_SOCIAL_NETWORK_TURN == '1') {?> checked<? }?>><font style="margin-left: 5px; position: relative; top: -1px;"><?=$LANG['SETTINGS_TURN_SOCIAL_NETWORK_SHARE_BUTTONS'];?></font></label></div>

<div style="margin-top: 17px;"></div>

<div id="setting"><label><input type="checkbox" name="turn_search" value="1" <? if(SEARCH_TURN == '1') {?> checked<? }?>><font style="margin-left: 5px; position: relative; top: -1px;"><?=$LANG['SETTINGS_TURN_SEARCH_ON_WEBSITE'];?></font></label></div>

<div style="margin-top: 17px;"></div>

<div id="setting"><br /><div class="btn">
  <input name="submit_media" type="submit" value="<?=$LANG['SETTINGS_SAVE'];?>">
</div></div>

</form>
<? } ?><!-- Media Page -->


<? if($_GET['subaction'] == 'age-verification') { ?><!-- Age Verification Page -->
<? $submit_info = $_POST['submit_info'];
if($submit_info) {
	$terms = mysql_real_escape_string($_POST['terms']);
	$turn_18 = mysql_real_escape_string($_POST['turn_18']);
	if (!isset($turn_18)) $turn_18 = 0;
		mysql_query("UPDATE settings SET age_18='".$turn_18."', terms_website='".$terms."'");
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action']."/".$_GET['subaction'];
		header('Location: '.$header_url.'');
}
?>
<form name="upload_action" action="" method="post" enctype="multipart/form-data">
<div class="field terms_and_conditions">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_TERMS_RULES'];?></label>
<textarea class="upload_textarea3" name="terms" style="width: 630px; height: 300px; border: 1px solid #ddd;"><?=TERMS_AND_CONDITIONS;?></textarea>
</div>

<div style="margin-top: 27px;"></div>

<div id="setting"><label><input type="checkbox" name="turn_18" value="1" <? if(TURN_18 == '1') {?> checked<? }?>><font style="margin-left: 5px; position: relative; top: -1px;"><?=$LANG['SETTINGS_TURN_NSFW_MODAL'];?></font></label></div>

<div style="margin-top: 17px;"></div>

<div id="setting"><br /><div class="btn">
  <input name="submit_info" type="submit" value="<?=$LANG['SETTINGS_SAVE'];?>">
</div></div>

</form>
<? } ?><!-- Age Verification Page -->


<? if($_GET['subaction'] == 'social-media') { ?><!-- Social Media Page -->
<? $submit_social_media = $_POST['submit_social_media'];
if($submit_social_media) {
	$FACEBOOK_PAGE_ID = $_POST['FACEBOOK_PAGE_ID'];
	$FACEBOOK_APP_ID = $_POST['FACEBOOK_APP_ID'];
	$FACEBOOK_APP_SECRET = $_POST['FACEBOOK_APP_SECRET'];
	$TWITTER_CONSUMER_KEY = $_POST['TWITTER_CONSUMER_KEY'];
	$TWITTER_CONSUMER_SECRET = $_POST['TWITTER_CONSUMER_SECRET'];
		mysql_query("UPDATE settings SET TWITTER_CONSUMER_KEY='$TWITTER_CONSUMER_KEY', TWITTER_CONSUMER_SECRET='$TWITTER_CONSUMER_SECRET', FACEBOOK_PAGE_ID='$FACEBOOK_PAGE_ID', FACEBOOK_APP_ID='$FACEBOOK_APP_ID', FACEBOOK_APP_SECRET='$FACEBOOK_APP_SECRET'"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action']."/".$_GET['subaction'];
		header('Location: '.$header_url.'');
}
?>
<form name="upload_action" action="" method="post">
<div class="field FACEBOOK_PAGE_ID">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_FACEBOOK_PAGE_ID'];?></label>
<input type="text" name="FACEBOOK_PAGE_ID" value="<?=FACEBOOK_PAGE_ID;?>" style="width: 540px;border: 1px solid #ddd;">
</div>

<div style="margin-top: 27px;"></div>

<div class="field FACEBOOK_APP_ID">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_FACEBOOK_APP_ID'];?></label>
<input type="text" name="FACEBOOK_APP_ID" value="<?=APP_ID;?>" style="width: 540px;border: 1px solid #ddd;">
</div>

<div style="margin-top: 27px;"></div>

<div class="field FACEBOOK_APP_SECRET">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_FACEBOOK_APP_SECRET'];?></label>
<input type="text" name="FACEBOOK_APP_SECRET" value="<?=APP_SECRET;?>" style="width: 540px;border: 1px solid #ddd;">
</div>

<div style="margin-top: 27px;"></div>

<div class="field Twitter_Key">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_TWITTER_KEY'];?></label>
<input type="text" name="TWITTER_CONSUMER_KEY" value="<?=TWITTER_CONSUMER_KEY;?>" style="width: 540px;border: 1px solid #ddd;">
</div>

<div style="margin-top: 27px;"></div>

<div class="field Twitter_Secret_Key">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_TWITTER_SECRET_KEY'];?></label>
<input type="text" name="TWITTER_CONSUMER_SECRET" value="<?=TWITTER_CONSUMER_SECRET;?>" style="width: 540px;border: 1px solid #ddd;">
</div>


<div style="margin-top: 27px;"></div>



<div id="setting"><br /><div class="btn">
  <input name="submit_social_media" type="submit" value="<?=$LANG['SETTINGS_SAVE'];?>">
</div></div>

</form>
<? } ?><!-- Scoial Media Page -->



<? if($_GET['subaction'] == 'ad-management') { ?><!-- Ad Management Page -->
<? $submit_ad = $_POST['submit_ad'];
if($submit_ad) {
	$mobile_small_advert_turn = $_POST['mobile_small_advert_turn'];
	$mobile_small_advert = $_POST['mobile_small_advert'];
	$header_advert_turn = $_POST['header_advert_turn'];
	$header_advert = $_POST['header_advert'];
	$advert_small = $_POST['advert_small'];
	$advert_big = $_POST['advert_big'];
	if (!isset($header_advert_turn)) $header_advert_turn = 0;
		mysql_query("UPDATE settings SET mobile_small_advert_turn='$mobile_small_advert_turn', mobile_small_advert='$mobile_small_advert', header_advert_turn='$header_advert_turn', header_advert='$header_advert', advert_small='$advert_small', advert_big='$advert_big'"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action']."/".$_GET['subaction'];
		header('Location: '.$header_url.'');
}
?>
<form name="upload_action" action="" method="post">

<div class="field header_advert_turn">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_TURN_HEADER_ADVERT'];?></label>

<label><input type="checkbox" name="header_advert_turn" value="1" <? if(header_advert_turn == '1') {?> checked<? }?>><font style="margin-left: 5px; position: relative; top: -1px;"><?=$LANG['SETTINGS_TURN_HEADER_ADVERT'];?></font></label>
</div>

<div style="margin-top: 27px;"></div>

<div class="field header_advert">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_HEADER_ADVERT'];?></label>
<textarea class="upload_textarea3" name="header_advert" maxlength="1000" style="width: 540px; height: 50px; border: 1px solid #ddd;"><?=header_advert;?></textarea>
</div>

<div style="margin-top: 27px;"></div>

<div class="field header_advert_turn">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_TURN_MOBILE_SMALL_ADVERT'];?></label>

<label><input type="checkbox" name="mobile_small_advert_turn" value="1" <? if(mobile_small_advert_turn == '1') {?> checked<? }?>><font style="margin-left: 5px; position: relative; top: -1px;"><?=$LANG['SETTINGS_TURN_MOBILE_SMALL_ADVERT'];?></font></label>
</div>

<div style="margin-top: 27px;"></div>

<div class="field header_advert">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_MOBILE_SMALL_ADVERT'];?></label>
<textarea class="upload_textarea3" name="mobile_small_advert" maxlength="1000" style="width: 540px; height: 50px; border: 1px solid #ddd;"><?=mobile_small_advert;?></textarea>
</div>

<div style="margin-top: 27px;"></div>

<div class="field advert_small">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_SMALL_ADVERT'];?></label>
<textarea class="upload_textarea3" name="advert_small" maxlength="1000" style="width: 540px; height: 50px; border: 1px solid #ddd;"><?=ADVERT_IN_CAT;?></textarea>
</div>

<div style="margin-top: 27px;"></div>

<div class="field advert_big">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_BIG_SIDEBAR_ADVERT'];?></label>
<textarea class="upload_textarea3" name="advert_big" maxlength="1000" style="width: 540px; height: 50px; border: 1px solid #ddd;"><?=ADVERT_BIG;?></textarea>
</div>


<div style="margin-top: 27px;"></div>



<div id="setting"><br /><div class="btn">
  <input name="submit_ad" type="submit" value="<?=$LANG['SETTINGS_SAVE'];?>">
</div></div>

</form>
<? } ?><!-- Ad Management Page -->




<? if($_GET['subaction'] == 'analytics') { ?><!-- Analytics Page -->
<? $submit_analytics = $_POST['submit_analytics'];
if($submit_analytics) {
	echo "dssd";
	$analytics = mysql_real_escape_string($_POST['analytics']);
		mysql_query("UPDATE settings SET analytics='$analytics'"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action']."/".$_GET['subaction'];
		header('Location: '.$header_url.'');
}
?>
<form name="upload_action" action="" method="post">
<div class="field analytics">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_ANALYTICS'];?></label>
<textarea class="upload_textarea3" name="analytics" style="width: 540px; height: 170px; border: 1px solid #ddd;"><?=analytics;?></textarea>
</div>


<div style="margin-top: 27px;"></div>



<div id="setting"><br /><div class="btn">
  <input name="submit_analytics" type="submit" value="<?=$LANG['SETTINGS_SAVE'];?>">
</div></div>

</form>
<? } ?><!-- Analytics Page -->




<? if($_GET['subaction'] == 'rss') { ?><!-- RSS Page -->
<? $submit_rss = $_POST['submit_rss'];
if($submit_rss) {
	$limit_rss = $_POST['limit_rss'];
	$rss_enable = $_POST['rss_enable'];
	if (!isset($rss_enable)) $rss_enable = 0;
		mysql_query("UPDATE settings SET limit_rss='$limit_rss', rss_enable='$rss_enable'"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action']."/".$_GET['subaction'];
		header('Location: '.$header_url.'');
}
?>
<form name="upload_action" action="" method="post">

<div id="setting">
<div class="field rss_feed">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_RSS_FEEDS'];?></label>
</div>
<label><input type="checkbox" name="rss_enable" value="1" <? if(rss_enable == '1') {?> checked<? }?>><font style="margin-left: 5px; position: relative; top: -1px;"><?=$LANG['SETTINGS_TURN_RSS_FEED'];?></font></label></div>

<div style="margin-top: 27px;"></div>

<div class="field website_name">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_RSS_LIMIT'];?></label>
<input type="text" name="limit_rss" value="<?=limit_rss;?>" style="width: 540px;border: 1px solid #ddd;">
</div>

<div style="margin-top: 27px;"></div>

<div class="field website_name">
<a style="margin-bottom: 5px; font-size: 14px; color: #00F; font-weight: bold;" href="<?=$settings['website_url']?>/rss" target="_blank"><?=$LANG['SETTINGS_RSS_FEED_URL'];?></a>
</div>

<div style="margin-top: 17px;"></div>

<div id="setting"><br /><div class="btn">
  <input name="submit_rss" type="submit" value="<?=$LANG['SETTINGS_SAVE'];?>">
</div></div>

</form>
<? } ?><!-- RSS Page -->






<? if($_GET['subaction'] == 'sitemap') { ?><!-- sitemap Page -->
<? $submit_sitemap = $_POST['submit_sitemap'];
if($submit_sitemap) {
	$sitemap_enable = $_POST['sitemap_enable'];
	if (!isset($sitemap_enable)) $sitemap_enable = 0;
		mysql_query("UPDATE settings SET sitemap_enable='$sitemap_enable'"); 
		//print success message. 
		$header_url = $root."/view/admin/".$_GET['action']."/".$_GET['subaction'];
		header('Location: '.$header_url.'');
}
?>
<form name="upload_action" action="" method="post">

<div id="setting">
<div class="field rss_feed">
<label style="margin-bottom: 5px; font-size: 16px;"><?=$LANG['SETTINGS_SITEMAPS_SETTINGS'];?></label>
</div>
<label><input type="checkbox" name="sitemap_enable" value="1" <? if(sitemap_enable == '1') {?> checked<? }?>><font style="margin-left: 5px; position: relative; top: -1px;"><?=$LANG['SETTINGS_TURN'];?> Sitemap.xml</font></label></div>
<div style="margin-top: 27px;"></div>

<div class="field website_name">
<a style="margin-bottom: 5px; font-size: 14px; color: #00F; font-weight: bold;" href="<?=$settings['website_url']?>/sitemap.xml" target="_blank">Sitemap.xml <?=$LANG['SETTINGS_URL'];?></a>
</div>

<div style="margin-top: 22px;"></div>

<div id="setting"><br /><div class="btn">
  <input name="submit_sitemap" type="submit" value="<?=$LANG['SETTINGS_SAVE'];?>">
</div></div>

</form>
<? } ?><!-- sitemap Page -->


</div>
</div>



</div>






</div>