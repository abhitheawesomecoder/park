<? if($_GET['subaction'] == '') { ?> <!-- OVERVIEW -->
<div id="container" style="margin-left: 3px; margin-top: 5px;">
<? 
$rows_per_page = ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(n.id) FROM activities a, news n WHERE n.id=a.productId AND a.userId='".$Users['0']."'")));
		$pages = ceil($pages / ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}
		
		
		
		
$result2 = mysql_query("SELECT DISTINCT a.*, n.* FROM activities a, news n WHERE n.id=a.productId AND a.userId='".$Users['0']."'  GROUP BY n.news_id DESC ORDER BY a.id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page");

while($media = mysql_fetch_array($result2)) {

   $query_user = mysql_query("SELECT * FROM users WHERE username='".str_replace('.', ' ', urldecode($_GET['profile']))."'"); while($user_media = mysql_fetch_array($query_user)) { $user_id = $user_media['id']; $first_name = $user_media['first_name']; $last_name = $user_media['last_name']; }
?>
<div class="box">
<a href="" style="color: #000; font-size: 13px; line-height: 24px;"><font style="font-weight: bold;padding: 3px 0;border-bottom: 1px solid #000;"><?=$first_name . " " . $last_name;?></font> &nbsp;
<font style="letter-spacing: 0.3px;color:#ee0005;"><? if($media['activity'] == 'comment') { if($media['activity_sub'] == 'like') { ?><?=$LANG['upvoted_and'];?> <? }?><?=$LANG['commented'];?><? } if($media['activity_sub'] == 'like') { if($media['activity'] == 'comment') {  } else {?><?=$LANG['upvoted'];?><? } }?></font></a>
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
<? } ?>
</div>

<!-- contains the content to be loaded when scrolled -->
<nav id="page-nav">
<? if($_GET['page'] = '') { $page=$_GET['page']; } else { $page='1'; } ?>
  <a href="<?=$root;?>/?view=account&action=profile&subaction=&profile=<?=$_GET['profile']?>&page=<?=$page+1;?>"></a>
</nav>

<? if (mysql_num_rows($result2)==0) {?>
<div class="blank-state">
        <h3><?=$LANG['posts_show_up'];?> <?=$Users['6']?> <?=$Users['7']?> <?=$LANG['upvoted_and_commented_will_show_up_here'];?></h3>
        <div class="btn-container" style="text-align: center; width: auto;"><a class="btn" href="<?=$root?>/view/popular"><?=$LANG['checkout_whats_hot'];?></a></div>
</div>
<? }?>
<? } ?> <!-- OVERVIEW -->


<? if($_GET['subaction'] == 'posts') { ?> <!-- POSTS -->
<div id="container" style="margin-left: 3px; margin-top: 5px;">
<? $user_news = get_profile_user_news($_GET['profile']); ?>
<? $i = 7;
   foreach(array_slice($user_news, $startResults, $resultsPerPage) as $media): 
   $query_user = mysql_query("SELECT * FROM users WHERE id='".$media['author']."'"); while($user_media = mysql_fetch_array($query_user)) { $first_name = $user_media['first_name']; $last_name = $user_media['last_name']; }
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
<? $i++;
endforeach; ?>
</div>

<!-- contains the content to be loaded when scrolled -->
<nav id="page-nav">
<? if($_GET['page'] = '') { $page=$_GET['page']; } else { $page='1'; } ?>
  <a href="<?=$root;?>/?view=account&action=profile&subaction=posts&profile=<?=$_GET['profile']?>&page=<?=$page+1;?>"></a>
</nav>

<? 
$result_posts = mysql_query("SELECT n.id,n.news_id,n.title,n.type,n.thumb,n.file,n.cat,n.status,n.author FROM news n WHERE n.author='".$Users['0']."' ORDER BY id DESC");

if (mysql_num_rows($result_posts)==0) {?>
<div class="blank-state">
        <h3><?=$LANG['posts_show_up'];?> <?=$Users['6']?> <?=$Users['7']?> <?=$LANG['uploaded_will_show_up_here'];?></h3>
        <div class="btn-container" style="text-align: center; width: auto;"><a class="btn" href="<?=$root?>/view/popular"><?=$LANG['checkout_whats_hot'];?></a></div>
</div>
<? }?>

<? } ?> <!-- POSTS -->




