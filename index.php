<?php
ob_start();
session_start();
$_SESSION['token'] = '';
$root = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($root, -1)=="/")
$root = 'http://' . $_SERVER['SERVER_NAME'];
$document = '' . $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($document, -1)=="/")
$document = '' . $_SERVER['DOCUMENT_ROOT'];
date_default_timezone_set('Asia/Tbilisi');
include_once ($document.'/includes/config.php');
if (DATABASE_HOST == "" || DATABASE_NAME == "" || DATABASE_USERNAME == "" || DATABASE_PASSWORD == "") { header('Location: install.php'); exit; }
include_once ($document.'/includes/db_connect.php');
include_once ($document.'/sources/functions.php');
include_once ($document.'/includes/languages.php');
include_once ($document.'/sources/backgrounds.php');
include_once ($document.'/sources/mouse_auth.php');
include_once ($document.'/sources/resize-class.php');

if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'twitter') {
        header("Location: app/login-twitter.php");
    } else if ($oauth_provider == 'facebook') {
        header("Location: app/login-facebook.php");
    }
}

// Session Member Info
$members = get_members($id);
$settings = get_settings();

$count_messages_seen = mysql_num_rows(mysql_query("SELECT * FROM messages WHERE message_receiver='".$members['id']."' AND message_d2='0' AND message_s2='0'"));


// View function
$view = empty($_GET['view']) ? 'index' : $_GET['view'];

