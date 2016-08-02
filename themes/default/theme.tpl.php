<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:b='http://www.google.com/2005/gml/b' xmlns:data='http://www.google.com/2005/gml/data' xmlns:expr='http://www.google.com/2005/gml/expr' xmlns:fb='http://www.facebook.com/2008/fbml' xmlns:og='http://ogp.me/ns#'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="icon" type="image/ico" href="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/images/<?=FAVICON;?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/images/<?=FAVICON;?>" />
<title><?=$PAGE_TITLE;?></title>
<? if($_GET['view'] == 'news') {?>
<?
$cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { $permalink = "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { $permalink = "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $permalink = "/".$cat_row."/".slugify($media['title']); }

$fbURL = 'https://developers.facebook.com/tools/debug/og/object?q=';
$shareURL = $root.$permalink;
$excuteURL = $fbURL.urlencode($shareURL)."&format=json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $excuteURL);
//curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
$data = curl_exec($ch);
curl_close($ch);
?>
<meta name="robots" content="noodp" />
<meta name="twitter:card" content="photo" />
<meta name="twitter:site" content="@<?=WEBSITE_NAME;?>" />
<meta name="twitter:image" content="<?=$root;?>/uploads/facebook.php?filename=<?
   if($media['type'] == 'pic') { echo $root.'/uploads/media_photos/'.$media['file']; }
   if($media['type'] == 'gif') { echo $root."/uploads/media_photos/".$media['thumb']; }
   if($media['type'] == 'vid') { echo $root."/uploads/media_photos/".$media['file']; }
?>" />
<meta property="og:title" content="<?=$media['title'];?>" />
<meta property="og:site_name" content="<?=WEBSITE_NAME;?>" />
<meta property="og:url" content="<?=$root.$permalink?>" />
<meta property="og:description" content="Hier klicken um das Foto und den Beitrag zu sehen!" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?=$root;?>/uploads/facebook.php?filename=<?
   if($media['type'] == 'pic') { echo $root.'/uploads/media_photos/'.$media['file']; }
   if($media['type'] == 'gif') { echo $root."/uploads/media_photos/".$media['thumb']; }
   if($media['type'] == 'vid') { echo $root."/uploads/media_photos/".$media['file']; }
?>" />
<meta property="fb:app_id" content="<?=APP_ID;?>" />
<? } else { ?>
<meta name="keywords" content="<?=$settings['website_keywords'];?>" />
<meta name="description" content="<?=$settings['website_description'];?>" />
<meta name="robots" content="noodp" />
<meta property="og:title" content="<?=$settings['website_name'];?>" />
<meta property="og:site_name" content="<?=$settings['website_name'];?>" />
<meta property="og:url" content="<?=$root;?>/" />
<meta property="og:description" content="<?=INDEX_PAGE_TITLE;?>" />
<meta property="og:type" content="blog" />
<meta property="og:image" content="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/images/<?=LOGO;?>" />
<meta property="fb:app_id" content="<?=APP_ID;?>" />
<? } ?>
<? if($_GET['view'] == 'meme' && $_GET['action'] == 'show' && $_GET['c']) {?>
	<meta name="og:title" content="Share Meme" />
	<meta name="og:url" content="<?=$root;?>/view/meme/action/show/<?=$_GET['c'];?>" />
    <meta name="og:image" content="<?php echo $root."/uploads/meme_photos/".$_GET['c']; ?>.jpg" />
<? }?>
<link rel="stylesheet" type="text/css" href="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/main.css" />
<link rel="stylesheet" type="text/css" href="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/fonts.css" />
<style>.canvas_width { width: 600px; }</style>
<style>.backstretch, #bgimage, .Theme_Container { display:none; }</style>
<? if($view == 'signup') { ?><style>#Theme_Content { background: #f4f4f4; margin-top: 3px; min-height: 100%; position: relative; } #Theme_Content .Theme_Content_Wrap { width: 936px; min-height: 570px; margin: 0 auto; padding: 15px 15px; background: #fff; top: 0; left: 0; height: 100%; }</style><? } ?>
<? $views_match = $_GET['view']; if($views_match == 'login') { ?><script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script><? } else { if($views_match == 'signup') { ?><script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script><? } else { ?><script src="//code.jquery.com/jquery-1.6.2.min.js"></script><? } } ?>
<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/isotope.js" type="text/javascript"></script> 
<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/cookie.js"></script>
<style><? if($SETTINGS['theme_color']) { include($document.'/themes/'.$SETTINGS['theme'].'/color_picker.php'); } ?></style>
<? if($SETTINGS['age_18'] == '1') { ?>
  <script type="text/javascript" src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/fancybox.js?v=2.0.6"></script>
<? } ?>
</head>

<body> <!--<? if($view == 'login') { echo "style='overflow-y: hidden;'"; } elseif($view == 'signup') { echo "style='overflow-y: hidden;'"; } elseif($view == 'adults_page') { echo "style='overflow-y: hidden;'"; } ?>-->
<?=analytics;?>
<div id="fb-root"></div> 
<div id="Theme_Header">
<header id="Theme_Header_Nav" <?php if($view == 'news') { } else { ?>style="position: fixed;"<? } ?>>
<div class="Theme_Header_Nav_Wrap">
<h1><a id="logo" class="type2" href="<?=$root;?>/" style="background: url(<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/images/<?=LOGO;?>) left center no-repeat;">MEDIA SCRIPT</a></h1>
<div class="Theme_Header_Bar" <? if($SETTINGS['logo_text']=='') { echo "style='margin-left: 0px;'"; }?>>
<ul>
<li><a <? if($view == 'index') { ?>class="selected"<? } ?> href="<?=$root;?>/"><span class="label"><?=$LANG['header_HOME_title'];?></span></a></li>
<li><a <? if($view == 'popular') { ?>class="selected"<? } ?> class="" href="<?=$root;?>/view/popular"><span class="label"><?=$LANG['header_POPULAR_title'];?></span></a></li>
<li><a href="javascript: void(0);" class="toggle_cat <? if($view == 'cat') { ?>selected<? } ?>"><span class="label"><?=$LANG['header_CATEGORIES_title'];?></span></a></li>
</ul>
</div>
<div style="float: left; margin: 0 auto;position: relative;top: 7px;z-index: 999;"><? $random_media = get_random_news(); ?> <a href="<?=$root;?><? $random_cat_query = mysql_query("SELECT * FROM categories WHERE id=".$random_media['cat'].""); $random_cat_row = mysql_fetch_row($random_cat_query); if($random_cat_row['2'] == '') { $random_cat_row = 'other'; }else{ $random_cat_row=$random_cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$random_media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$random_cat_row."/".$random_media['news_id']; } ?>" style="border-bottom-left-radius: 5px;width: 38px;height: 28px;display: block;"><img src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/images/media-shuffle.png" width="28" style="margin-left: 2px;"></a></div>

<? if(SEARCH_TURN == '1') { ?>
<div class="search-form">
<form id="newsearchdiv" method="get" action="<?=$root;?>/?view=search">
<input class="tftextinput" id="tfq2b" name="view" value="search" type="hidden">
<input type="text" name="search" autocomplete="off" id="search" tabindex="1" placeholder="<?=$LANG['header_SEARCH_title'];?>..." value="" title="" class="search">
<input type="submit" id="go" class="go">
</form>
</div>
<? } ?>

<div style="float: right;">
<div class="upload"><a class="upload" <? if(!isset($_SESSION['username'])) { echo 'href="'.$root.'/view/login"'; } else { echo 'href="'.$root.'/view/upload"'; } ?>><?=$LANG['header_UPLOAD_title'];?></a></div>
<? if(!isset($_SESSION['username'])) { ?>
<div class="sign_in"><a class="asignhref" href="<?=$root;?>/view/login"><?=$LANG['header_LOGIN_title'];?></a> &nbsp;|&nbsp;  <a class="asignhref" href="<?=$root;?>/view/signup"><?=$LANG['header_SIGNUP_title'];?></a></div>
<? } else { ?>
<div class="avatar">
<a class="toggle_avatar" href="javascript:void(0);">
<? if($members['oauth_provider'] == '') {?><img src="<?=$root;?>/uploads/avatars/<?=$members['photo']?>" alt="Avatar"><? }elseif($members['oauth_provider'] == 'facebook') {?><img src="<?=$members['photo']?>" alt="Avatar"><? }elseif($members['oauth_provider'] == 'twitter') {?><img src="<?=$root;?>/uploads/avatars/<?=$members['photo']?>" alt="Avatar"><? }?>
  <span class="name"><?=$LANG['header_PROFILE_title'];?></span>
  <div class="drop-arrow"></div>
</a>
</div>

<div id="toggle_avatar">
<ul>
<? if($members['admin'] == '1') { ?>
<li><a href="<?=$root;?>/view/admin"><?=$LANG['header_ADMIN_title'];?></a></li>
<? } ?>
<li><a href="<?=$root;?>/u/<?=str_replace(' ', '.', urldecode($members['username']));?>"><?=$LANG['header_MYPROFILE_title'];?></a></li>
<li><a href="<?=$root;?>/user/settings"><?=$LANG['header_SETTINGS_title'];?></a></li>
<li><a href="<?=$root;?>/view/logout"><?=$LANG['header_LOGOUT_title'];?></a></li>
</ul>
</div>

<? } ?>
</div>     

<div id="toggle_cat">
<ul><? $SECTION['categories'] = mysql_query("SELECT * FROM categories WHERE status='on'");while($SECTION_categories_ROW = mysql_fetch_array($SECTION['categories'])) { ?><li><a href="<?=$root;?>/<?=$SECTION_categories_ROW['cat_id'];?>/"><?=$SECTION_categories_ROW['name'];?></a></li><? } ?></ul>
</div>

</div>
</header>
</div>

<? if(header_advert_turn == '1') {?>
<div style="margin: 0 auto; width: 966px; margin-top: 5px; margin-bottom: -2px;">
<?=header_advert;?>
</div>
<? } ?>
<? $views= $_GET['view']; ?>
<div id="Theme_Content" <? if($view == 'login') { echo "style='background: #fff;'"; } elseif($view == 'signup') { echo "style='background: #fff;'"; } ?>>
<div class="Theme_Content_Wrap" <? if($view == 'account') { echo "style='min-height: 870px;'"; } if($view == 'login') { echo "style='background: rgba(0, 0, 0, 0.0);'"; } elseif($view == 'signup') { echo "style='background: rgba(0, 0, 0, 0.0);'"; } ?>>
<div class="Theme_Content_Wrap_Discover" <? if($views == 'news') {?>style="margin-top: 0px;"<? } else { if($views == 'account') { } else {?>style="margin-top: -58px;"<? } }?>>
<? if($THEME_CONTENT_WRAP_RIGHT == 'on') {?> <div class="Theme_Content_Wrap_Left" <? if($views == 'account') {?>style="width: 500px;"<? }?>> <? } ?>
<? include($document.'/themes/'.$SETTINGS['theme'].'/template/'.$view.'.tpl.php'); ?>
<? if($THEME_CONTENT_WRAP_RIGHT == 'on') {?> </div> <? } ?>

<? if($THEME_CONTENT_WRAP_RIGHT == 'on') {?> 
<div class="Theme_Content_Wrap_Right">

<? if(TURN_OTHER_SIDEBAR == '0') { ?>
<? if($views == 'account') {?><div style="margin-bottom: -55px;"></div><? }?>
<div id="Theme_Sidebar" <? if($views == 'news') {?>style="margin-top: 0px;"<? } else { if($views == 'account') {?>style="margin-top: 43px;"<? } else {?>style="margin-top: 43px;"<? } }?>>
<div class="Title"><?=SIDEBAR_TITLE;?></div>
<div id="Content" class="Content">
<script type="text/javascript">var generateHere = document.getElementById("Content"); generateHere.innerHTML = '<?=ADVERT_BIG;?>';</script><br>
<div class="facebook-div"><iframe style="border:none; overflow:hidden; width:100%;margin-left: 5px; margin-top: 5px;" scrolling="no" frameborder="0" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2F<?=FACEBOOK_PAGE_ID?>&amp;width&amp;height=62&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=275182462632454" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:62px;" allowTransparency="true"></iframe></div>

</div>
</div>
<? } else { ?>
<? if($views == 'account') {?><div style="margin-bottom: -55px;"></div><? }?><? if($views == 'news') {?><div style="margin-bottom: -58px;"></div><? }?>
<div id="Theme_Sidebar2" style="position: relative;padding-top: 10px;margin-top: 43px;" <? if($views == 'news') {?>style="margin-top: 43px;"<? } else { if($views == 'account') {?>style="margin-top: 43px;"<? } else {?>style="margin-top: 43px;"<? } }?>>

<center><?=ADVERT_BIG;?></center>


<br>

<div class="block-feature-cover"> <!-- block-feature-cover -->
<h2 class="sidebar-title"><?=$LANG['TITLE_FEATURED'];?></h2><br>
<center><ul>
<? $FEATURED_POSTS = get_featured_posts();
   $i = 25;
foreach(array_slice($FEATURED_POSTS, $startResults, $resultsPerPage) as $SECTION_featured_ROW): 
?>
<li class="badge-featured-item" style="min-height: 106px;">
<div class="img-container">
<a href="<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$SECTION_featured_ROW['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$SECTION_featured_ROW['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$SECTION_featured_ROW['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($SECTION_featured_ROW['title']); } ?>" class="badge-evt" target="_blank">
<? if($SECTION_featured_ROW['type'] == 'pic') { echo '<div class="gif-post"><img src='.$root."/uploads/media_photos/".$SECTION_featured_ROW['file'].' width="'.$box_type.'" alt="'.$SECTION_featured_ROW['title'].'" title="'.$media['title'].'"></a></div>'; }
   if($SECTION_featured_ROW['type'] == 'gif') { echo '</a><div class="gif-post"><img class="gif-image animation" id='.$SECTION_featured_ROW['news_id'].' src='.$root."/uploads/media_photos/".$SECTION_featured_ROW['thumb'].' data-animation='.$root."/uploads/media_photos/".$SECTION_featured_ROW['file'].' data-original='.$root."/uploads/media_photos/".$SECTION_featured_ROW['thumb'].' data-state="0" width="'.$box_type.'" /> <span class="play" style="top: 50px;">GIF</span></div>'; }
   if($SECTION_featured_ROW['type'] == 'vid') { echo '<div class="gif-post"><img src='.$root."/uploads/media_photos/".$SECTION_featured_ROW['file'].' width="'.$box_type.'"><span class="play_video" style="top: 50px;">VIDEO</span></a></div>'; } ?>
</a>
</div>
<div class="info-container" data-item-id="3564"><h3><a href="<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$SECTION_featured_ROW['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$SECTION_featured_ROW['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$SECTION_featured_ROW['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($SECTION_featured_ROW['title']); } ?>" class="badge-evt" target="_blank"><?=$SECTION_featured_ROW['title'];?></a></h3></div>
</li>
<? if ($i % 8 == 0) { echo "<li>".ADVERT_BIG."</li>"; } ?>
<? $i++;
endforeach; ?>
</ul>
<div id="nisid-featured-sidebar">
<div id="nisid_sidebar_advert"><?=ADVERT_BIG;?></div><br>
</div>
</div> <!-- block-feature-cover -->





</div>

<? } ?>
</div>
<? } ?>
</div>
</div>



</div>











<?  if(($_COOKIE['age_modal'] != '1')) {
	if($SETTINGS['age_18'] == '1') { ?>
<a href="#AGE_DISPLAY_FORM" id="hidden_age_link"></a>
<div id="AGE_DISPLAY_FORM">
<style>
.Display_None {
	display: none;
}
.terms_form {
	display: none;
}
.Display_Block {
	display: block;
}
#tncContent p {
margin: 0 0 1.5em;
}
</style>
<div id="age_form" class="Display_AGEFORM" style="width: 1000px; height: 565px; overflow:hidden; text-align: center; padding: 50px 0px;">
<div class="Age_Form_Welcome" style="font-family: helvetica; font-weight: normal; letter-spacing: -1.6px; font-size: 77px !important; line-height: 1 !important;">
<?=$LANG['AGE_WELCOME'];?>
</div>
<div class="Age_Form_Title" style="width: 900px; margin: 0 auto; font-family: helvetica; font-size: 40px; padding: 80px 0px;">
<?=$LANG['AGE_I_AM_18_YEARS_OR_OLDER'];?>
</div>
<div class="Age_Form_Buttons" style="width: 900px; margin: 0 auto; font-family: helvetica; font-size: 40px; padding: 80px 0px;">
<a href="http://www.google.com/" class="leave_website" id="verify-age" style="font-size: 20px; color: #ffffff; background-color: <?=$SETTINGS['theme_buttons_color']?>; border-color: #cd2a19; padding: 10px 35px; margin-left: 30px; border: 1px solid transparent; border-radius: 4px; cursor: pointer; position: relative; top: -10px;"><?=$LANG['AGE_LEAVE'];?></a>
<a href="javascript:void(0);" class="form_ver_age" style="font-size: 20px; color: #ffffff; background-color: <?=$SETTINGS['theme_buttons_color']?>; border-color: #cd2a19; padding: 10px 35px; border: 1px solid transparent; border-radius: 4px; cursor: pointer; position: relative; top: -10px;"><?=$LANG['AGE_I_AM_18'];?></a>
</div>

</div>

<div id="terms_form" class="Display_Recover" style="width: 1000px; height: 565px; overflow:hidden;">
<div class="Age_Form_Welcome" style="text-align: center; font-family: helvetica; font-weight: normal; letter-spacing: -1.6px; font-size: 77px !important; line-height: 1 !important;">
<?=$LANG['AGE_TERMS_AND_CONDITIONS'];?>
</div>
<div id="innerContentArea" style="margin: 0; padding: 10px;">
<div id="tncBox" style="width: 955px;height: 370px;margin: 0 auto 10px auto;padding: 10px;border: 1px solid #ccc;overflow: auto;float: left;">
<div id="tncContent" style="padding: 0px;margin: 0px;"><?=$SETTINGS['terms_website']?></div>
</div>
</div>
<a onclick="verify_age_modal()" class="form_ver_age" style="font-size: 20px; color: #ffffff; background-color: <?=$SETTINGS['theme_buttons_color']?>; border-color: #cd2a19; padding: 10px 35px; border: 1px solid transparent; border-radius: 4px; cursor: pointer; position: relative; top: 22px; left: 10px;"><?=$LANG['AGE_ACCEPT_TERMS'];?></a>

</div>

</div>
<?  }
    } ?>
