<? if(TURN_PAGES == '1') { ?>
<ul id="pages_ul">
  <? $SECTION['pages'] = mysql_query("SELECT * FROM pages WHERE status='on'");while($SECTION_pages_ROW = mysql_fetch_array($SECTION['pages'])) { ?>
  <li class="pages_li"><a href="<?=$root;?>/pages/<?=$SECTION_pages_ROW['page_id'];?>" class="pages_li_a"><?=$SECTION_pages_ROW['page_title'];?></a></li>
  <? } ?>
</ul>
<? } ?>
<font style="font-size: 14px; font-weight: bold; color: #000000;"><?=INDEX_PAGE_TITLE;?></font><font style="font-size: 18px; color: #2870DB; overflow: hidden;"></font>
<div style="margin-top: 10px;"></div>
<? $news = get_index_news(); ?>

<div id="container">



<? $i = 7;
foreach(array_slice($news, $startResults, $resultsPerPage) as $media): 
?>
<div class="box">
<a href="<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>">
<div class="box-media-title"><?=$media['title']?></div>
<? $cat_display = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_display_row = mysql_fetch_row($cat_display);
   if(($_COOKIE['age'] || $_COOKIE['age'] == '1')) {  ?>

<? if($media['type'] == 'pic') { echo '<div class="gif-post"><img src='.$root."/uploads/media_photos/".$media['file'].' width="'.$box_type.'" alt="'.$media['title'].'" title="'.$media['title'].'"></a></div>'; }
   if($media['type'] == 'gif') { echo '</a><div class="gif-post"><img class="gif-image animation" id='.$media['news_id'].' src='.$root."/uploads/media_photos/".$media['thumb'].' data-animation='.$root."/uploads/media_photos/".$media['file'].' data-original='.$root."/uploads/media_photos/".$media['thumb'].' data-state="0" width="'.$box_type.'" /> <span class="play">GIF</span></div>'; }
   if($media['type'] == 'vid') { echo '<div class="gif-post"><img src='.$root."/uploads/media_photos/".$media['file'].' width="'.$box_type.'"><span class="play_video">VIDEO</span></a></div>'; } ?>

<? if(SHARE_SOCIAL_NETWORK_TURN == '1') { ?>
<div class="share">
<ul>
    <li><a class="btn-share facebook" onclick="javascript:fbshare('<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>')">Facebook</a></li>
    <li><a class="btn-share twitter" onclick="javascript:twittershare('<?=$media['title']?>','<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>')" data_title="<?=$media['title']?>">Twitter</a></li>
    <li><a class="btn-share google" onclick="javascript:googleshare('<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>')" data_title="<?=$media['title']?>">Google</a></li>
</ul>
</div>
<? } ?>
<? } else {
		include('nsfw.tpl.php');
   } ?>


</div>

<? if ($i % 4 == 0) { echo "<div class='box' style='width: ".$box_type."px; border: 1px solid #CCC; border-radius: 3px; float: left; background: #E8E8E8;'>".ADVERT_IN_CAT."</div>"; } ?>

<? $i++;
endforeach; ?>

</div>

<!-- contains the content to be loaded when scrolled -->
<nav id="page-nav">
<? if($_GET['page'] = '') { $page=$_GET['page']; } else { $page='1'; } ?>
  <a href="<?=$root;?>/?view=index&page=<?=$page+1;?>"></a>
</nav>