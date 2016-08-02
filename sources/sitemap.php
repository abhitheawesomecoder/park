<?php 
	include_once ('../includes/config.php');
	include_once ('../includes/db_connect.php');
	include_once ('../includes/site_info.php');
	$settings_query = mysql_query("SELECT * FROM settings");
	$settings = mysql_fetch_array($settings_query);

if($settings['sitemap_enable'] == 1) {
	
header("Content-type: text/xml");

echo '<?xml version="1.0" encoding="UTF-8" ?>';

?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xml:lang="en">

    <url>
        <loc><?=$settings['website_url'];?></loc>
        <lastmod><?=date("Y-m-d");?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>

    <?php
	$categories = mysql_query("SELECT * FROM categories WHERE status='on'");

    while($cat = mysql_fetch_assoc($categories)) {
        $id = $cat['id'];
		$name = $cat['name'];
		$cat_id = $cat['cat_id'];

    echo "<url>
        		<loc>" . $settings['website_url'] . "/" . $cat_id . "</loc>
				<changefreq>daily</changefreq>
        		<priority>1.0</priority>
    	  </url>";

    }
	
$SETTINGS['SQL'] = mysql_query("SELECT * FROM settings ORDER BY id ASC LIMIT 1");
while($SETTINGS = mysql_fetch_array($SETTINGS['SQL'])) {
	
    $entries = mysql_query("SELECT * FROM news WHERE status='on'");

    while($row = mysql_fetch_assoc($entries)) {
        $id = $row['id'];         
		$news_id = $row['news_id'];
		$title_1  = $row['title'];
		$title = str_replace('&', '&amp;', $title_1);
		$file  = $row['file'];
		$old_date = $row['date'];

$cat_query = mysql_query("SELECT * FROM categories WHERE id=".$row['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { $link = "/gag/".$news_id; } elseif($SETTINGS['permalink'] == 'cat') { $link = "/".$cat_row."/".$news_id; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $link = "/".$cat_row."/".$row['news_id']; }

    echo "<url>
        		<loc>" . $settings['website_url'] . $link . "</loc>
        		<lastmod>".$old_date."</lastmod>
				<image:image><image:loc>". $settings['website_url'] . "/uploads/media_photos/" . $file . "</image:loc><image:caption>". $title . "</image:caption><image:title>". $title . "</image:title></image:image>
        		<changefreq>daily</changefreq>
        		<priority>1.0</priority>
    	  </url>";

 } 
 
}?>

</urlset>

<? } else {
	header("Location: " . $settings['website_url']);
} ?>