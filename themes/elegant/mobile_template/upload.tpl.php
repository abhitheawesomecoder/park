<div style="width: 100%;overflow: hidden;">

<script type="text/javascript">
function actuateLink(link)
{
     window.location.href = link.href;
}
</script>
<style>
section .field {
width: 100%;
margin: 0 0 20px;
}
h2 {
margin: 0;
}
</style>
<div id="tabs" class="tabs">
				<nav>
					<ul>
						<li class="click_tab"><a href="#section-1"><span><?=$LANG['add_from_url_title'];?></span></a></li>
						<li class="click_tab"><a href="#section-2"><span><?=$LANG['upload_image_title'];?></span></a></li>
                        <li class="click_tab"><a href="#section-3"><span><?=$LANG['upload_video_title'];?></span></a></li>
					</ul>
				</nav>
				<div class="content" style="margin: 0; max-width: none;">
					<section id="section-1" style="max-width: none;padding: 1.5em 1.5em 0em 1em;">
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
						<div class="field photo"><input class="" type="url" name="url" placeholder="http://" value="<?=$_POST['url'];?><? if($_GET['post_url']) { echo $root."/uploads/meme_photos/".$_GET['post_url'].".jpg"; }?>" style="width: 100%;border: 1px solid #ddd; padding-right: 0px;"></div>
                        <div class="field title"><label><?=$LANG['Title_title'];?></label><p id="count_upload1" class="count "><?=char_in_desc;?></p>
							<textarea class="upload_textarea1" name="title" maxlength="<?=char_in_desc;?>" style="width: 100%; padding-right: 0px;"><?=$_POST['title'];?></textarea>
						</div>
                        <div class="field description"><label><?=$LANG['Description_title'];?></label>
							<textarea class="upload_textarea1" name="description" maxlength="<?=char_in_desc;?>" style="width: 100%; padding-right: 0px;"><?=$_POST['description'];?></textarea>
						</div>
                        <div class="field category">
                        	<select name="category" style="height: 36px;width: 100.9%;border-radius: 3px;border: 1px solid #ddd; padding-right: 0px;">
                        		<option><?=$LANG['Select_Category_title'];?>…</option>
                                <? $option_cat = get_option_cat(); 
								   foreach($option_cat as $option_cat): ?>
                        		<option value="<?=$option_cat['id']?>" <? if($_POST['category'] == $option_cat['id']) {?>selected<? }?>><? if($session_lang == 'de') { echo $option_cat['name']; } elseif($session_lang == 'en') { echo $option_cat['name_en']; } elseif($session_lang == 'th') { echo $option_cat['name_th']; } ?></option>
                                <? endforeach; ?>
                        	</select>
                        </div>
                        <div class="field checkbox"><label><input type="checkbox" name="source" onclick="showMe('text_source')"> <?=$LANG['Attribute_original_creator_title'];?></label>
						<div class="field source" id="text_source" style="display: none;"><input type="url" name="source" value="" placeholder="http://" style="width: 100%;border: 1px solid #ddd; padding-right: 0px;"></div>
						</div>
                        <div id="btn-container2"><input type="submit" name="submit_url" value="<?=$LANG['upload_title'];?>"></div>
                        </form>
                        
					</section>
					<section id="section-2" style="max-width: none;padding: 1.5em 1.5em 0em 1em;">
