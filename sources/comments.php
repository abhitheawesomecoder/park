<?php
ob_start();
session_start();

$root = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($root, -1)=="/")
$root = 'http://' . $_SERVER['SERVER_NAME'];
$document = '' . $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($document, -1)=="/")
$document = '' . $_SERVER['DOCUMENT_ROOT'];

if(!isset($_SESSION['username']))
{
include_once ('../includes/config.php');
include_once ('../includes/db_connect.php');
include_once ('../sources/functions.php');
include_once ('../includes/languages.php');

$query_members = ("SELECT * FROM users WHERE email='".$_SESSION['username']."' ");
$result_members = mysql_query($query_members);
$members = mysql_fetch_array($result_members);
		


// Comments PHP Nis.Ge
$key = $_GET['nis_key'];
$domain = $_GET['domain'];
$href = $_GET['href'];
$width = $_GET['width'];
$height = $_GET['height'];
$news_num = $_GET['news_num'];
$user_id = $_GET['user_id'];


?>
<!DOCTYPE html>
<html lang="ka" id="nisgeo" class="no_js" style="overflow: hidden;"><head><meta charset="utf-8" /><meta name="robots" content="noodp, noydir" /><meta name="referrer" content="default" id="meta_referrer" /><title>Nis</title><link type="text/css" rel="stylesheet" href="../themes/default/comments.css" />
<script src="//code.jquery.com/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../themes/default/js/jscroll.js"></script>
<script type="text/javascript">
$(document).ready(function () { 


$(function(){
	$("a.up").click(function(){
	//get the id
	the_id = $(this).attr('id');
	
	jQuery("#vote_buttons"+the_id).addClass('up');
	
	//fadeout the vote-count 
	$("span#votes_count"+the_id).fadeOut("fast");
	
	//the main ajax request
		$.ajax({
			type: "POST",
			data: "action=vote_up&id="+$(this).attr("id")+"&user_id="+$(this).attr("user_id"),
			url: "../sources/comments_votes.php",
			success: function(msg)
			{
				$("span#votes_count"+the_id).html(msg);
				//fadein the vote count
				$("span#votes_count"+the_id).fadeIn();
			}
		});
	});
	
	$("a.down").click(function(){
	//get the id
	the_id = $(this).attr('id');
	
	jQuery("#vote_buttons"+the_id).removeClass('up');
	
	//the main ajax request
		$.ajax({
			type: "POST",
			data: "action=vote_down&id="+$(this).attr("id")+"&user_id="+$(this).attr("user_id"),
			url: "../sources/comments_votes.php",
			success: function(msg)
			{
				$("span#votes_count"+the_id).fadeOut();
				$("span#votes_count"+the_id).html(msg);
				$("span#votes_count"+the_id).fadeIn();
			}
		});
	});
});	
});	
</script>
</head>
<body <? if($_GET['theme'] == 'elegant') { echo "style='background: #f7f7f7;'"; }?>>
<div id="hidden_add_comment">

<div id="adds-comment">
<div class="add-comment-user"><img id="user-img" src="../themes/default/images/user.png"></div>
<div class="add-comment-form">
<span class="add-comment-content">
<span class="content-triangle"></span>
<div class='add-comment-content-text'>
<form action="" method="POST">
<textarea type="text" id="adds-comment-content-input" class="add-comment-content-input" name="adds-comment-content" placeholder="<?=$LANG['sources_IF_YOU_WANT_TO_POST_COMMENT_title'];?> ..."></textarea>
<div class="post-container"><input type="submit" name="submit" class="post-btn" value="<?=$LANG['sources_POST_BUTTON_title'];?>"></div>
<br><br>
</form><br>
</div>
</span>
</div>
</div>
</div>


<div id="MY_COMMENTS" style="margin-top: 130px;">

<div id="all_comments" style="min-height: 1%;">
<?
$rows_per_page = $news_num;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(c_id) FROM comments WHERE domain='".$_GET['domain']."'")));
$pages = ceil($pages / $news_num);
		
$CommentQuery = mysql_query("SELECT comments.c_id,comments.member_id,comments.comment,comments.date FROM comments WHERE domain = '$domain' AND nis_key = '$key' ORDER BY c_id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page");
while ($comments = mysql_fetch_array($CommentQuery)) {
	$CommentUserQuery = mysql_query("SELECT * FROM users WHERE id='".$comments['member_id']."'");
	$users = mysql_fetch_array($CommentUserQuery);
?>
<div class="com_item" id="com_item-<?=$comments['c_id']?>">
<div id="comment">
<div class="add-comment-form">
<span class="add-comment-content" style="font-family: Arial; font-size: 12px;">
<div id="comment-content">
<div class="comment-user" style="float: left;"><? if($users['oauth_provider'] == '') {?><img id="user-img" src="../uploads/avatars/<?=$users['photo'];?>"><? }elseif($users['oauth_provider'] == 'facebook') {?><img id="user-img" src="<?=$users['photo']?>" alt="Avatar"><? }elseif($users['oauth_provider'] == 'twitter') {?><img id="user-img" src="../uploads/avatars/<?=$users['photo']?>" alt="Avatar"><? }?></div>
<div class="name"><a class="username"><?=$users['first_name'];?> <?=$users['last_name'];?></a>
            
<div class="vote-buttons <? $query_distinct = mysql_query("SELECT * FROM comments_votes WHERE news_id='".$comments['c_id']."' AND user_id='".$user_id."'");
if (mysql_num_rows($query_distinct) ){ echo "up"; } else { } ?>" id='vote_buttons<?php echo $comments['c_id']; ?>'>
<a class="up" href='javascript:;' id='<?=$comments['c_id'];?>' user_id='<?=$user_id;?>'><span class="icn-up"></span><span class="label">Upvote</span></a><span class="seperator"></span>
<a class="down" href='javascript:;' id='<?=$comments['c_id'];?>' user_id='<?=$user_id;?>'><span class="icn-down"></span><span class="label">Downvote</span></a>
</div>
<a class="separator"> · </a><a class="comment_date"><?=$comments['date'];?> 
<a class="separator"> · </a>
<a class="votes_all"><? $q = "SELECT * FROM comments_votes WHERE news_id = '".$comments['c_id']."'";$r = mysql_query($q);$effective_vote = mysql_num_rows($r);?>
<span class='votes_count' id='votes_count<?php echo $comments['c_id']; ?>'><?php echo $effective_vote." ".$LANG['sources_POINTS_title']; ?></span> 
</a>
</a></div> <br>
<div style="margin-top: -15px; width: 100%; text-align: justify; padding: 10px;"><?=$comments['comment'];?></div>
</div>

</span>
</div>
</div>
</div>
<?php
}
?>
</div>


<div class="nav_cat" style="display: block;">
<a href="../sources/comments.php?nis_key=<?=$_GET['nis_key']?>&domain=<?=$_GET['domain']?>&news_num=<?=$_GET['news_num']?>&user_id=<?=$_GET['user_id']?>&page=<?=$page+1;?>"></a>
</div>


<div id="hiddable_loader"></div>

</div>



</body>
</html>
<?php
} else {
include_once ('../includes/config.php');
include_once ('../includes/db_connect.php');
include_once ('../sources/functions.php');
include_once ('../includes/languages.php');

$query_members = ("SELECT * FROM users WHERE username='".$_SESSION['username']."' OR email='".$_SESSION['username']."' ");
$result_members = mysql_query($query_members);
$members = mysql_fetch_array($result_members);
		
?>
<!DOCTYPE html>
<html lang="ka" id="nisgeo" class="no_js" style="overflow: hidden;">
<head><meta charset="utf-8" /><meta name="robots" content="noodp, noydir" /><meta name="referrer" content="default" id="meta_referrer" /><title>Nis</title>
<script src="//code.jquery.com/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../themes/default/js/jscroll.js"></script>
<script type="text/javascript">
$(document).ready(function () { 


$(function(){
	$(document).on("click",".remove-button",function(){
		the_id = $(this).attr('id');
		
		var x;
		var r=confirm("<?=$LANG['sources_ARE_YOU_SURE_YOU_WANT_TO_DELETE_THIS_COMMENT_title'];?>");
		if (r==true) {
  			$.ajax({
					type: "POST",
					data: "action=remove&id="+$(this).attr("id")+"&news_id="+$(this).attr("news_id")+"&user_id="+$(this).attr("user_id"),
					url: "../sources/remove_comment.php",
					success: function(msg) {
												$("#com_item-"+the_id).html(msg);
												//fadeOut for delete comment
												$("#com_item-"+the_id).fadeOut();
					}
			});
  		} else {
  						
  		}
	});
	
	
	
	
	
	$("a.up").click(function(){
	//get the id
	the_id = $(this).attr('id');
	
	jQuery("#vote_buttons"+the_id).addClass('up');
	
	//fadeout the vote-count 
	$("span#votes_count"+the_id).fadeOut("fast");
	
	//the main ajax request
		$.ajax({
			type: "POST",
			data: "action=vote_up&id="+$(this).attr("id")+"&user_id="+$(this).attr("user_id"),
			url: "../sources/comments_votes.php",
			success: function(msg)
			{
				$("span#votes_count"+the_id).html(msg);
				//fadein the vote count
				$("span#votes_count"+the_id).fadeIn();
			}
		});
	});
	
	$("a.down").click(function(){
	//get the id
	the_id = $(this).attr('id');
	
	jQuery("#vote_buttons"+the_id).removeClass('up');
	
	//the main ajax request
		$.ajax({
			type: "POST",
			data: "action=vote_down&id="+$(this).attr("id")+"&user_id="+$(this).attr("user_id"),
			url: "../sources/comments_votes.php",
			success: function(msg)
			{
				$("span#votes_count"+the_id).fadeOut();
				$("span#votes_count"+the_id).html(msg);
				$("span#votes_count"+the_id).fadeIn();
			}
		});
	});
});	
});	
</script>

<link type="text/css" rel="stylesheet" href="../themes/default/comments.css" />
</head>
<body class="plugin" <? if($_GET['theme'] == 'elegant') { echo "style='background: #f7f7f7;'"; }?>>
<div id="display"></div>
<?php
// Comments PHP Nis.Ge
$key = $_GET['nis_key'];
$news_id = str_replace('.', ' ', urldecode($_GET['news_id']));
$user_id = str_replace('.', ' ', urldecode($_GET['user_id']));
$domain = $_GET['domain'];
$href = $_GET['href'];
$width = $_GET['width'];
$height = $_GET['height'];
$news_num = $_GET['news_num'];

// $_POST submit button
$comment = $_POST['add-comment-content'];
$submit = $_POST['submit'];

if($_POST) {
	    if($comment) {
			$insert = mysql_query("INSERT INTO comments (domain,comment,date,member_id) VALUES ('$domain','$comment',now(),'$user_id')");
			
			
			$activities_sql = mysql_query("SELECT * FROM activities WHERE userId='".$user_id."' AND productId='".$news_id."'");
			$activities_row = mysql_fetch_row($activities_sql);
			if($activities_row['1'] == '') {
				if($activities_row['2'] == '') {
					$result_activities = mysql_query('INSERT INTO activities (activity, userId, productId) VALUES ("comment", "'.$user_id.'", "'.$news_id.'")');
				} else {
					$result_activities = mysql_query('UPDATE activities SET activity = "comment" WHERE userId="'.$user_id.'" AND productId="'.$news_id.'"');
				}
			} else {
				$result_activities = mysql_query('UPDATE activities SET activity = "comment" WHERE userId="'.$user_id.'" AND productId="'.$news_id.'"');
			}
		
		} else {
		echo "";
        }
}

// key & domain & height & news_num
if(!$key != "278394375505800") {

if(isset($domain)) {

if(isset($news_num)) {
?>
<div id="add-comment">
<div class="add-comment-user"><img id="user-img" src="../themes/default/images/user.png"></div>
<div class="add-comment-form">
<span class="add-comment-content">
<span class="content-triangle"></span>
<div class='add-comment-content-text'>
<form method="POST">
<textarea type="text" id="add-comment-content-input" class="add-comment-content-input" name="add-comment-content" placeholder="<?=$LANG['sources_LEAVE_A_COMMENT_title'];?>"></textarea>
<div class="post-container"><input type="submit" name="submit" class="post-btn" value="<?=$LANG['sources_POST_BUTTON_title'];?>"></div>
</form><br><div style="margin-top: 10px;"></div>
</div>
</span>
</div>
</div>

<div id="MY_COMMENTS">

<div id="all_comments" style="min-height: 1%;">
<?
$rows_per_page = $news_num;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(c_id) FROM comments WHERE domain='".$_GET['domain']."'")));
$pages = ceil($pages / $news_num);
		
$CommentQuery = mysql_query("SELECT comments.c_id,comments.member_id,comments.comment,comments.date FROM comments WHERE domain = '$domain' AND nis_key = '$key' ORDER BY c_id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page");
while ($comments = mysql_fetch_array($CommentQuery)) {
	$CommentUserQuery = mysql_query("SELECT * FROM users WHERE id='".$comments['member_id']."'");
	$users = mysql_fetch_array($CommentUserQuery);
?>
<div class="com_item" id="com_item-<?=$comments['c_id']?>">
<div id="comment">
<div class="add-comment-form">
<span class="add-comment-content" style="font-family: Arial; font-size: 12px;">
<div id="comment-content">
<div class="comment-user" style="float: left;"><? if($users['oauth_provider'] == '') {?><img id="user-img" src="../uploads/avatars/<?=$users['photo'];?>"><? }elseif($users['oauth_provider'] == 'facebook') {?><img id="user-img" src="<?=$users['photo']?>" alt="Avatar"><? }elseif($users['oauth_provider'] == 'twitter') {?><img id="user-img" src="../uploads/avatars/<?=$users['photo']?>" alt="Avatar"><? }?></div>
<div class="name"><a href="/u/<?=str_replace(' ', '.', urldecode($users['username']));?>" target="_blank" class="username"><?=$users['first_name'];?> <?=$users['last_name'];?></a>
<? $extra_menu = mysql_query("SELECT * FROM users WHERE id='".$comments['member_id']."'");
   $remove_button = mysql_fetch_array($extra_menu);
   if($remove_button['id'] == $members['id']) { ?>
<div class="extra-menu">
<div><a class="remove-button" href='javascript:;' id='<?=$comments['c_id'];?>' user_id='<?=$comments['member_id'];?>' news_id='<?=str_replace(' ', '', urldecode($news_id));?>'><span class="inline-icon"><div class="remove"></div></span></a></div>
</div>
<? } ?>
            
<div class="vote-buttons <? $query_distinct = mysql_query("SELECT * FROM comments_votes WHERE news_id='".$comments['c_id']."' AND user_id='".$user_id."'");
if (mysql_num_rows($query_distinct) ){ echo "up"; } else { } ?>" id='vote_buttons<?php echo $comments['c_id']; ?>'>
<a class="up" href='javascript:;' id='<?=$comments['c_id'];?>' user_id='<?=$user_id;?>'><span class="icn-up"></span><span class="label">Upvote</span></a><span class="seperator"></span>
<a class="down" href='javascript:;' id='<?=$comments['c_id'];?>' user_id='<?=$user_id;?>'><span class="icn-down"></span><span class="label">Downvote</span></a>
</div>
<a class="separator"> · </a><a class="comment_date"><?=$comments['date'];?> 
<a class="separator"> · </a>
<a class="votes_all"><? $q = "SELECT * FROM comments_votes WHERE news_id = '".$comments['c_id']."'";$r = mysql_query($q);$effective_vote = mysql_num_rows($r);?>
<span class='votes_count' id='votes_count<?php echo $comments['c_id']; ?>'><?php echo $effective_vote." ".$LANG['sources_POINTS_title']; ?></span> 
</a>
</a></div> <br>
<div style="margin-top: -15px; width: 100%; text-align: justify; padding: 10px;"><?=$comments['comment'];?></div>
</div>

</span>
</div>
</div>
</div>
<?php
}
?>
</div>


<div class="nav_cat" style="display: block;">
<a href="../sources/comments.php?nis_key=<?=$_GET['nis_key']?>&domain=<?=$_GET['domain']?>&news_num=<?=$_GET['news_num']?>&user_id=<?=$_GET['user_id']?>&page=<?=$page+1;?>"></a>
</div>


<div id="hiddable_loader"></div>

</div>
<?php
} else {
	echo "Error!";
}
} else {
	echo "Error!";
}
} else {
	echo "Error!";
}
	
?>
</body>
</html>
<?php
}
?>