<?
$cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { $permalink = "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { $permalink = "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $permalink = "/".$cat_row."/".slugify($media['title']); }
$cat_query2 = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row2 = mysql_fetch_row($cat_query2); if($cat_row2['2'] == '') { $cat_row2 = 'other'; }else{ $cat_row2=$cat_row2['2']; } if($SETTINGS['permalink'] == 'gag') { $permalink2 = "/gag/".$next_media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { $permalink2 = "/".$cat_row."/".$next_media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $permalink2 = "/".$cat_row."/".slugify($next_media['title']); }
?>
<div style="width: 630px;">
<h2 style="font-size: 26px; line-height: 1.3em; margin-bottom: 7px; font-family: Arial,Helvetica,Geneva,sans-serif;"><?=$media['title'];?></h2>

<? $domain = $root.$permalink; $CommentQuery = mysql_query("SELECT * FROM comments WHERE domain = '".$domain."'");$effective_comments = mysql_num_rows($CommentQuery);$q = "SELECT * FROM votes WHERE news_id = '".$media['id']."'";$r = mysql_query($q);$effective_vote = mysql_num_rows($r);?>
<span class='votes_count' id='votes_count<?php echo $media['id']; ?>'><?php echo $effective_vote." ".$LANG['points_title'].""; ?></span> 
 ·
<a class="comments_num" href="#site">
<span><?=$effective_comments?></span> <?=$LANG['comments_title'];?></a>
<br />

<div id="fixed-toolbar" style="background: #fff; width: 630px; z-index: 999999;padding: 10px 0px;"><div style="">

<ul class="horizontal-vote <? $query_distinct = mysql_query("SELECT * FROM votes WHERE news_id='".$media['id']."' AND user_id='".$members['id']."'");
if (mysql_num_rows($query_distinct) ){ echo "up"; } else { } ?>" id='vote_buttons<?php echo $media['id']; ?>'>
    <li><a class="up" href='javascript:;' id='<?=$media['id'];?>' user_id='<?=$members['id'];?>'><span>UP</span></a></li>
    <li><a class="down" href='javascript:;' id='<?=$media['id'];?>' user_id='<?=$members['id'];?>'><span>DOWN</span></a></li>
</ul>
<? if(SHARE_SOCIAL_NETWORK_TURN == '1') { ?>
<div class="share">
<ul>
    <li><a class="btn-share facebook" onclick="javascript:fbshare('<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>')">Facebook</a></li>
    <li><a class="btn-share twitter" onclick="javascript:twittershare('<?=$media['title']?>','<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>')" data_title="<?=$media['title']?>">Twitter</a></li>
    <li><a class="btn-share google" onclick="javascript:googleshare('<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>')" data_title="<?=$media['title']?>">Google</a></li>
</ul>
</div>
<? } ?>
<div class="post-nav">
<a class="next" href="<? if($next_media['news_id'] == '') { echo ""; } else { echo $root.$permalink2; } ?>"><span class="label"><?=$LANG['next_post_title'];?></span><span class="arrow"></span></a>
</div>

</div></div><br /><br />
<? $cat_display = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_display_row = mysql_fetch_row($cat_display);
   if(($_COOKIE['age'] || $_COOKIE['age'] == '1')) { ?>

<?
   if($media['type'] == 'pic') { echo '<img src='.$root."/uploads/media_photos/".$media['file'].' width="630" alt="'.$media['title'].'" title="'.$media['title'].'">'; }
   if($media['type'] == 'gif') { echo '<img src='.$root."/uploads/media_photos/".$media['file'].' width="630">'; }
   if($media['type'] == 'vid') { echo(get_video_code($media['thumb'])); }
?>

<br />

<? if($media['description'] == '') { }else{ echo "<div style='margin-top: 5px; margin-bottom:5px;'>".LINKS_CLICKABLE($media['description'])."</div>"; } ?>

<? } else {
		include('nsfw_full.tpl.php');
   } ?>

<div class="post-afterbar-meta">
<? $extra_menu = mysql_query("SELECT * FROM users WHERE id='".$media['author']."'");
   $remove_button = mysql_fetch_array($extra_menu); ?>
<p><?=$media['date']?> <?=$LANG['by_title'];?> <a href="<?=$root;?>/u/<?=str_replace(' ', '.', urldecode($remove_button['username']));?>" target="_blank"><?=$remove_button['username'];?></a>
<? if($remove_button['id'] == $members['id']) { ?>
· <a class="" href="<?=$root;?>/gag/delete/<?=$media['news_id'];?>" onclick="return confirm('<?=$LANG['confirm_to_delete_this_post'];?>');"><?=$LANG['delete_title'];?></a>
<? }?>
</p></div>

<? if(COMMENTS_TURN == '1') { ?>
<div id="comments_form">
<div class="comments_navigation">
<div class="comments_option">
<ul>
<li><a class="comments-option site selected" data-comments="#site" href="javascript:void(0);"><?=$LANG['comments_title'];?> (<span class="badge-item-comment-count"><?=$effective_comments;?></span>)</a></li>
<li><a class="comments-option facebook" data-comments="#facebook" href="javascript:void(0);">Facebook <?=$LANG['comments_title'];?> (<span class="badge-item-fb-comment-count"><fb:comments-count href="<?=$root."/gag/".$media['news_id']?>"></fb:comments-count></span>)</a></li>

</ul>
</div>
</div>

<div id="site" class="post-comment">
<span style="width: 630px;">
<div id="nis-comments" width="631" href="<? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query);  if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { $link = "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { $link = "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $link = "/".$cat_row."/".slugify($media['title']); } echo $root.$link; ?>" user_id="<?=$members['id'];?>" news_id="<?=$media['id']?>" news_num="500" nis_key="278394375505800"></div>
</span>
</div></div>

<div id="facebook" class="post-comment" style="display:none"><div class="fb_iframe_widget">
<span style="height: 160px; width: 630px;">
<div class="fb-comments" data-href="<?=$root.$link;?>" data-width="630" data-numposts="5" data-colorscheme="light"></div>
</span>
</div>

</div>
<? } ?>





</div>