<script type="text/javascript" src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/main.js"></script>
<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/jquery.backstretch.min.js"></script>
<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/moment_date.js"></script>
<script>

$(document).ready(function(){
<?  if(($_COOKIE['age_modal'] != '1')) {
	if($SETTINGS['age_18'] == '1') { ?>
$("#hidden_age_link").fancybox({
	closeClick: false, // prevents closing when clicking INSIDE fancybox 
    helpers: { overlay: { closeClick: false } }, // prevents closing when clicking OUTSIDE fancybox
    afterShow: function() {
        $(".fancybox-close").hide(); // hide close button
        setTimeout(function() {
            $(".fancybox-close").fadeIn();
        }, 10000); // show close button after 10 seconds
	}
}).trigger('click');
jQuery(".Display_Recover").addClass('Display_None');
$(".form_ver_age").click(function(){
	$(".Display_Recover").fadeIn("slow");
	jQuery(".Display_Recover").addClass('Display_Block');
	jQuery(".Display_AGEFORM").addClass('Display_None');
});
<?  }
    } ?>
	

    $('#logo').hover(function () { 
        var $imgObj = $(this);

        // class name
        var sClass = $(this).attr('class');

        // radius
        var iRad = 0;

        // interval
        var iInt;
        if (iInt) window.clearInterval(iInt);

        // loop until end
        iInt = window.setInterval(function() {
            var iWidth = $imgObj.width();
            var iHalfWidth = iWidth / 2;
            var iHalfHeight = $imgObj.height() / 2;

            if (sClass == 'type1') {
                $imgObj.css('-webkit-mask', '-webkit-gradient(radial, '+iHalfWidth+' '+iHalfHeight+', '+ iRad +', '+iHalfWidth+' '+iHalfHeight+', '+ (iRad + 20) +', from(rgb(0, 0, 0)), color-stop(0.5, rgba(0, 0, 0, 0.2)), to(rgb(0, 0, 0)))');
            } else if (sClass == 'type2') {
                $imgObj.css('-webkit-mask', '-webkit-gradient(radial, '+iHalfHeight+' '+iHalfHeight+', '+ iRad +', '+iHalfHeight+' '+iHalfHeight+', '+ (iRad + 20) +', from(rgb(0, 0, 0)), color-stop(0.5, rgba(0, 0, 0, 0.2)), to(rgb(0, 0, 0)))');
            }

            // when radius is more than our width - stop loop
            if (iRad > iWidth) {
                window.clearInterval(iInt);
            }

            iRad+=2;
        }, 10);
    }); 
});


