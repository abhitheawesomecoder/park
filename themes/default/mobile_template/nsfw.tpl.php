<? $cat_display = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_display_row = mysql_fetch_array($cat_display);
   if($cat_display_row['nsfw'] == '1') { ?>
<div style="border-top: 1px solid #C5C5C5;padding-top: 10px;"></div>
<div class="gif-post">
<div style="width: 100%;">
<h2 style="text-align:center;margin-top:100p;font-family: Helvetica;"><?=$LANG['TITLE_NSFW'];?>!</h2>
<p style="text-align:center;width: 100%;margin: 0 auto;padding-top: 40px;margin-bottom: 70px;"><?=$LANG['TITLE_NSFW_DESCRIPTION'];?></p>
<p style="text-align:center;margin-bottom:10px">
<a onclick="verify_age()" class="<?=$media['news_id'];?>" id="verify-age" style="color: #ffffff; background-color: #df2e1b; border-color: #cd2a19; padding: 10px 15px; border: 1px solid transparent; border-radius: 4px; cursor: pointer; position: relative; top: -10px;"><?=$LANG['TITLE_NSFW_BUTTON'];?></a>
</p>
</div>
</div>
<? } else { ?>
<? if($media['type'] == 'pic') { echo '<div class="gif-post"><img src='.$root."/uploads/media_photos/".$media['file'].' width="300" alt="'.$media['title'].'" title="'.$media['title'].'"></a></div>'; }
   if($media['type'] == 'gif') { echo '</a><div class="gif-post"><img class="gif-image animation" id='.$media['news_id'].' src='.$root."/uploads/media_photos/".$media['thumb'].' data-animation='.$root."/uploads/media_photos/".$media['file'].' data-original='.$root."/uploads/media_photos/".$media['thumb'].' data-state="0" width="300" /> <span class="play">GIF</span></div>'; }
   if($media['type'] == 'vid') { echo '<div class="gif-post"><img src='.$root."/uploads/media_photos/".$media['file'].' width="300"><span class="play_video">VIDEO</span></a></div>'; } ?>
<? } ?>