<?
$submit_image = $_POST['submit_image'];
if($submit_image) 
  {
				$rand = $rand;
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
		$media_type = 'pic';
	  	if($title && $category){
					if($SETTINGS['upload_type'] == 'pend') {
						$status = 'off';
					} elseif($SETTINGS['upload_type'] == 'auto') {
						$status = 'on';
					}
					
			for($i=0; $i < 11; $i++){
				$seed_second = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789');
				shuffle($seed_second);
				$rand_second = '';
				foreach (array_rand($seed_second, 30) as $ks) { $rand_second .= $seed_second[$ks]; }
				$ext = pathinfo($_FILES["photoimg"]["name"][$i], PATHINFO_EXTENSION);
				$tmp = $_FILES['photoimg']['tmp_name'][$i];
				$actual_image_name = $rand_second.".".$ext;
				$fileData = pathinfo(basename($_FILES["photoimg"]["name"][$i]));
				$file_name = $i.$_FILES['photoimg']['name'][$i];
				$file_size = $_FILES['photoimg']['size'][$i];
				$file_tmp = $_FILES['photoimg']['tmp_name'][$i];
				$file_type= $_FILES['photoimg']['type'][$i];
				$allowed =  array('gif','png' ,'jpg' ,'jpeg');
				$filename = $_FILES["photoimg"]["name"][$i];
				$ext2 = pathinfo($filename, PATHINFO_EXTENSION);
				if(in_array($ext2,$allowed)) {
					if(move_uploaded_file($_FILES["photoimg"]["tmp_name"][$i], $path.$rand_second.".".$ext)){
							mysql_query("INSERT INTO mouse_multiple (`post_id`,`file_name`,`file_size`,`file_type`) VALUES('".$rand."','$actual_image_name','$file_size','$file_type')");
					}
				}
			}

			$mouse_multiple_sql = mysql_query("SELECT * FROM mouse_multiple WHERE post_id = '".$rand."' LIMIT 1");
			$mouse_multiple = mysql_fetch_array($mouse_multiple_sql);
			
			$url_name = $mouse_multiple['file_name'];

			$result = mysql_query("INSERT INTO news (news_id, title, type, thumb, file, source, cat, author, description, date, status) 
                       VALUES ('".$rand."','".$title."','".$media_type."','".$name_media_gif."','".$url_name."','".$source."','".$category."','".$members['id']."','".$description."','".date("Y-m-d")."','".$status."')"); 
        		

        		//print success message. 
				header('Location: '.$settings['website_url'].'');
		} else {
					echo $LANG['sources_Please_Fill_Out_All_Required_Fields'].".";
		}
  }
?>
                    	<h2><?=$LANG['Post_a_fun_title'];?></h2>
                        <p class="Lead_Title" style="color:#999"><?=$LANG['Upload_funny_pictures'];?></p>
                        <form action="" enctype="multipart/form-data" method="POST">
						<div class="field photo"><div class="file-field"><input class="file text" type="file" name="photoimg[]" accept="image/gif,image/jpeg,image/jpg,image/png" multiple="multiple"></div></div>
                        <div class="field title"><label><?=$LANG['Title_title'];?></label><p id="count_upload2" class="count "><?=char_in_desc;?></p>
							<textarea class="upload_textarea2" name="img_title" maxlength="<?=char_in_desc;?>" style="width: 100%; padding-right: 0px;"><?=$_POST['img_title'];?></textarea>
						</div>
                        <div class="field img_description"><label><?=$LANG['Description_title'];?></label>
							<textarea class="upload_textarea1" name="img_description" maxlength="<?=char_in_desc;?>" style="width: 100%; padding-right: 0px;"><?=$_POST['img_description'];?></textarea>
						</div>
                        <div class="field category">
                        	<select name="img_category" style="height: 36px;width: 100.9%;border-radius: 3px;border: 1px solid #ddd;">
                        		<option><?=$LANG['Select_Category_title'];?>…</option>
                                <? $option_cat = get_option_cat(); 
								   foreach($option_cat as $option_cat): ?>
                        		<option value="<?=$option_cat['id']?>" <? if($_POST['img_category'] == $option_cat['id']) {?>selected<? }?>><? if($session_lang == 'de') { echo $option_cat['name']; } elseif($session_lang == 'en') { echo $option_cat['name_en']; } elseif($session_lang == 'th') { echo $option_cat['name_th']; } ?></option>
                                <? endforeach; ?>
                        	</select>
                        </div>
                        <div class="field checkbox"><label><input type="checkbox" name="source" onclick="showMe('text_source2')"> <?=$LANG['Attribute_original_creator_title'];?></label>
						<div class="field source" id="text_source2" style="display: none;"><input type="url" name="img_source" value="" placeholder="http://" style="width: 100%;border: 1px solid #ddd;padding-right:0px;"></div>
						</div>
                        <div id="btn-container2"><input type="submit" name="submit_image" value="<?=$LANG['upload_title'];?>"></div>
                        </form>
                        
					</section>
                    <section id="section-3" style="max-width: none;padding: 1.5em 1.5em 0em 1em;">
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
                        <p class="Lead_Title" style="color:#999">Upload funny videos, paste Youtube, Vimeo, or Vine URL</p>
                        <form name="upload_action" action="" method="post">
						<div class="field photo"><input class="" type="url" name="video_url" placeholder="http://" value="<?=$_POST['video_url'];?>" style="width: 100%;border: 1px solid #ddd;padding-right:0px;"></div>
                        <div class="field title"><label><?=$LANG['Title_title'];?></label><p id="count_upload1" class="count "><?=char_in_desc;?></p>
							<textarea class="upload_textarea1" name="video_title" maxlength="<?=char_in_desc;?>" style="width: 100%; padding-right: 0px;"><?=$_POST['video_title'];?></textarea>
						</div>
                        <div class="field video_description"><label><?=$LANG['Description_title'];?></label>
							<textarea class="upload_textarea1" name="video_description" maxlength="<?=char_in_desc;?>" style="width: 100%; padding-right: 0px;"><?=$_POST['video_description'];?></textarea>
						</div>
                        <div class="field category">
                        	<select name="video_category" style="height: 36px;width: 100.9%;border-radius: 3px;border: 1px solid #ddd;padding-right:0px;">
                        		<option><?=$LANG['Select_Category_title'];?>…</option>
                                <? $option_cat = get_option_cat(); 
								   foreach($option_cat as $option_cat): ?>
                        		<option value="<?=$option_cat['id']?>" <? if($_POST['video_category'] == $option_cat['id']) {?>selected<? }?>><? if($session_lang == 'de') { echo $option_cat['name']; } elseif($session_lang == 'en') { echo $option_cat['name_en']; } elseif($session_lang == 'th') { echo $option_cat['name_th']; } ?></option>
                                <? endforeach; ?>
                        	</select>
                        </div>
                        <div id="btn-container2"><input type="submit" name="submit_video" value="<?=$LANG['upload_title'];?>"></div>
                        </form>
                        
                        </section>
				</div><!-- /content -->
			</div><!-- /tabs -->
            
            
            


</div>