function checkform() 
{
if(document.myForm_Lost.lost_email.value == "") 
{
    
}
else
{
	alert("<?=$LANG['alert_FORGOTPASSWORD_title'];?>."); 
    document.myForm_Lost.submit();
}
}

$(document).ready(function(){
$(".forgot-password").click(function(){
	$(".Display_Recover").fadeIn("slow");
	jQuery(".Display_Recover").addClass('Display_Block');
	jQuery(".Display_Login").addClass('Display_None');
});
$(".thick").click(function(){
	$(".badge-delete-confirm-form").fadeIn("slow");
	jQuery(".badge-delete-confirm-form").addClass('Display_Block');
});
});

$(document).ready(function(){
    $(".bgimage").backstretch("<?=$root;?>/uploads/backgrounds/0<? if($_GET['view']=='login'){echo $_SESSION['background'];} elseif($_GET['view']=='signup'){ echo $_SESSION['background2']; }?>.jpg");
    position_elements();
});

$(window).resize(function(){
        position_elements();
});

function position_elements(){
	    $('#Theme_Sidebar').css('height', $(window).height());
        $('#bgimage').css('height', $(window).height());
        if($(window).height() > $('.Theme_Container').height() + 100){
            $('.Theme_Container').css('top', ( ($(window).height()/2) - ($('.Theme_Container').height()/2) ) - $('#Theme_Header').height() + 'px' );
        } else {
            $('.Theme_Container').css('top', '0px');
        }
        $('.backstretch, #bgimage, .Theme_Container').fadeIn();
}
<? if($_GET['view'] != 'login' && $_GET['view'] != 'signup') { ?>
// Cache selectors outside callback for performance. 
   var $window = $(window),
       $stickyEl = $('#nisid-featured-sidebar'),
       elTop = $stickyEl.offset().top;

   $window.scroll(function() {
        $stickyEl.toggleClass('sticky', $window.scrollTop() > elTop);
    });
<? } ?>
</script>
<script>
<!--
function swap(site, fb) {
    document.getElementById(site).style.display = 'block';
    document.getElementById(fb).style.display = 'none';
}
$('.comments-option').click(function(){
			var comment_type = $(this).data('comments');
			$('#site, #facebook').hide();
			$(comment_type).show();
			$('.comments-option').removeClass('selected');
			$(this).addClass('selected');
});//-->
$(document).ready(function () { $(".customize_wallpaper").fadeIn('slow'); $(".customize_wallpaper").click(function (e) { e.stopPropagation();$("#customize_wallpaper").fadeToggle(50);});$(document).click(function () {var $el = $("#customize_wallpaper");if ($el.is(":visible")) {$el.fadeIn(50);$el.fadeOut(50);}});});</script>
<script type="text/javascript">

