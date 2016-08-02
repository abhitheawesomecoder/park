<? if($_GET['subaction'] == '') { ?> <!-- POSTS -->
<ul class="big-list">
<? $user_news = get_profile_user_news($_GET['profile']); ?>
<? $i = 7;
   foreach(array_slice($user_news, $startResults, $resultsPerPage) as $media): 
   $query_user = mysql_query("SELECT * FROM users WHERE id='".$media['author']."'"); while($user_media = mysql_fetch_array($query_user)) { $first_name = $user_media['first_name']; $last_name = $user_media['last_name']; }
?>
<li class="article">
<h2><a href="<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>"><?=$media['title']?></a></h2>
<div class="post-container"><a href="<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>">
<? $cat_display = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_display_row = mysql_fetch_row($cat_display);
   if(($_COOKIE['age'] || $_COOKIE['age'] == '1')) {  ?>
   
<? if($media['type'] == 'pic') { echo '<div class="gif-post"><img src='.$root."/uploads/media_photos/".$media['file'].' width="300" alt="'.$media['title'].'" title="'.$media['title'].'"></a></div>'; }
   if($media['type'] == 'gif') { echo '</a><div class="gif-post"><img class="gif-image animation" id='.$media['news_id'].' src='.$root."/uploads/media_photos/".$media['thumb'].' data-animation='.$root."/uploads/media_photos/".$media['file'].' data-original='.$root."/uploads/media_photos/".$media['thumb'].' data-state="0" width="300" /> <span class="play">GIF</span></div>'; }
   if($media['type'] == 'vid') { echo '<div class="gif-post"><img src='.$root."/uploads/media_photos/".$media['file'].' width="300"><span class="play_video">VIDEO</span></a></div>'; } ?>

<? } else {
		include('nsfw.tpl.php');
   } ?>
   
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
<? $domain = $root."/gag/".$media['news_id']."";$CommentQuery = mysql_query("SELECT * FROM comments WHERE domain = '".$domain."'");$effective_comments = mysql_num_rows($CommentQuery);$q = "SELECT * FROM votes WHERE news_id = '".$media['id']."'";$r = mysql_query($q);$effective_vote = mysql_num_rows($r);?>
<span class='votes_count' id='votes_count<?php echo $media['id']; ?>'><?php echo $effective_vote." ".$LANG['TITLE_POINTS']; ?></span> 
</p>
</div>


</li>

<? if(mobile_small_advert_turn == '1') { ?>
<? if ($i % 4 == 0) { echo "<li class='article'><div class='box' style='width: 100%; border: 1px solid #CCC; border-radius: 3px; float: left; margin-left: -6px; margin-bottom: 18px; background: #E8E8E8;'>".mobile_small_advert."</div></li><br>"; } ?>
<? } ?>

<? $i++;
endforeach; ?>
</ul>


<? 
$result_posts = mysql_query("SELECT n.id,n.news_id,n.title,n.type,n.thumb,n.file,n.cat,n.status,n.author FROM news n WHERE n.author='".$Users['0']."' ORDER BY id DESC");

if (mysql_num_rows($result_posts)==0) {?>
<div class="blank-state">
        <h3><?=$LANG['posts_show_up'];?> <?=$Users['6']?> <?=$Users['7']?> <?=$LANG['uploaded_will_show_up_here'];?></h3>
        <div class="btn-container" style="text-align: center; width: auto;"><a class="btn" href="<?=$root?>/view/popular"><?=$LANG['checkout_whats_hot'];?></a></div>
</div>
<? } else { ?>
<!-- contains the content to be loaded when scrolled -->
<div class="cat_ias_trigger">
<? $page = isset($_GET['page']) ? (int) $_GET['page'] : 1; ?>
  <a href="<?=$root;?>/?view=account&action=profile&subaction=&profile=<?=$_GET['profile']?>&page=<?=$page+1;?>">Load More Posts ...</a>
</div><br />
<? } ?>

<? } ?> <!-- POSTS -->




