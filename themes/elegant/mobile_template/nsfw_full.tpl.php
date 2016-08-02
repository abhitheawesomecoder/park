<? if($cat_display_row['3'] == '1') { ?>
<div style="border-top: 1px solid #C5C5C5;padding-top: 10px;"></div>
<div class="gif-post">
<div style="width: 100%;">
<h2 style="text-align:center;margin-top:100p;font-family: Helvetica;">NSFW!</h2>
<p style="text-align:center;width: 100%;margin: 0 auto;padding-top: 40px;margin-bottom: 70px;">This content is NSFW and has been locked, please confirm your age to see the content</p>
<p style="text-align:center;margin-bottom:10px">
<a onclick="verify_age()" class="<?=$media['news_id'];?>" id="verify-age" style="color: #ffffff; background-color: #df2e1b; border-color: #cd2a19; padding: 10px 15px; border: 1px solid transparent; border-radius: 4px; cursor: pointer; position: relative; top: -10px;">Yes, I am over 18</a>
</p>
</div>
</div>
<? } else { ?>
<?
   if($media['type'] == 'pic') { 
      $media_photos = mysql_query("SELECT * FROM mouse_multiple WHERE post_id='".$media['news_id']."' ORDER BY media_id ASC");
      while($media_photo = mysql_fetch_array($media_photos)) {
        echo '<img src='.$root."/uploads/media_photos/".$media_photo['file_name'].' width="630" alt="'.$media['title'].'" title="'.$media['title'].'" style="margin-top: 5px;">';
      }
    }
   if($media['type'] == 'gif') { echo '<img src='.$root."/uploads/media_photos/".$media['file'].' width="630">'; }
   if($media['type'] == 'vid') { echo(get_video_mobile_code($media['thumb'])); }
?>
<? } ?>