function showMe (box) {
        var chboxs = document.getElementsByName("source");
        var vis = "none";
        for(var i=0;i<chboxs.length;i++) { 
            if(chboxs[i].checked){
             vis = "block";
                break;
            }
        }
        document.getElementById(box).style.display = vis;
}
	


//<![CDATA[ 
function getDocHeight(doc) {
    doc = doc || document;
    // from http://stackoverflow.com/questions/1145850/get-height-of-entire-document-with-javascript
    var body = doc.body, html = doc.documentElement;
    var height = Math.max( body.scrollHeight, body.offsetHeight, 
        html.clientHeight, html.scrollHeight, html.offsetHeight );
    return height;
    }

	function setIframeHeight(id) {
    var ifrm = document.getElementById(id);
    var doc = ifrm.contentDocument? ifrm.contentDocument: ifrm.contentWindow.document;
    ifrm.style.visibility = 'hidden';
    ifrm.style.height = "50px"; // reset to minimal height in case going from longer to shorter doc
    // some IE versions need a bit added or scrollbar appears
    ifrm.style.height = getDocHeight( doc ) + 54 + "px";
    ifrm.style.visibility = 'visible';
    }

 function iframeLoaded() {
      var iFrameID = document.getElementById('ifrm');
      if(iFrameID) {
            // here you can make the height, I delete it first, then I make it again
            iFrameID.height = "";
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
      }   
  }

