<font style="color: #2701EC;letter-spacing: 15px;position: relative;margin-left: 82px;top: -15px;font-size: 100px;font-family: 'Freight Sans Bold', 'lucida grande',tahoma,verdana,arial,sans-serif;"><?=$LANG['UPLOAD_title'];?></font>
<div style="margin-top: -10px;"></div>
<div style="width: 650px;overflow: hidden;">

<script type="text/javascript">
function actuateLink(link)
{
     window.location.href = link.href;
}
</script>
<div id="tabs" class="tabs">
				<nav>
					<ul>
						<li class="click_tab"><a href="#section-1"><span><?=$LANG['add_from_url_title'];?></span></a></li>
						<li class="click_tab"><a href="#section-2"><span><?=$LANG['upload_image_title'];?></span></a></li>
                        <li class="click_tab"><a href="#section-3"><span><?=$LANG['upload_video_title'];?></span></a></li>
						<li><a href="<?=$root;?>/view/meme/"><span><?=$LANG['make_meme_title'];?></span></a></li>
					</ul>
				</nav>
				<div class="content">
					<section id="section-1">
<?
$submit = $_POST['submit_url'];
if($submit) 
  {
	  $url = filter(mysql_real_escape_string($_POST['url'])); 
      $title = filter(mysql_real_escape_string($_POST['title'])); 
	  $url = filter($_POST['url']);
	  $category = filter($_POST['category']);
	  $source = filter($_POST['source']);
	  $description = filter(mysql_real_escape_string($_POST['description']));
	  
	  $name = basename($url);
	  list($txt, $ext) = explode(".", $name);
	  $name = $txt.time();
	  $name_gif = $txt.time();
	  $name = $name.".".$ext;
	  	if($ext == "jpg" or $ext == "jpeg" or $ext == "png"){
			$media_type = "pic";
	  	} elseif($ext == "gif") {
	    	$media_type = "gif";
			$name_media_gif = $name.".jpg";
		}
				$upload = uploadImageFromURL($url, $name_gif);
if($upload) {
	  			if($title && $media_type && $name && $category){
					if($SETTINGS['upload_type'] == 'pend') {
						$status = 'off';
					} elseif($SETTINGS['upload_type'] == 'auto') {
						$status = 'on';
					}
					$result = mysql_query("INSERT INTO news (news_id, title, type, thumb, file, source, cat, author, description, date, status) 
                       VALUES ('".$rand."','".$title."','".$media_type."','".$name_media_gif."','".$name."','".$source."','".$category."','".$members['id']."','".$description."','".date("Y-m-d")."','".$status."')"); 
        		    //print success message.
				    header('Location: '.$settings['website_url'].'');
				} else {
					echo $LANG['sources_Please_Fill_Out_All_Required_Fields'].".";
					
				}
}
  }
?>
                    	<h2><?=$LANG['Post_a_fun_title'];?></h2>
                        <p class="Lead_Title" style="color:#999"><?=$LANG['Upload_funny_pictures'];?></p>
                        <form name="upload_action" action="" method="post">
                        <? if($_GET['post_url']) { echo "<img src='".$root."/uploads/meme_photos/".$_GET['post_url'].".jpg"."' width='200'>"; }?>
						<div class="field photo"><input class="" type="url" name="url" placeholder="http://" value="<?=$_POST['url'];?><? if($_GET['post_url']) { echo $root."/uploads/meme_photos/".$_GET['post_url'].".jpg"; }?>" style="width: 540px;border: 1px solid #ddd;"></div>
                        <div class="field title"><label><?=$LANG['Title_title'];?></label><p id="count_upload1" class="count "><?=char_in_desc;?></p>
							<textarea class="upload_textarea1" name="title" maxlength="<?=char_in_desc;?>"><?=$_POST['title'];?></textarea>
						</div>
                        <div class="field description"><label><?=$LANG['Description_title'];?></label>
							<textarea class="upload_textarea1" name="description" maxlength="<?=char_in_desc;?>"><?=$_POST['description'];?></textarea>
						</div>
                        <div class="field category">
                        	<select name="category" style="height: 36px;width: 560px;border-radius: 3px;border: 1px solid #ddd;">
                        		<option><?=$LANG['Select_Category_title'];?>…</option>
                                <? $option_cat = get_option_cat(); 
								   foreach($option_cat as $option_cat): ?>
                        		<option value="<?=$option_cat['id']?>" <? if($_POST['category'] == $option_cat['id']) {?>selected<? }?>><?=$option_cat['name']?></option>
                                <? endforeach; ?>
                        	</select>
                        </div>
                        <div class="field checkbox"><label><input type="checkbox" name="source" onclick="showMe('text_source')"> <?=$LANG['Attribute_original_creator_title'];?></label>
						<div class="field source" id="text_source" style="display: none;"><input type="url" name="source" value="" placeholder="http://" style="width: 540px;border: 1px solid #ddd;"></div>
						</div>
                        <div id="btn-container2"><input type="submit" name="submit_url" value="<?=$LANG['upload_title'];?>"></div>
                        </form>
                        
					</section>
					<section id="section-2">
<?
$submit_image = $_POST['submit_image'];
if($submit_image) 
  {
	  $url_post = mysql_real_escape_string($_POST['img_url']); 
	  $title = mysql_real_escape_string($_POST['img_title']); 
	  $url = $_POST['img_url'];
	  $category = $_POST['img_category'];
	  $source = $_POST['img_source'];
	  $description = mysql_real_escape_string($_POST['img_description']);

        $path = "uploads/media_photos/";
		$valid_formats = array("jpg", "jpeg", "png", "gif");
		$name = $_FILES['photoimg']['name'];
		$tmp_name = $_FILES['photoimg']['tmp_name'];
		$size = $_FILES['photoimg']['size'];
		

		if(strlen($name))
		{
			$ext = end(explode(".",strtolower($name)));
						$tmp = $_FILES['photoimg']['tmp_name'];
						$actual_image_name = time().".".$ext;
						if($ext == "jpg" or $ext == "jpeg" or $ext == "png"){
								$media_type = "pic";
						} elseif($ext == "gif") {
								$media_type = "gif";
								$img = imagecreatefromstring(file_get_contents($tmp));
								if ($img !== false)
								imagejpeg($img, "uploads/media_photos/$actual_image_name.jpg");
								$name_media_gif = $actual_image_name.".jpg";
						}
						
if(move_uploaded_file($tmp, $path.$actual_image_name)) {
	  			if($title && $media_type && $actual_image_name && $category){
					if($SETTINGS['upload_type'] == 'pend') {
						$status = 'off';
					} elseif($SETTINGS['upload_type'] == 'auto') {
						$status = 'on';
					}
					$result = mysql_query("INSERT INTO news (news_id, title, type, thumb, file, source, cat, author, description, date, status) 
                       VALUES ('".$rand."','".$title."','".$media_type."','".$name_media_gif."','".$actual_image_name."','".$source."','".$category."','".$members['id']."','".$description."','".date("Y-m-d")."','".$status."')"); 
        		//print success message. 
				header('Location: '.$settings['website_url'].'');
				} else {
					echo $LANG['sources_Please_Fill_Out_All_Required_Fields'].".";
				}
	 }
		}
  }
?>
                    	<h2><?=$LANG['Post_a_fun_title'];?></h2>
                        <p class="Lead_Title" style="color:#999"><?=$LANG['Upload_funny_pictures'];?></p>
                        <form action="" enctype="multipart/form-data" method="POST">
						<div class="field photo"><div class="file-field"><input class="file text" type="file" name="photoimg" accept="image/gif,image/jpeg,image/jpg,image/png"></div></div>
                        <div class="field title"><label><?=$LANG['Title_title'];?></label><p id="count_upload2" class="count "><?=char_in_desc;?></p>
							<textarea class="upload_textarea2" name="img_title" maxlength="<?=char_in_desc;?>"><?=$_POST['img_title'];?></textarea>
						</div>
                        <div class="field img_description"><label><?=$LANG['Description_title'];?></label>
							<textarea class="upload_textarea1" name="img_description" maxlength="<?=char_in_desc;?>"><?=$_POST['img_description'];?></textarea>
						</div>
                        <div class="field category">
                        	<select name="img_category" style="height: 36px;width: 560px;border-radius: 3px;border: 1px solid #ddd;">
                        		<option><?=$LANG['Select_Category_title'];?>…</option>
                                <? $option_cat = get_option_cat(); 
								   foreach($option_cat as $option_cat): ?>
                        		<option value="<?=$option_cat['id']?>" <? if($_POST['img_category'] == $option_cat['id']) {?>selected<? }?>><?=$option_cat['name']?></option>
                                <? endforeach; ?>
                        	</select>
                        </div>
                        <div class="field checkbox"><label><input type="checkbox" name="source" onclick="showMe('text_source2')"> <?=$LANG['Attribute_original_creator_title'];?></label>
						<div class="field source" id="text_source2" style="display: none;"><input type="url" name="img_source" value="" placeholder="http://" style="width: 540px;border: 1px solid #ddd;"></div>
						</div>
                        <div id="btn-container2"><input type="submit" name="submit_image" value="<?=$LANG['upload_title'];?>"></div>
                        </form>
                        
					</section>
                    <section id="section-3">
<?
$submit_video = $_POST['submit_video'];
if($submit_video) 
  {
	  $media = http_decode(trim($_POST['video_url']));
	  $type = getdomain($media);
      $title = mysql_real_escape_string($_POST['video_title']); 
	  $category = $_POST['video_category'];
	  $source = $_POST['video_source'];
	  $description = mysql_real_escape_string($_POST['video_description']);
	  if($source == ""){ $source = getdomain($media); }
	  if($type=="youtube.com") {
		    $media_type = "vid";
			$url=get_youtube_photo($media);
	  }
	  else if($type=="vimeo.com") {
		    $media_type = "vid";
			$url=get_vimeo_photo($media);
	  }
	  else if($type=="vine.co") {
		    $media_type = "vid";
			$url=get_vine_photo($media);
	  }
	  
	  $name = basename($url);
	  list($txt, $ext) = explode(".", $name);
	  $name = $txt.time();
	  $name = $name.".".$ext;
				
	  $upload = file_put_contents("uploads/media_photos/$name",file_get_contents($url));		
				
				
if($upload) {
	  			if($title && $media_type && $name && $category){
					if($SETTINGS['upload_type'] == 'pend') {
						$status = 'off';
					} elseif($SETTINGS['upload_type'] == 'auto') {
						$status = 'on';
					}
					$result = mysql_query("INSERT INTO news (news_id, title, type, thumb, file, source, cat, author, description, date, status) 
                       VALUES ('".$rand."','".$title."','vid','".$media."','".$name."','".$source."','".$category."','".$members['id']."','".$description."','".date("Y-m-d")."','".$status."')"); 
        		//print success message.
					header('Location: '.$settings['website_url'].'');
				} else {
					echo $LANG['sources_Please_Fill_Out_All_Required_Fields'].".";
				}
	  }
  }
?>
                    	<h2><?=$LANG['Post_a_fun_title'];?></h2>
                        <p class="Lead_Title" style="color:#999"><?=$LANG['Upload_funny_videos'];?></p>
                        <form name="upload_action" action="" method="post">
						<div class="field photo"><input class="" type="url" name="video_url" placeholder="http://" value="<?=$_POST['video_url'];?>" style="width: 540px;border: 1px solid #ddd;"></div>
                        <div class="field title"><label><?=$LANG['Title_title'];?></label><p id="count_upload1" class="count "><?=char_in_desc;?></p>
							<textarea class="upload_textarea1" name="video_title" maxlength="<?=char_in_desc;?>"><?=$_POST['video_title'];?></textarea>
						</div>
                        <div class="field video_description"><label><?=$LANG['Description_title'];?></label>
							<textarea class="upload_textarea1" name="video_description" maxlength="<?=char_in_desc;?>"><?=$_POST['video_description'];?></textarea>
						</div>
                        <div class="field category">
                        	<select name="video_category" style="height: 36px;width: 560px;border-radius: 3px;border: 1px solid #ddd;">
                        		<option><?=$LANG['Select_Category_title'];?>…</option>
                                <? $option_cat = get_option_cat(); 
								   foreach($option_cat as $option_cat): ?>
                        		<option value="<?=$option_cat['id']?>" <? if($_POST['video_category'] == $option_cat['id']) {?>selected<? }?>><?=$option_cat['name']?></option>
                                <? endforeach; ?>
                        	</select>
                        </div>
                        <div id="btn-container2"><input type="submit" name="submit_video" value="<?=$LANG['upload_title'];?>"></div>
                        </form>
                        
                        </section>
				</div><!-- /content -->
			</div><!-- /tabs -->
            
            
            


</div>