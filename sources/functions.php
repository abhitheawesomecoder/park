<?php
$root = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($root, -1)=="/")
$root = 'http://' . $_SERVER['SERVER_NAME'];
$document = '' . $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($document, -1)=="/")
$document = '' . $_SERVER['DOCUMENT_ROOT'];

include($document.'/includes/site_info.php');
include($document.'/sources/random_functions.php');
	function db_connect()
	{
		include($document.'/includes/config.php');
		$connection = mysql_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD);
		mysql_query("SET NAMES utf8");
		if(!$connection || !mysql_select_db(DATABASE_NAME, $connection))
		{
			return false;
		}
		return $connection;
	}
    
	function db_result_to_array($result)
	{
		$res_array = array();
		
		$count = 0;
		while($row = @mysql_fetch_array($result))
		{
			$res_array[$count] = $row;
			$count++;
		}
		return $res_array;
	}
	
	function get_index_news()
	{
		db_connect();

		$rows_per_page = ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(key) FROM news WHERE status='on'")));
		$pages = ceil($pages / ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}
		
		$query_limit = (($page - 1) * $rows_per_page) .",".$rows_per_page;
		$query = "SELECT * FROM news WHERE status='on' ORDER BY id DESC LIMIT ".$query_limit."";
		
		$result = mysql_query($query);
		
		$result = db_result_to_array($result);
		
		return $result;
	}
	
	
	
	function get_popular_news()
	{
		db_connect();
		
		$rows_per_page = ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(key) FROM news WHERE status='on'")));
		$pages = ceil($pages / ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}
		
		
		$query = "SELECT * FROM news WHERE status='on' ORDER BY rand() LIMIT 100";
		
		$result = mysql_query($query);
		
		$result = db_result_to_array($result);
		
		return $result;
	}

	function get_all_users()
	{
		db_connect();
		
		$rows_per_page = ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(key) FROM users")));
		$pages = ceil($pages / ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}
		
		$query_limit = (($page - 1) * $rows_per_page) .",".$rows_per_page;
		
		$query = "SELECT * FROM users ORDER BY id DESC LIMIT ".$query_limit."";
		
		$result = mysql_query($query);
		
		$result = db_result_to_array($result);
		
		return $result;
	}
	
	function get_cat($url)
	{
		db_connect();
		
		$query = ("SELECT * FROM categories WHERE cat_id='".$url."' AND status='on'");
		
		$result = mysql_query($query);
		
		$row = mysql_fetch_array($result);
		
		return $row;
	}
	
	function get_option_cat()
	{
		db_connect();
		
		$query = "SELECT * FROM categories WHERE status='on' ORDER BY id ASC";
		
		$result = mysql_query($query);
		
		$result = db_result_to_array($result);
		
		return $result;
	}
	
	function get_cat_news($cat_id)
	{
		db_connect();
		
		$rows_per_page = ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(key) FROM news WHERE cat='".$cat_id."' and status='on'")));
		$pages = ceil($pages / ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}
		
		
		$query = "SELECT * FROM news WHERE cat='".$cat_id."' and status='on' ORDER BY id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page";
		
		$result = mysql_query($query);
		
		$result = db_result_to_array($result);
		
		return $result;
	}
	
	function get_search($search)

	{

		db_connect();
		$query = $search; 
    	$min_length = MIN_LENGTH_SEARCH;

    	if(strlen($query) >= $min_length){

        $query = htmlspecialchars($query); 

        $query = mysql_real_escape_string($query);

		$rows_per_page = ROWS_IN_CATEGORIES_PER_PAGE;

		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(key) FROM news WHERE (`title` LIKE '%".$query."%' OR `description` LIKE '%".$query."%') and status='on'")));

		$pages = ceil($pages / ROWS_IN_CATEGORIES_PER_PAGE);

		$querystring = "";

		foreach ($_GET as $key => $value) {

			if ($key != "page") $querystring .= "$key=$value&amp;";

		}

		$query = "SELECT * FROM news WHERE (`title` LIKE '%".$query."%' OR `description` LIKE '%".$query."%') and status='on' ORDER BY id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page";

		} else { // if query length is less than minimum

        }

		$result = mysql_query($query);

		$result = db_result_to_array($result);

		return $result;

	}
	
	function get_pages($id)
	{
		db_connect();
		
		// set up database connection and attempt to match slug
		$query = ("SELECT * FROM pages WHERE page_id='$id' and status='on'");
		
		$result = mysql_query($query);
		
		$row = mysql_fetch_array($result);
		
		return $row;
	}
	
    function get_news($id)
	{
		db_connect();
		
		// set up database connection and attempt to match slug
		$query = ("SELECT * FROM news WHERE news_id='$id' OR title = '".slugify_back2($id)."' and status='on' ");
		
		$result = mysql_query($query);
		
		$row = mysql_fetch_array($result);
		
		return $row;
	}
	
	function get_random_news()
	{
		db_connect();
		
		// set up database connection and attempt to match slug
		$query = ("SELECT * FROM `news` WHERE status='on' ORDER BY RAND() LIMIT 0,1;");
		
		$result = mysql_query($query);
		
		$row = mysql_fetch_array($result);
		
		return $row;
	}
	
	function get_prev_news($id)
	{
		db_connect();
		
		$prev_news_id = $id; 
		$query = ("SELECT * FROM news WHERE id > '$prev_news_id' and status='on' ORDER BY id ASC LIMIT 1");
		
		$result = mysql_query($query);
		
		$row = mysql_fetch_array($result);
		
		return $row;
	}
	
	function get_next_news($id)
	{
		db_connect();
		
		$next_news_id = $id; 
		$query = ("SELECT * FROM news WHERE id < '$next_news_id' and status='on' ORDER BY id DESC LIMIT 1");
		
		$result = mysql_query($query);
		
		$row = mysql_fetch_array($result);
		
		return $row;
	}
	
	function get_members($id)
	{
		db_connect();
		
		$query = ("SELECT * FROM users WHERE username='".$_SESSION['username']."' OR email='".$_SESSION['username']."' ");
		
		$result = mysql_query($query);
		
		$row = mysql_fetch_array($result);
		
		return $row;
	}
	
	
	function get_settings()
	{
		db_connect();
		
		$query = ("SELECT * FROM settings");
		
		$result = mysql_query($query);
		
		$row = mysql_fetch_array($result);
		
		return $row;
	}
	
	
	// Session Member Info
	$members = get_members($id);	
	
	
	function get_overview_news()
	{
		db_connect();
		
		$user_query = mysql_query("SELECT * FROM users WHERE username='".$_SESSION['username']."' OR email='".$_SESSION['username']."' ");
		$user_row = mysql_fetch_row($user_query);
		
		$rows_per_page = ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(v.news_id) FROM news n, votes v WHERE v.news_id = n.id AND v.user_id='".$user_row['0']."' AND n.status='on'")));
		$pages = ceil($pages / ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}

		
        $result = mysql_query("SELECT * FROM activities WHERE userId='".$user_row['0']."' ORDER BY id DESC");
		$rsq = mysql_fetch_row($result);
		
		if($rsq['1'] == 'comment') {
			$result1 = mysql_query("SELECT DISTINCT c.c_id,c.domain,SUBSTR(c.domain,-8,7),c.member_id,n.id,n.news_id,n.title,n.type,n.thumb,n.file,n.cat,n.status FROM comments c, news n WHERE SUBSTR(c.domain,-8,7)=n.news_id AND c.member_id='".$user_row['0']."' AND n.status='on'  GROUP BY n.news_id DESC ORDER BY c.c_id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page");

		    $result1 = db_result_to_array($result1);
			
			return $result1;
		}
		elseif($rsq['1'] == 'like') {
			$result2 = mysql_query("SELECT v.news_id,v.user_id,n.id,n.news_id,n.title,n.type,n.thumb,n.file,n.cat,n.status FROM votes v, news n WHERE v.news_id = n.id AND v.user_id='".$user_row['0']."' AND n.status='on' ORDER BY id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page");

		    $result2 = db_result_to_array($result2);
			
			return $result2;
		}
		
	}
	
	function get_profile_user_news($profile)
	{
		db_connect();
		
		$IMPORTANT_SQL = mysql_query("SELECT * FROM users WHERE username='".str_replace('.', ' ', urldecode($profile))."'");
		$Users = mysql_fetch_row($IMPORTANT_SQL);
		
		$rows_per_page = ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(v.news_id) FROM news n, votes v WHERE v.news_id = n.id AND v.user_id='".$Users['0']."' AND n.status='on'")));
		$pages = ceil($pages / ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}

		
        $result = mysql_query("SELECT n.id,n.news_id,n.title,n.type,n.thumb,n.file,n.cat,n.status,n.author FROM news n WHERE n.author='".$Users['0']."' AND n.status='on' ORDER BY id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page");

		$result = db_result_to_array($result);
		
		return $result;
	}
	
	
	function get_profile_news($profile)
	{
		db_connect();
		
		$IMPORTANT_SQL = mysql_query("SELECT * FROM users WHERE username='".str_replace('.', ' ', urldecode($profile))."'");
		$Users = mysql_fetch_row($IMPORTANT_SQL);
		
		$rows_per_page = ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(v.news_id) FROM news n, votes v WHERE v.news_id = n.id AND v.user_id='".$Users['0']."' AND n.status='on'")));
		$pages = ceil($pages / ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}

		
        $result = mysql_query("SELECT v.news_id,v.user_id,n.id,n.news_id,n.title,n.type,n.thumb,n.file,n.cat,n.status FROM votes v, news n WHERE v.news_id = n.id AND v.user_id='".$Users['0']."' AND n.status='on' ORDER BY id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page");

		$result = db_result_to_array($result);
		
		return $result;
	}
	
	
	function get_profile_comments($profile)
	{
		db_connect();
		
		$IMPORTANT_SQL = mysql_query("SELECT * FROM users WHERE username='".str_replace('.', ' ', urldecode($profile))."'");
		$Users = mysql_fetch_row($IMPORTANT_SQL);
		
		$rows_per_page = ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(c.domin) FROM comments c, news n WHERE SUBSTR(c.domain,-8,7)=n.news_id AND c.member_id='".$Users['0']."' AND n.status='on'")));
		$pages = ceil($pages / ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}
		
        $result = mysql_query("SELECT DISTINCT c.c_id,c.domain,SUBSTR(c.domain,-8,7),c.member_id,n.id,n.news_id,n.title,n.type,n.thumb,n.file,n.cat,n.status FROM comments c, news n WHERE SUBSTR(c.domain,-8,7)=n.news_id AND c.member_id='".$Users['0']."' AND n.status='on'  GROUP BY n.news_id DESC ORDER BY c.c_id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page");

		$result = db_result_to_array($result);
		
		return $result;
	}

	function uploadImageFromURL($file_url, $filename){
		
		
		$file = file_get_contents($file_url);

		$upload_folder = '../uploads/media_photos/';

		if (!file_exists($upload_folder)) {
			mkdir($upload_folder, 0777, true);
		}

		if(strpos($file_url, '.gif') > 0){
			$extension = '.gif';
		} elseif(strpos($file_url, '.jpg') > 0){
			$extension = '.jpg';
		} elseif(strpos($file_url, '.jpeg') > 0){
			$extension = '.jpeg';
		} elseif(strpos($file_url, '.png') > 0){
			$extension = '.png';
		}

		$filename = $filename . $extension;

		if (file_exists($upload_folder.$filename)) {
			$filename =  uniqid() . '-' . $filename . $extension;
		}

	    if(strpos($file_url, '.gif') > 0){
			$img = imagecreatefromstring(file_get_contents($file_url));
			if ($img !== false)
			imagejpeg($img, "uploads/media_photos/$filename.jpg", 100);
		}


	    file_put_contents($upload_folder.$filename, $file);


		return '/' . $filename;

	}

	function uploadImageFromURL2($file_url, $filename){
		
		
		$file = file_get_contents($file_url);

		$upload_folder = 'uploads/media_photos/';

		if (!file_exists($upload_folder)) {
			mkdir($upload_folder, 0777, true);
		}

		if(strpos($file_url, '.gif') > 0){
			$extension = '.gif';
		} elseif(strpos($file_url, '.jpg') > 0){
			$extension = '.jpg';
		} elseif(strpos($file_url, '.jpeg') > 0){
			$extension = '.jpeg';
		} elseif(strpos($file_url, '.png') > 0){
			$extension = '.png';
		}

		$filename = $filename . $extension;

		if (file_exists($upload_folder.$filename)) {
			$filename =  uniqid() . '-' . $filename . $extension;
		}

	    if(strpos($file_url, '.gif') > 0){
			$img = imagecreatefromstring(file_get_contents($file_url));
			if ($img !== false)
			imagejpeg($img, "uploads/media_photos/$filename.jpg", 100);
		}


	    file_put_contents($upload_folder.$filename, $file);


		return '/' . $filename;

	}

	function slugify($str) {
		// replace non letter or digits by -
		if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
		$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
		$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $str);
		$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
		$str = strtolower( trim($str, '-') );

		if (empty($str))
		{
			return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
		}
		   
		return $str;
	}
	
	function create_slug($string){
    	$slug=preg_replace('/[^A-Za-z0-9-]+/', 'post-', $string);
    return $slug;
	}

	function slugify_back2($str) {
		// replace non letter or digits by -
		if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
		$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
		$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $str);
		$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), ' ', $str);
		$str = strtolower( trim($str, ' ') );

		if (empty($str))
		{
			return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
		}
		   
		return $str;
	}
	
	
	function http_decode($link) {
		if (preg_match("#https?://#", $link) === 0)
    	$link = 'http://'.$link;
	return $link;
	}

	function getdomain($url){ 
		$parsed = parse_url($url); 
	return str_replace('www.','', strtolower($parsed['host'])); 
	}

	function get_video_code($url){
		$type=getdomain($url);
		if($type=="youtube.com"){
			$queryString = parse_url($url, PHP_URL_QUERY);
			parse_str($queryString, $params);
			$embed_code='<iframe class="youtube-player" type="text/html" width="100%" height="480" src="http://www.youtube.com/embed/' . trim($params['v']) . '" frameborder="0" allowFullScreen></iframe>';
		}
		else if($type=="vimeo.com"){
			preg_match('/(\d+)/', $url, $output);
			$id = $output[0];
			$embed_code = '<iframe src="http://player.vimeo.com/video/' . trim($id) . '" width="640" height="480" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		}
		else if($type=="vine.co"){
			$id = preg_replace('/^.*\//','',$url);
			$embed_code='<iframe class="vine-embed" src="https://vine.co/v/' . trim($id) . '/embed/simple?audio=1" width="100%" height="480" frameborder="0"></iframe><script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script>';
		}
	return $embed_code;
	}

	function get_video_mobile_code($url){
		$type=getdomain($url);
		if($type=="youtube.com"){
			$queryString = parse_url($url, PHP_URL_QUERY);
			parse_str($queryString, $params);
			$embed_code='<iframe class="youtube-player" type="text/html" width="100%" height="100%" src="http://www.youtube.com/embed/' . trim($params['v']) . '" frameborder="0" allowFullScreen></iframe>';
		}
		else if($type=="vimeo.com"){
			preg_match('/(\d+)/', $url, $output);
			$id = $output[0];
			$embed_code = '<iframe src="http://player.vimeo.com/video/' . trim($id) . '" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		}
		else if($type=="vine.co"){
			$id = preg_replace('/^.*\//','',$url);
			$embed_code='<iframe class="vine-embed" src="https://vine.co/v/' . trim($id) . '/embed/simple?audio=1" width="100%" height="100%" frameborder="0"></iframe><script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script>';
		}
	return $embed_code;
	}

	function get_youtube_photo($url){
		$queryString = parse_url($url, PHP_URL_QUERY);
		parse_str($queryString, $params);
		if (isset($params['v'])) {
			return "http://i3.ytimg.com/vi/" . trim($params['v']) . "/mqdefault.jpg";
		}
	return true;
	}
	
	function get_vimeo_photo($url){
		preg_match('/(\d+)/', $url, $output);
		$id = trim($output[0]);
		$data = file_get_contents("http://vimeo.com/api/v2/video/$id.json");
		$data = json_decode($data);
	return $data[0]->thumbnail_medium;
	}
	
	function get_vine_photo($url){
		$id = trim(preg_replace('/^.*\//','',$url));
		$vine_url = "http://vine.co/v/{$id}";
		$data = file_get_contents($vine_url);
		preg_match('~<\s*meta\s+property="(og:image)"\s+content="([^"]*)~i', $data, $matches);
	return ($matches[2]) ? $matches[2] : false;
	}
	
	function get_admin_posts()
	{
		db_connect();
		
		$ROWS_IN_CATEGORIES_PER_PAGE = 25;
		$rows_per_page = $ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(key) FROM news")));
		$pages = ceil($pages / $ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}
		
		
		$query = "SELECT * FROM news ORDER BY id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page";
		
		$result = mysql_query($query);
		
		$result = db_result_to_array($result);
		
		return $result;
	}
	
	function get_admin_edit_posts($id)
	{
		db_connect();
		
		$query = ("SELECT * FROM news WHERE id='$id' ");
		
		$result = mysql_query($query);
		
		$row = mysql_fetch_array($result);
		
		return $row;
	}
	
	function get_admin_pages()
	{
		db_connect();
		
		$ROWS_IN_CATEGORIES_PER_PAGE = 25;
		$rows_per_page = $ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(key) FROM pages")));
		$pages = ceil($pages / $ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}
		
		
		$query = "SELECT * FROM pages ORDER BY id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page";
		
		$result = mysql_query($query);
		
		$result = db_result_to_array($result);
		
		return $result;
	}
	
	function get_admin_edit_pages($id)
	{
		db_connect();
		
		$query = ("SELECT * FROM pages WHERE id='$id' ");
		
		$result = mysql_query($query);
		
		$row = mysql_fetch_array($result);
		
		return $row;
	}
	
	
	function get_admin_users()
	{
		db_connect();
		
		$ROWS_IN_CATEGORIES_PER_PAGE = 25;
		$rows_per_page = $ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(key) FROM users")));
		$pages = ceil($pages / $ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}
		
		
		$query = "SELECT * FROM users ORDER BY id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page";
		
		$result = mysql_query($query);
		
		$result = db_result_to_array($result);
		
		return $result;
	}
	
	function get_admin_categories()
	{
		db_connect();
		
		$ROWS_IN_CATEGORIES_PER_PAGE = 25;
		$rows_per_page = $ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(key) FROM categories")));
		$pages = ceil($pages / $ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}
		
		
		$query = "SELECT * FROM categories ORDER BY id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page";
		
		$result = mysql_query($query);
		
		$result = db_result_to_array($result);
		
		return $result;
	}
	
	function get_admin_edit_categories($id)
	{
		db_connect();
		
		$query = ("SELECT * FROM categories WHERE id='$id' ");
		
		$result = mysql_query($query);
		
		$row = mysql_fetch_array($result);
		
		return $row;
	}
	
	
	function get_admin_comments()
	{
		db_connect();
		
		$ROWS_IN_CATEGORIES_PER_PAGE = 25;
		$rows_per_page = $ROWS_IN_CATEGORIES_PER_PAGE;
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$pages = implode(mysql_fetch_assoc(mysql_query("SELECT COUNT(key) FROM comments")));
		$pages = ceil($pages / $ROWS_IN_CATEGORIES_PER_PAGE);
		$querystring = "";
		foreach ($_GET as $key => $value) {
			if ($key != "page") $querystring .= "$key=$value&amp;";
		}
		
		
		$query = "SELECT * FROM comments ORDER BY c_id DESC LIMIT " . (($page - 1) * $rows_per_page) . ", $rows_per_page";
		
		$result = mysql_query($query);
		
		$result = db_result_to_array($result);
		
		return $result;
	}
	
	function protect($string){
		$string = filter($string);
	return $string;
	}

	function filter($string) {
     $search = array ("'<script[?>]*?>.*?</script>'si",  // Remove javascript.
                  "'<[\/\!]*?[^<?>]*?>'si",  // Remove HTML tags.
				  "'<>'si",  // Remove HTML tags.
                  "'([\r\n])[\s]+'",  // Remove spaces.
                  "'&(quot|#34);'i",  // Remove HTML entites.
                  "'&(amp|#38);'i",
                  "'&(lt|#60);'i",
                  "'&(gt|#62);'i",
                  "'&(nbsp|#160);'i",
                  "'&(iexcl|#161);'i",
                  "'&(cent|#162);'i",
                  "'&(pound|#163);'i",
                  "'&(copy|#169);'i",
                  "'&#(\d+);'e");  // Evaluate like PHP.
     $replace = array ("",
                   "",
                   "\\1",
                   "\"",
                   "&",
                   "<",
                   "?>",
                   " ",
                   chr(161),
                   chr(162),
                   chr(163),
                   chr(169),
                   "chr(\\1)");
     return preg_replace ($search, $replace, $string);
	}
	
	function LINKS_CLICKABLE($text){
    	return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" target="_blank">$1</a>', $text);
	}
	
	function count_views($news_id) {
		$news_id = mysql_real_escape_string($news_id);
		$select = "SELECT views FROM news WHERE news_id='$news_id'";
		$query = mysql_query($select);
		$fetch = mysql_fetch_array($query);
		$oldval = $fetch['views'];
		$newval = $oldval+1;
		$match = "UPDATE news SET views=$newval WHERE news_id='$news_id'"; 
		mysql_query($match);
	}
	
	function get_featured_posts()
	{
		db_connect();

		$query = "SELECT * FROM news ORDER BY views DESC LIMIT 23";
		
		$result = mysql_query($query);
		
		$result = db_result_to_array($result);
		
		return $result;
	}

	function create_thumb($src, $dest, $desired_width) {
		/* read the source image */
		$source_image = imagecreatefromjpeg($src);
		$width = imagesx($source_image);
		$height = imagesy($source_image);
		
		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height * ($desired_width / $width));
		
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
		
		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
		
		/* create the physical thumbnail image to its destination */
		imagejpeg($virtual_image, $dest);
	}
?>