$(document).ready(function() {
	var href = '';
	var user_id = '';
	var news_num = '';
	var nis_key = '';
	var width = '';
	var news_id = '';
	var path = window.location.protocol + '//' + window.location.host + '/';
	jQuery('#nis-comments').each(function () {
    href += $(this).attr('href') + ' ';
	user_id += $(this).attr('user_id') + ' ';
	news_num += $(this).attr('news_num') + ' ';
	nis_key += $(this).attr('nis_key') + ' ';
	width += $(this).attr('width') + ' ';
	news_id += $(this).attr('news_id') + ' ';
	});


if ($(window).width() < 1280) {
   $("#nis-comments").html("<iframe id='ifrm' onload='setIframeHeight(this.id)' scrolling='no' src='../sources/comments.php?nis_key="+nis_key+"&domain="+href+"&news_num="+news_num+"&news_id="+news_id+"&user_id="+user_id+"' width='630' style='border: 0;'></iframe>");  
}
else {
   $("#nis-comments").html("<iframe id='ifrm' onload='setIframeHeight(this.id)' scrolling='no' src='../sources/comments.php?nis_key="+nis_key+"&domain="+href+"&news_num="+news_num+"&news_id="+news_id+"&user_id="+user_id+"' width='630' style='border: 0;'></iframe>");  
}



});