<? if($_GET['subaction'] == 'upvotes') { ?> <!-- UPVOTES -->
<div id="container" style="margin-left: 3px; margin-top: 5px;">
<? $news = get_profile_news($_GET['profile']); ?>
<? $i = 7;
   foreach(array_slice($news, $startResults, $resultsPerPage) as $media): 
   $query_user = mysql_query("SELECT * FROM users WHERE id='".$media['user_id']."'"); while($user_media = mysql_fetch_array($query_user)) { $first_name = $user_media['first_name']; $last_name = $user_media['last_name']; }
?>
<div class="box">
<a href="" style="color: #000; font-size: 13px; line-height: 24px;"><font style="font-weight: bold;padding: 3px 0;border-bottom: 1px solid #000;"><?=$first_name . " " . $last_name;?></font> &nbsp;<font style="letter-spacing: 1px;color:#ee0005;"><?=$LANG['upvoted'];?></font></a>
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
<? $i++;
endforeach; ?>
</div>

<!-- contains the content to be loaded when scrolled -->
<nav id="page-nav">
<? if($_GET['page'] = '') { $page=$_GET['page']; } else { $page='1'; } ?>
  <a href="<?=$root;?>/?view=account&action=profile&subaction=upvotes&profile=<?=$_GET['profile']?>&page=<?=$page+1;?>"></a>
</nav>

<? 
$result_upvotes = mysql_query("SELECT v.news_id,v.user_id,n.id,n.news_id,n.title,n.type,n.thumb,n.file,n.cat,n.status FROM votes v, news n WHERE v.news_id = n.id AND v.user_id='".$Users['0']."' ORDER BY id DESC");

if (mysql_num_rows($result_upvotes)==0) {?>
<div class="blank-state">
        <h3><?=$LANG['posts_show_up'];?> <?=$Users['6']?> <?=$Users['7']?> <?=$LANG['upvoted_will_show_up_here'];?></h3>
        <div class="btn-container" style="text-align: center; width: auto;"><a class="btn" href="<?=$root?>/view/popular"><?=$LANG['checkout_whats_hot'];?></a></div>
</div>
<? }?>


<? } ?> <!-- UPVOTES -->



<? if($_GET['subaction'] == 'comments') { ?> <!-- COMMENTS -->



<div id="container" style="margin-left: 3px; margin-top: 5px;">
<? $comments = get_profile_comments($_GET['profile']); ?>
<? $i = 7;
   foreach(array_slice($comments, $startResults, $resultsPerPage) as $media): 
   $query_user = mysql_query("SELECT * FROM users WHERE id='".$media['member_id']."'"); while($user_media = mysql_fetch_array($query_user)) { $first_name = $user_media['first_name']; $last_name = $user_media['last_name']; }
?>
<div class="box">
<a href="" style="color: #000; font-size: 13px; line-height: 24px;"><font style="font-weight: bold;padding: 3px 0;border-bottom: 1px solid #000;"><?=$first_name . " " . $last_name;?></font> &nbsp;<font style="letter-spacing: 1px;color:#ee0005;"><?=$LANG['commented'];?></font></a>
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
<? $i++;
endforeach; ?>
</div>

<!-- contains the content to be loaded when scrolled -->
<nav id="page-nav">
<? if($_GET['page'] = '') { $page=$_GET['page']; } else { $page='1'; } ?>
  <a href="<?=$root;?>/?view=account&action=profile&subaction=comments&profile=<?=$_GET['profile']?>&page=<?=$page+1;?>"></a>
</nav>

<? 
$result_comments = mysql_query("SELECT DISTINCT c.c_id,c.domain,SUBSTR(c.domain,-8,7),c.member_id,n.id,n.news_id,n.title,n.type,n.thumb,n.file,n.cat,n.status FROM comments c, news n WHERE SUBSTR(c.domain,-8,7)=n.news_id AND c.member_id='".$Users['0']."'  GROUP BY n.news_id DESC ORDER BY c.c_id DESC");

if (mysql_num_rows($result_comments)==0) {?>
<div class="blank-state">
        <h3><?=$LANG['posts_show_up'];?> <?=$Users['6']?> <?=$Users['7']?> <?=$LANG['commented_will_show_up_here'];?></h3>
        <div class="btn-container" style="text-align: center; width: auto;"><a class="btn" href="<?=$root?>/view/popular"><?=$LANG['checkout_whats_hot'];?></a></div>
</div>
<? }?>

<? } ?> <!-- COMMENTS -->