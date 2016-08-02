<?php
$root = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($root, -1)=="/")
$root = 'http://' . $_SERVER['SERVER_NAME'];
$document = '' . $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($document, -1)=="/")
$document = '' . $_SERVER['DOCUMENT_ROOT'];

	include_once ('../includes/config.php');
	include_once ('../includes/db_connect.php');
	include_once ('../sources/functions.php');
	
$SETTINGS['SQL'] = mysql_query("SELECT * FROM settings ORDER BY id ASC LIMIT 1");
while($SETTINGS = mysql_fetch_array($SETTINGS['SQL'])) {
	
	
	$sql = mysql_query("SELECT * FROM settings");
	$row = mysql_fetch_array($sql);

	if($row['rss_enable'] == 1)
	header("Content-type: text/xml");
	
if($row['rss_enable'] == 1) {
		echo '<?xml version="1.0" encoding="UTF-8" ?>
	<feed xmlns:atom="http://www.w3.org/2005/Atom" xml:lang="en" xml:base="'.$row['website_url'].'" xmlns="http://www.w3.org/2005/Atom">';
		$query ="SELECT * FROM news WHERE status='on' ORDER BY id DESC LIMIT " . $row['limit_rss'];
		echo "<title>" . $row['website_name'] . " " . ucfirst($type) . " RSS Feeds</title>";

	$result = mysql_query($query) or die(mysql_error()); 
	echo "\n<updated>" . date(DATE_ATOM) . "</updated>";
		$perma_type="";
		while($array= mysql_fetch_array($result)){
		 $id   = $array['id'];         
		$news_id = $array['news_id'];
		$title  = $array['title'];
		$file  = $array['file'];
		$old_date = $array['date'];
		$cat_query = mysql_query("SELECT * FROM categories WHERE id=".$array['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { $link = "/gag/".$news_id; } elseif($SETTINGS['permalink'] == 'cat') { $link = "/".$cat_row."/".$news_id; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $link = "/".$cat_row."/".$row['news_id']; }

		$image = "<a href='" . $row['website_url'] . $link . "'><img src='". $row['website_url'] . "/uploads/media_photos/" . $file . "' /></a><br />";
		$pub = $new_date = date(DATE_ATOM , strtotime($old_date));
		$description = $image;
		echo "
		<entry>
		<title>$title</title>
		<link rel='alternate' type='text/html' href='" . $row['website_url'] . "/gag/" . $news_id . "'/>
		<content type='html'>$description</content>
		<updated>$pub</updated>
		</entry>
		"; 
		}
		echo "</feed>";
} else {
	header("Location: " . $row['website_url']);
}

}
		?>