<!--

//-->

//]]>  
(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));
$(document).ready(function () { $("#bgimageffghet").fadeIn('slow'); $(".toggle_avatar").click(function (e) { e.stopPropagation();$("#toggle_avatar").fadeToggle(50);});$(document).click(function () {var $el = $("#toggle_avatar");if ($el.is(":visible")) {$el.fadeIn(50);$el.fadeOut(50);}});});
$(document).ready(function () { $("#bgimageffghet").fadeIn('slow'); $(".toggle_cat").click(function (e) { e.stopPropagation();$("#toggle_cat").fadeToggle(50);});$(document).click(function () {var $el = $("#toggle_cat");if ($el.is(":visible")) {$el.fadeIn(50);$el.fadeOut(50);}});});$(document).ready(function() {if (window.history && history.pushState) {historyedited = false;$(window).bind('popstate', function(e) {if (historyedited) {loadContent(location.pathname + location.search);}});doPager();}});function doPager() {$('body #Theme_Flexible').click(function(e) {e.preventDefault();loadContent($(this).attr('href'));history.pushState(null, null, $(this).attr('href'));historyedited = true;});}function loadContent(url) {$('.Theme_Content_Wrap_Discover').empty().addClass('loading').load(url + ' .Theme_Content_Wrap_Discover', function() {$('#Theme_Content').removeClass();doPager();});}

