<?
$cat_query2 = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row2 = mysql_fetch_row($cat_query2); if($cat_row2['2'] == '') { $cat_row2 = 'other'; }else{ $cat_row2=$cat_row2['2']; } if($SETTINGS['permalink'] == 'gag') { $permalink2 = "/gag/".$next_media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { $permalink2 = "/".$cat_row2."/".$next_media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $permalink2 = "/".$cat_row2."/".slugify($next_media['title']); }
$cat_query3 = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row3 = mysql_fetch_row($cat_query3); if($cat_row3['2'] == '') { $cat_row3 = 'other'; }else{ $cat_row3=$cat_row3['2']; } if($prev_media['news_id'] == '') { $if_prev=$id; } if($SETTINGS['permalink'] == 'gag') { $permalink3 = "/gag/".$prev_media['news_id'].$if_prev; } elseif($SETTINGS['permalink'] == 'cat') { $permalink3 = "/".$cat_row3."/".$prev_media['news_id'].$if_prev; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $permalink3 = "/".$cat_row3."/".slugify($prev_media['title']).$if_prev; }
$cat_query4 = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row4 = mysql_fetch_row($cat_query4); if($cat_row4['2'] == '') { $cat_row4 = 'other'; }else{ $cat_row4=$cat_row4['2']; } if($prev_media['news_id'] == '') { $if_prev=$id; } if($SETTINGS['permalink'] == 'gag') { $permalink4 = "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { $permalink4 = "/".$cat_row4."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $permalink4 = "/".$cat_row4."/".slugify($media['title']); }
?>
<ul class="big-list">
<li class="article">
<h2><a href="<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>"><?=$media['title']?></a></h2>
<div class="post-container"><a>
<? $cat_display = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_display_row = mysql_fetch_row($cat_display);
   if(($_COOKIE['age'] || $_COOKIE['age'] == '1')) { ?>

<? if($media['type'] == 'pic') { echo '<div class="gif-post"><img src='.$root."/uploads/media_photos/".$media['file'].' width="300" alt="'.$media['title'].'" title="'.$media['title'].'"></a></div>'; }
   if($media['type'] == 'gif') { echo '</a><div class="gif-post"><img class="gif-image animation" id='.$media['news_id'].' src='.$root."/uploads/media_photos/".$media['thumb'].' data-animation='.$root."/uploads/media_photos/".$media['file'].' data-original='.$root."/uploads/media_photos/".$media['thumb'].' data-state="0" width="300" /> <span class="play">GIF</span></div>'; }
   if($media['type'] == 'vid') { echo(get_video_code($media['thumb'])); } ?>

<? } else {
		include('nsfw_full.tpl.php');
   } ?>
   
<a class="page-turn next" href="<? if($next_media['news_id'] == '') { echo ""; } else { echo $root.$permalink2; } ?>" style="opacity: 1;" data-dir="next"><span>▶</span></a>
<a class="page-turn prev" href="<? if($next_media['news_id'] == '') { echo ""; } else { echo $root.$permalink3; } ?>" style="opacity: 1;" data-dir="prev"><span class="rotate-180">▶</span></a>

</div><!--end .post-continaer-->
<div class="post-function">
<? if(SHARE_SOCIAL_NETWORK_TURN == '1') { ?>
<ul class="social">
<li><a class="share facebook" onclick="javascript:fbshare('<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>')">Facebook</a></li>
<li><a class="share twitter" onclick="javascript:twittershare('<?=$media['title']?>','<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>')">Twitter</a></li>
</ul>
<? } ?>
<ul class="horizontal-vote <? $query_distinct = mysql_query("SELECT * FROM votes WHERE news_id='".$media['id']."' AND user_id='".$members['id']."'");
if (mysql_num_rows($query_distinct) ){ echo "up"; } else { } ?>" id='vote_buttons<?php echo $media['id']; ?>'>
    <li><a class="up" href='javascript:;' id='<?=$media['id'];?>' user_id='<?=$members['id'];?>'><span>UP</span></a></li>
    <li><a class="down" href='javascript:;' id='<?=$media['id'];?>' user_id='<?=$members['id'];?>'><span>DOWN</span></a></li>
</ul>
</div><!--end post-function-->

<div class="post-stats">
<p>
<? $domain = $root.$permalink4;$CommentQuery = mysql_query("SELECT * FROM comments WHERE domain = '".$domain."'");$effective_comments = mysql_num_rows($CommentQuery);$q = "SELECT * FROM votes WHERE news_id = '".$media['id']."'";$r = mysql_query($q);$effective_vote = mysql_num_rows($r);?>
<span class='votes_count' id='votes_count<?php echo $media['id']; ?>'><?php echo $effective_vote." points"; ?></span> 
</p><br>
</div>

</li>
<br />
<? if($media['description'] == '') { }else{ echo "<div style='margin-left: 5px; margin-top: 5px; margin-bottom:5px;'>".$media['description']."</div>"; } ?>

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
<li><a class="comments-option facebook" data-comments="#facebook" href="javascript:void(0);">Facebook <?=$LANG['comments_title'];?> (<span class="badge-item-fb-comment-count"><fb:comments-count href="<?=$root.$permalink4;?>"></fb:comments-count></span>)</a></li>

</ul>
</div>
</div>

<div id="site" class="post-comment">
<span style="width: 630px;">
<div id="nis-comments" width="100%" href="<? echo $root.$permalink4; ?>" user_id="<?=$members['id'];?>" news_id="<?=$media['id']?>" news_num="500" nis_key="278394375505800"></div>
</span>
</div></div>

<div id="facebook" class="post-comment" style="display:none"><div class="fb_iframe_widget">
<span id="fbcomments" style="">
<div class="fb-comments" data-href="<?=$root.$permalink4;?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
</span>
</div>

</div>
<? } ?>
</ul>