switch($view) {
	case('index'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'on';
		$THEME_CONTENT_WRAP_CENTER = 'on';
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
		$news = get_index_news();
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: index.php?view=social.password"); }}
	$PAGE_TITLE = WEBSITE_NAME;
	break;
	case('popular'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'on';
		$THEME_CONTENT_WRAP_CENTER = 'on';
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
		$news = get_popular_news();
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	$PAGE_TITLE = WEBSITE_NAME;
	break;
	case('users'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'on';
		$THEME_CONTENT_WRAP_CENTER = 'on';
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
		$news = get_all_users();
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	$PAGE_TITLE = WEBSITE_NAME;
	break;
	case('cat'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'on';
		$THEME_CONTENT_WRAP_CENTER = 'on';
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	    $url = $_GET['cat'];
		$cat = get_cat($url);
		$cat_id = $cat['id'];
		$news = get_cat_news($cat_id);
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	$PAGE_TITLE = $cat['name'];
	break;
	case('search'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'on';
		$THEME_CONTENT_WRAP_CENTER = 'on';
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	    $page = 1;
		$id = $_GET['search'];
		$news = get_search($id);
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	$PAGE_TITLE = WEBSITE_NAME;
	break;
	case('news'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'on';
		$THEME_CONTENT_WRAP_CENTER = 'on';
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
		$cat = $_GET['cat'];
	    $id = $_GET['id'];
	    count_views($_GET['id']);
		$media = get_news($_GET['id']);
		$next_media = get_next_news($media['id']);
		$prev_media = get_prev_news($media['id']);
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	$PAGE_TITLE = $media['title'];
	break;
	case('delete_news'):
	    $news_id = $_GET['news_id'];
		$news_filter = mysql_query("SELECT * FROM news WHERE news_id='".$news_id."'");
		while($row = mysql_fetch_array($news_filter)) {
			$target = 'uploads/media_photos/'.$row["file"];
			$target2 = 'uploads/media_photos/'.$row["thumb"];
			if (file_exists($target)) { unlink($target); } if (file_exists($target2)) { unlink($target2); }
			if (file_exists($target)) { } else { } if (file_exists($target2)) { } else { }
		}
		$delete = mysql_query("DELETE FROM news WHERE news_id='".$news_id."'");
		header('Location: '.$root.'');
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	break;
	case('login'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'off';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'off';
		$THEME_CONTENT_WRAP_CENTER = 'off';
		$THEME_CONTENT_WRAP_RIGHT = 'off';
	}
	    //$name = $_SESSION['username'];
	    if(isset($_SESSION['username'])) { header('Location: '.$root.''); }
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	$PAGE_TITLE = $LANG['page_login_title'];
	break;
	case('signup'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'off';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'off';
		$THEME_CONTENT_WRAP_CENTER = 'off';
		$THEME_CONTENT_WRAP_RIGHT = 'off';
	}
	    //$name = $_SESSION['username'];
	    if(isset($_SESSION['username'])) { header('Location: '.$root.''); }
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	$PAGE_TITLE = $LANG['page_registration_title'];
	break;
	case('account'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'off';
		$THEME_CONTENT_WRAP_CENTER = 'on';
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
		// Check, if username session is NOT set then this page will jump to login page
		if(!isset($_SESSION['username'])) { header('Location: /'); }
		$IMPORTANT_SQL = mysql_query("SELECT * FROM users WHERE username='".str_replace(' ', '.', urldecode($_GET['profile']))."'");
		$Users = mysql_fetch_array($IMPORTANT_SQL);
		if($_GET['action'] == 'profile') {$PAGE_TITLE = $LANG['page_PROFILE_title'];}
		if($_GET['action'] == 'settings') {$THEME_CONTENT_WRAP_RIGHT = 'on';$PAGE_TITLE = $LANG['page_user_settings_title'];}
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	break;
	case('logout'):
	$THEME_CONTENT_WRAP_RIGHT = 'on';
		// Logout Action
		unset($_SESSION['id']); unset($_SESSION['username']); unset($_SESSION['oauth_provider']); unset($_SESSION['username']); header('Location: /');
	break;
	case('messages'):
		if($settings['theme'] == 'default') {
			$THEME_CONTENT_WRAP_RIGHT = 'on';
		}
		elseif($settings['theme'] == 'elegant') {
			$THEME_CONTENT_WRAP_LEFT = 'off';
			$THEME_CONTENT_WRAP_CENTER = 'on';
			$THEME_CONTENT_WRAP_RIGHT = 'on';
		}
		if($_GET['action'] == '') {
			$PAGE_TITLE = "Messages";
		}
		elseif($_GET['action'] == 'new') {
			$PAGE_TITLE = "Send message";
		}
		if(!isset($_SESSION['username'])) { header('Location: /view/login'); }
	break;
	case('social.password'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'on';
		$THEME_CONTENT_WRAP_CENTER = 'on';
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	    if($members['password'] == '') { } else {

		}
	$PAGE_TITLE = $LANG['page_type_your_password_title'];
	break;
	case('upload'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'on';
		$THEME_CONTENT_WRAP_CENTER = 'on';
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	    //$name = $_SESSION['username'];
		if(!isset($_SESSION['username'])) { header('Location: /'); }
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	$PAGE_TITLE = $LANG['page_UPLOAD_title'];
	break;
	case('meme'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'off';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'off';
		$THEME_CONTENT_WRAP_CENTER = 'on';
		if($_GET['t'] == '') {
			if($_GET['c'] == '') {
				$THEME_CONTENT_WRAP_RIGHT = 'off';
			} else {
				$THEME_CONTENT_WRAP_RIGHT = 'on';
			}
		}
	}
	    //$name = $_SESSION['username'];
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	$PAGE_TITLE = $LANG['page_MEME_UPLOAD_title'];
	break;
	case('delete_account'):
	$THEME_CONTENT_WRAP_RIGHT = 'off';
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	$PAGE_TITLE = $LANG['page_Delete_Your_Account_title'];
	break;
	case('admin'):
	$THEME_CONTENT_WRAP_RIGHT = 'off';
		if($members['admin'] == '1') {
			if(isset($_SESSION['username'])) { } else { header('Location: '.$root.''); }
		} else {
			if(isset($_SESSION['username'])) { header('Location: '.$root.''); } else { header('Location: '.$root.''); }
		}
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	$PAGE_TITLE = $LANG['page_admin_title'];
	break;
	case('adults_page'):
	$THEME_CONTENT_WRAP_RIGHT = 'off';

	$PAGE_TITLE = "Adults Page";
	break;
	case('pages'):
	if($settings['theme'] == 'default') {
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	elseif($settings['theme'] == 'elegant') {
		$THEME_CONTENT_WRAP_LEFT = 'on';
		$THEME_CONTENT_WRAP_CENTER = 'on';
		$THEME_CONTENT_WRAP_RIGHT = 'on';
	}
	    $id = $_GET['id'];
		$media = get_pages($_GET['id']);
		if ($members['password'] == '') { if($_SESSION['username']){ header("Location: /index.php?view=social.password");}}
	$PAGE_TITLE = $media['page_title'];
	break;
}

$arr = array('index','popular','users','cat','messages','search','news','pages','login','signup','account','social.password','upload','meme','delete_account','admin','adults_page','myproducts','verify');
if(!in_array($view,$arr)) die("<html><head><meta charset='utf-8'></head><body>This Page Don't Work.</body></html>");

// GEOIP LOCATION
$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
function ip_details($ip) {
    $json = file_get_contents("http://ipinfo.io/{$ip}");
    $details = json_decode($json);
    return $details;
}
$details_ip = ip_details("$ip");
if($members['country'] == ''){ mysql_query("UPDATE users SET country='".strtolower($details_ip->country)."' WHERE id='".$members['id']."'"); }
if($settings['website_url'] == ''){ mysql_query("UPDATE settings SET website_url='".$root."'"); }
// Mobile Version
include($document.'/sources/mobile_detect.php');
$detect = new Mobile_Detect;
// Website Content Template
$version = $_GET['version'];
if($detect->isMobile()){ $version = "mobile"; } else {  }
// Mobile Version
switch($version) {
    case 'mobile': $_SESSION['mode'] = 'mobile'; break;
    case 'desktop': $_SESSION['mode'] = 'desktop'; break;
}
$SETTINGS['SQL'] = mysql_query("SELECT * FROM settings");
while($SETTINGS = mysql_fetch_array($SETTINGS['SQL'])) {
if($SETTINGS['adult'] == '0') {
if($_SESSION['mode'] == '') { $SETTINGS['SQL'] = mysql_query("SELECT * FROM settings"); while($SETTINGS = mysql_fetch_array($SETTINGS['SQL'])) { include($document.'/themes/'.$SETTINGS['theme'].'/theme.tpl.php'); } }
if($_SESSION['mode'] == 'mobile') { $SETTINGS['SQL'] = mysql_query("SELECT * FROM settings"); while($SETTINGS = mysql_fetch_array($SETTINGS['SQL'])) { include($document.'/themes/'.$SETTINGS['theme'].'/mobile_theme.tpl.php'); } }
if($_SESSION['mode'] == 'desktop') { $SETTINGS['SQL'] = mysql_query("SELECT * FROM settings"); while($SETTINGS = mysql_fetch_array($SETTINGS['SQL'])) { include($document.'/themes/'.$SETTINGS['theme'].'/theme.tpl.php'); } }
}
}
?>