/**
 * cbpFWTabs.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
;( function( window ) {
	
	'use strict';

	function extend( a, b ) {
		for( var key in b ) { 
			if( b.hasOwnProperty( key ) ) {
				a[key] = b[key];
			}
		}
		return a;
	}

	function CBPFWTabs( el, options ) {
		this.el = el;
		this.options = extend( {}, this.options );
  		extend( this.options, options );
  		this._init();
	}

	CBPFWTabs.prototype.options = {
		start : 0
	};

	CBPFWTabs.prototype._init = function() {
		// tabs elemes
		this.tabs = [].slice.call( this.el.querySelectorAll( 'nav > ul > .click_tab' ) );
		// content items
		this.items = [].slice.call( this.el.querySelectorAll( '.content > section' ) );
		// current index
		this.current = -1;
		// show current content item
		this._show();
		// init events
		this._initEvents();
	};

	CBPFWTabs.prototype._initEvents = function() {
		var self = this;
		this.tabs.forEach( function( tab, idx ) {
			tab.addEventListener( 'click', function( ev ) {
				ev.preventDefault();
				self._show( idx );
			} );
		} );
	};

	CBPFWTabs.prototype._show = function( idx ) {
		if( this.current >= 0 ) {
			this.tabs[ this.current ].className = '';
			this.items[ this.current ].className = '';
		}
		// change current
		this.current = idx != undefined ? idx : this.options.start >= 0 && this.options.start < this.items.length ? this.options.start : 0;
		this.tabs[ this.current ].className = 'tab-current';
		this.items[ this.current ].className = 'content-current';
	};

	// add to global namespace
	window.CBPFWTabs = CBPFWTabs;

})( window );


new CBPFWTabs(document.getElementById('tabs'));


function updateCountdown() {
    // 140 is the max message length
    var remaining = 120 - jQuery('.upload_textarea1').val().length;
	var remaining2 = 120 - jQuery('.upload_textarea2').val().length;
	var remaining3 = 120 - jQuery('.upload_textarea3').val().length;
    jQuery('#count_upload1').text(remaining + '');
	jQuery('#count_upload2').text(remaining2 + '');
	jQuery('#count_upload3').text(remaining3 + '');
}
jQuery(document).ready(function($) {
    updateCountdown();
    $('.upload_textarea1').change(updateCountdown);
    $('.upload_textarea1').keyup(updateCountdown);
	$('.upload_textarea2').change(updateCountdown);
    $('.upload_textarea2').keyup(updateCountdown);
	$('.upload_textarea3').change(updateCountdown);
    $('.upload_textarea3').keyup(updateCountdown);
});


</script>
</body>
</html>