<? if($_GET['subaction'] == 'upvotes') { ?> <!-- UPVOTES -->
<ul class="big-list">
<? $news = get_profile_news($_GET['profile']); ?>
<? $i = 7;
   foreach(array_slice($news, $startResults, $resultsPerPage) as $media): 
   $query_user = mysql_query("SELECT * FROM users WHERE id='".$media['user_id']."'"); while($user_media = mysql_fetch_array($query_user)) { $first_name = $user_media['first_name']; $last_name = $user_media['last_name']; }
?>
<li class="article">
<h2><a href="<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>"><?=$media['title']?></a></h2>
<div class="post-container"><a href="<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>">
<? $cat_display = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_display_row = mysql_fetch_row($cat_display);
   if(($_COOKIE['age'] || $_COOKIE['age'] == '1')) {  ?>
   
<? if($media['type'] == 'pic') { echo '<div class="gif-post"><img src='.$root."/uploads/media_photos/".$media['file'].' width="300" alt="'.$media['title'].'" title="'.$media['title'].'"></a></div>'; }
   if($media['type'] == 'gif') { echo '</a><div class="gif-post"><img class="gif-image animation" id='.$media['news_id'].' src='.$root."/uploads/media_photos/".$media['thumb'].' data-animation='.$root."/uploads/media_photos/".$media['file'].' data-original='.$root."/uploads/media_photos/".$media['thumb'].' data-state="0" width="300" /> <span class="play">GIF</span></div>'; }
   if($media['type'] == 'vid') { echo '<div class="gif-post"><img src='.$root."/uploads/media_photos/".$media['file'].' width="300"><span class="play_video">VIDEO</span></a></div>'; } ?>

<? } else {
		include('nsfw.tpl.php');
   } ?>
   
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
<? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat']."");if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } $cat_row = mysql_fetch_row($cat_query); if($SETTINGS['permalink'] == 'gag') { $link = "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { $link = "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $link = "/".$cat_row."/".slugify($media['title']); } $domain = $root.$link; $CommentQuery = mysql_query("SELECT * FROM comments WHERE domain = '".$domain."'");$effective_comments = mysql_num_rows($CommentQuery);$q = "SELECT * FROM votes WHERE news_id = '".$media['id']."'";$r = mysql_query($q);$effective_vote = mysql_num_rows($r);?>
<span class='votes_count' id='votes_count<?php echo $media['id']; ?>'><?php echo $effective_vote." ".$LANG['TITLE_POINTS']; ?></span> 
</p>
</div>


</li>
<? if(mobile_small_advert_turn == '1') { ?>
<? if ($i % 4 == 0) { echo "<li class='article'><div class='box' style='width: 100%; border: 1px solid #CCC; border-radius: 3px; float: left; margin-left: -6px; margin-bottom: 18px; background: #E8E8E8;'>".mobile_small_advert."</div></li><br>"; } ?>
<? } ?>

<? $i++;
endforeach; ?>
</ul>


<? 
$result_upvotes = mysql_query("SELECT v.news_id,v.user_id,n.id,n.news_id,n.title,n.type,n.thumb,n.file,n.cat,n.status FROM votes v, news n WHERE v.news_id = n.id AND v.user_id='".$Users['0']."' ORDER BY id DESC");

if (mysql_num_rows($result_upvotes)==0) {?>
<div class="blank-state">
        <h3><?=$LANG['posts_show_up'];?> <?=$Users['6']?> <?=$Users['7']?> <?=$LANG['upvoted_will_show_up_here'];?></h3>
        <div class="btn-container" style="text-align: center; width: auto;"><a class="btn" href="<?=$root?>/view/popular"><?=$LANG['checkout_whats_hot'];?></a></div>
</div>
<? } else { ?>
<!-- contains the content to be loaded when scrolled -->
<div class="cat_ias_trigger">
<? $page = isset($_GET['page']) ? (int) $_GET['page'] : 1; ?>
  <a href="<?=$root;?>/?view=account&action=profile&subaction=upvotes&profile=<?=$_GET['profile']?>&page=<?=$page+1;?>">Load More Posts ...</a>
</div><br />
<? } ?>


<? } ?> <!-- UPVOTES -->