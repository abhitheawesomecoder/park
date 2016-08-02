<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="noindex,nofollow" />
<meta content="width=device-width, minimum-scale=1, maximum-scale=1" name="viewport">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><![endif]-->
<title><?=$PAGE_TITLE;?></title>
<link rel="stylesheet" type="text/css" href="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/mobile.css" />
<style>.masonry-brick { left: 320px; } <? if($view == 'login') { echo "html, body, .snap-content{ background:none; } .backstretch, #bgimage, .form-signin{ display:none; }"; } elseif($view == 'signup') { echo "html, body, .snap-content{ background:none; } .backstretch, #bgimage, .form-signin{ display:none; }"; } ?></style>
<? if($view == 'login') { ?>
<style>#Theme_Content { background: #f4f4f4; margin-top: 3px; min-height: 100%; position: relative; } #Theme_Content .Theme_Content_Wrap { width: 936px; min-height: 570px; margin: 0 auto; padding: 15px 15px; background: #fff; top: 0; left: 0; height: 100%; }</style>
<? } ?>
<style>
.fixed { position:fixed; }
</style>
</head>

<body>
<?=analytics;?>
<div id="fb-root"></div> 
<div class="snap-drawers">
<div class="snap-drawer snap-drawer-left" <? if($view == 'login') { echo "style='display: none;'"; } elseif($view == 'signup') { echo "style='display: none;'"; } ?>>
<? if($_SESSION['username']) { ?>
<div class="profile_snap_left"><a class="item profile" href="<?=$root;?>/u/<?=str_replace(' ', '.', urldecode($members['username']));?>"><? if($members['oauth_provider'] == '') {?><img src="<?=$root;?>/uploads/avatars/<?=$members['photo']?>" alt="Avatar"><? }elseif($members['oauth_provider'] == 'facebook') {?><img src="<?=$members['photo']?>" alt="Avatar"><? }elseif($members['oauth_provider'] == 'twitter') {?><img src="<?=$root;?>/uploads/avatars/<?=$members['photo']?>" alt="Avatar"><? }?><?=$members['username']?></a></div>
<div class="profile_snap_left"><a class="item profile" href="<?=$root;?>/view/upload" style="position:relative;line-height: 25px;left: 7px;font-size: 14px;"><?=$LANG['TITLE_UPLOAD_MEDIA'];?></a></div>
<? } ?>
<div class="search-form">
<form id="newsearchdiv" method="get" action="<?=$root;?>/?view=search">
<input class="tftextinput" id="tfq2b" name="view" value="search" type="hidden">
<input type="text" name="search" autocomplete="off" id="search" tabindex="1" placeholder="<?=$LANG['header_SEARCH_title'];?>..." value="" title="" class="search">
<input type="submit" id="go" class="go">
</form>
</div>

<ul style="margin-top: 43px; border-top: 1px solid #4E4E4E;"><? $SECTION['categories'] = mysql_query("SELECT * FROM categories WHERE status='on'");while($SECTION_categories_ROW = mysql_fetch_array($SECTION['categories'])) { ?><li><a href="<?=$root;?>/<?=$SECTION_categories_ROW['cat_id'];?>/"><?=$SECTION_categories_ROW['name'];?></a></li><? } ?><? $SECTION['pages'] = mysql_query("SELECT * FROM pages WHERE status='on'");while($SECTION_pages_ROW = mysql_fetch_array($SECTION['pages'])) { ?><li><a href="<?=$root;?>/<?=$SECTION_pages_ROW['page_id'];?>/"><?=$SECTION_pages_ROW['page_title'];?></a></li><? } ?></ul>

<a href="<?=$root;?>/index.php?version=desktop" style="color: #08f; width: 200px; text-align: center;"><?=$LANG['TITLE_DESKTOP_SITE'];?></a>

</div>


<div id="content" class="snap-content">
<div id="Theme_Header">
<header id="head-bar" class="nav-down">
<a class="header-icon header-icon-menu" href="#" id="open-left" <? if($view == 'login') { echo "style='display: none;'"; } elseif($view == 'signup') { echo "style='display: none;'"; } ?>>Menu</a>
<div class="header-logo-placeholder"><a id="header-logo" class="header-icon header-icon-logo menu-trigger" href="<?=$root;?>/" style="background: url(<? if($SETTINGS['logo'] == 'logo.png') { ?><?=$root;?>/themes/<?=$SETTINGS['theme'];?>/images/mobile_logo.png<? } else {?><?=$root;?>/themes/<?=$SETTINGS['theme'];?>/images/<?=LOGO;?><? }?>) center center no-repeat;background-size: 140px 27px;">Mouse Media Script</a></div>
<? if($_SESSION['username']){?><div style="right: 0px; position: absolute;"><a class="button blue right" href="<?=$root;?>/view/logout"><?=$LANG['TITLE_LOGOUT'];?></a></div><? } if(!isset($_SESSION['username'])) { if($view == 'login') { } else {?><div style="right: 10px; position: absolute;"><a class="button blue right" href="<?=$root;?>/view/login"><?=$LANG['TITLE_LOGIN'];?></a></div><? } if($view == 'login') { ?><div style="right: 10px; position: absolute;"><a class="button blue right" href="<?=$root;?>/view/signup"><?=$LANG['TITLE_SIGN_UP'];?></a></div><? } elseif($view == 'signup') {?><div style="right: 10px; position: absolute;"><a class="button blue right" href="<?=$root;?>/view/login"><?=$LANG['TITLE_LOGIN'];?></a></div><? } } ?>
</header>


<div id="content2" class="sidepanel-content">
<? include($document.'/themes/'.$SETTINGS['theme'].'/mobile_template/'.$view.'.tpl.php'); ?>
</div>

</div>

    
    
</div> <? // DIV #content ?>




</div>


<?  if(($_COOKIE['age_modal'] != '1')) {
	if($SETTINGS['age_18'] == '1') { ?>
<a href="#AGE_DISPLAY_FORM" id="hidden_age_link"></a>
<div id="AGE_DISPLAY_FORM" style="position: relative; z-index: 9999999999;">
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
<div id="age_form" class="Display_AGEFORM" style="width: 100%; overflow:hidden; text-align: center; padding: 10px 0px;">
<div class="Age_Form_Welcome" style="font-family: helvetica; font-weight: normal; letter-spacing: -1.6px; font-size: 47px !important; line-height: 1 !important;">
<?=$LANG['AGE_WELCOME'];?>
</div>
<div class="Age_Form_Title" style="width: 100%; margin: 0 auto; font-family: helvetica; font-size: 20px; padding: 20px 0px;">
<?=$LANG['AGE_I_AM_18_YEARS_OR_OLDER'];?>
</div>
<div class="Age_Form_Buttons" style="width: 100%; margin: 0 auto; font-family: helvetica; font-size: 40px; padding: 20px 0px;">
<a href="http://www.google.com/" class="leave_website" id="verify-age" style="font-size: 20px; color: #ffffff; background-color: <?=$SETTINGS['theme_buttons_color']?>; border-color: #cd2a19; padding: 5px 15px; border: 1px solid transparent; border-radius: 4px; cursor: pointer; position: relative; top: -10px;"><?=$LANG['AGE_LEAVE'];?></a>
<a href="javascript:void(0);" class="form_ver_age" style="font-size: 20px; color: #ffffff; background-color: <?=$SETTINGS['theme_buttons_color']?>; border-color: #cd2a19; padding: 5px 15px; border: 1px solid transparent; border-radius: 4px; cursor: pointer; position: relative; top: -10px;"><?=$LANG['AGE_I_AM_18'];?></a>
</div>

</div>

<div id="terms_form" class="Display_Recover" style="width: 100%; height: 520px; overflow:hidden;">
<div class="Age_Form_Welcome" style="text-align: center; font-family: helvetica; font-weight: normal; letter-spacing: -1.6px; font-size: 47px !important; line-height: 1 !important;">
<?=$LANG['AGE_TERMS_AND_CONDITIONS'];?>
</div>
<div id="innerContentArea" style="margin: 0; padding: 10px;">
<div id="tncBox" style="width: 90%;height: 300px;margin: 0 auto 10px auto;padding: 10px;border: 1px solid #ccc;overflow: auto;float: left;">
<div id="tncContent" style="padding: 0px;margin: 0px;"><?=$SETTINGS['terms_website']?></div>
</div>
</div>
<div style="clear: both;"></div>
<a onclick="verify_age_modal()" class="form_ver_age" style="font-size: 20px; color: #ffffff; background-color: <?=$SETTINGS['theme_buttons_color']?>; border-color: #cd2a19; padding: 10px 35px; border: 1px solid transparent; border-radius: 4px; cursor: pointer; position: relative; top: 22px; left: 10px;"><?=$LANG['AGE_ACCEPT_TERMS'];?></a>

</div>

</div>
<?  }
    } ?>
    
    
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<? if($SETTINGS['age_18'] == '1') { ?><? } else { ?>
<script type='text/javascript' src='http://code.jquery.com/jquery-git.js'></script>
<? } ?>

<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/cookie.js"></script>
<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/jquery.backstretch.min.js"></script>

<? if($SETTINGS['age_18'] == '1') { ?>
  <script type="text/javascript" src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/fancybox.js?v=2.0.6"></script>
<? } ?>

<script type="text/javascript">
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
});
	
	
	
(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));
    $(document).ready(function(){
        //images[Math.floor(Math.random() * images.length)]
        $.backstretch('<?=$root;?>/uploads/backgrounds/0<? if($_GET['view']=='login'){echo $_SESSION['background'];} elseif($_GET['view']=='signup'){ echo $_SESSION['background2']; }?>.jpg');
        position_elements();
    });

    $(window).resize(function(){
        position_elements();
    });
	
    function position_elements(){
        $('#bgimage').css('height', $(window).height());
        if($(window).height() > $('.form-signin').height() + 100){
            $('.form-signin').css('top', ( ($(window).height()/2) - ($('.form-signin').height()/2) ) - $('.nav-down').height() + 'px' );
        } else {
            $('.form-signin').css('top', '0px');
        }
        $('.backstretch, #bgimage, .form-signin').fadeIn();
    }

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
   $("#nis-comments").html("<iframe id='ifrm' onload='setIframeHeight(this.id)' scrolling='no' src='../sources/comments.php?nis_key="+nis_key+"&domain="+href+"&news_num="+news_num+"&news_id="+news_id+"&user_id="+user_id+"' width='100%' style='border: 0;'></iframe>");  
}
else {
   $("#nis-comments").html("<iframe id='ifrm' onload='setIframeHeight(this.id)' scrolling='no' src='../sources/comments.php?nis_key="+nis_key+"&domain="+href+"&news_num="+news_num+"&news_id="+news_id+"&user_id="+user_id+"' width='100%' style='border: 0;'></iframe>");  
}



});

<!--

//-->

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

	
$('document').ready(function(){

		$.each($('.article'), function(index, value){
			item_click_events($(value));
		});

	});
	
	
	function item_click_events(item){
		media_news_gif(item);
	}
	
	function media_news_gif(object){

		var gifs = $(object).find('.gif-post .animation');
		var gif_play = $(object).find('.play');

		gif_click(gifs);
		gif_click(gif_play);
	}

	function gif_click(object){
		$(object).click(function(){
			animated_gif = $(this).parent('.gif-post').find('.animation');
			play_icon = $(this).parent('.gif-post').find('.play');
			toggle_gif(animated_gif, play_icon);
		});
	}
	
	function toggle_gif(img, icon){
		if($(img).data('state') == 0){
			play_gif(img, icon);
		} else {
			stop_gif(img, icon);
		}
	}

	function play_gif(img, icon){
		$(img).attr('src', $(img).data('animation'));
		$(img).data('state', 1);
		$(icon).fadeOut();
	}

	function stop_gif(img, icon){
		$(img).attr('src', $(img).data('original'));
		$(img).data('state', 0);
		$(icon).fadeIn();
	}
	
	

//<![CDATA[ 
$(function(){
// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

jQuery(window).scroll(function () {
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);
});//]]>  

	function fbshare(url) {
		var left 	= (screen.width/2) - 333,
        	top 	= (screen.height/2) - 175;
        window.open ("http://www.facebook.com/share.php?u="+url,'Facebook', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=660, height=350, top=' + top + ', left=' + left);        
    }
	
	function twittershare(url) {
		var left 	= (screen.width/2) - 333,
        	top 	= (screen.height/2) - 175;
        window.open ("http://twitter.com/intent/tweet?source=tweetbutton&original_referer="+url+"&url="+url,'Twitter', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=660, height=350, top=' + top + ', left=' + left);        
    }
	
	function googleshare(url) {
		var left 	= (screen.width/2) - 333,
        	top 	= (screen.height/2) - 175;
        window.open ("https://plus.google.com/share?url="+url,'Google+', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=660, height=350, top=' + top + ', left=' + left);        
    }
	
function verify_age() {

		//get the id
		the_id = $(this).attr('class');
		$.cookie("age",1,{expires:30,path:'/',});
		location.reload();
	
	}
	
	function verify_age_modal() {
	
		//get the id
		the_id = $(this).attr('class');
		$.cookie("age_modal",1,{expires:30,path:'/',});
		window.location.reload(true);
	
	}
	
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
			url: "<?=$root;?>/sources/votes.php",
			success: function(msg)
			{
				$("span#votes_count"+the_id).html(msg);
				//fadein the vote count
				$("span#votes_count"+the_id).fadeIn();
				//remove the spinner
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
			url: "<?=$root;?>/sources/votes.php",
			success: function(msg)
			{
				$("span#votes_count"+the_id).fadeOut();
				$("span#votes_count"+the_id).html(msg);
				$("span#votes_count"+the_id).fadeIn();
			}
		});
	});
});	


$(function () {
     $('.snap-content').removeClass('snap_overflow');
 });

// Snap Function
(function(win, doc) {
    'use strict';
    var Snap = Snap || function(userOpts) {
        var settings = {
            element: null,
            dragger: null,
            disable: 'none',
            addBodyClasses: true,
            hyperextensible: true,
            resistance: 0.5,
            flickThreshold: 50,
            transitionSpeed: 0.3,
            easing: 'ease',
            maxPosition: 265,
            minPosition: -265,
            tapToClose: true,
            touchToDrag: true,
            slideIntent: 40, // degrees
            minDragDistance: 5
        },
        cache = {
            simpleStates: {
                opening: null,
                towards: null,
                hyperExtending: null,
                halfway: null,
                flick: null,
                translation: {
                    absolute: 0,
                    relative: 0,
                    sinceDirectionChange: 0,
                    percentage: 0
                }
            }
        },
        eventList = {},
        utils = {
            hasTouch: ('ontouchstart' in doc.documentElement || win.navigator.msPointerEnabled),
            eventType: function(action) {
                var eventTypes = {
                        down: (utils.hasTouch ? 'touchstart' : 'mousedown'),
                        move: (utils.hasTouch ? 'touchmove' : 'mousemove'),
                        up: (utils.hasTouch ? 'touchend' : 'mouseup'),
                        out: (utils.hasTouch ? 'touchcancel' : 'mouseout')
                    };
                return eventTypes[action];
            },
            page: function(t, e){
                return (utils.hasTouch && e.touches.length && e.touches[0]) ? e.touches[0]['page'+t] : e['page'+t];
            },
            klass: {
                has: function(el, name){
                    return (el.className).indexOf(name) !== -1;
                },
                add: function(el, name){
                    if(!utils.klass.has(el, name) && settings.addBodyClasses){
                        el.className += " "+name;
                    }
					
                },
                remove: function(el, name){
                    if(settings.addBodyClasses){
                        el.className = (el.className).replace(name, "").replace(/^\s+|\s+$/g, '');
						$('.snap-content').removeClass('snap_overflow');
                    }
                }
            },
            dispatchEvent: function(type) {
                if (typeof eventList[type] === 'function') {
                    return eventList[type].call();
                }
            },
            vendor: function(){
                var tmp = doc.createElement("div"),
                    prefixes = 'webkit Moz O ms'.split(' '),
                    i;
                for (i in prefixes) {
                    if (typeof tmp.style[prefixes[i] + 'Transition'] !== 'undefined') {
                        return prefixes[i];
                    }
                }
            },
            transitionCallback: function(){
                return (cache.vendor==='Moz' || cache.vendor==='ms') ? 'transitionend' : cache.vendor+'TransitionEnd';
            },
            canTransform: function(){
                return typeof settings.element.style[cache.vendor+'Transform'] !== 'undefined';
            },
            deepExtend: function(destination, source) {
                var property;
                for (property in source) {
                    if (source[property] && source[property].constructor && source[property].constructor === Object) {
                        destination[property] = destination[property] || {};
                        utils.deepExtend(destination[property], source[property]);
                    } else {
                        destination[property] = source[property];
                    }
                }
                return destination;
            },
            angleOfDrag: function(x, y) {
                var degrees, theta;
                // Calc Theta
                theta = Math.atan2(-(cache.startDragY - y), (cache.startDragX - x));
                if (theta < 0) {
                    theta += 2 * Math.PI;
                }
                // Calc Degrees
                degrees = Math.floor(theta * (180 / Math.PI) - 180);
                if (degrees < 0 && degrees > -180) {
                    degrees = 360 - Math.abs(degrees);
                }
                return Math.abs(degrees);
            },
            events: {
                addEvent: function addEvent(element, eventName, func) {
                    if (element.addEventListener) {
                        return element.addEventListener(eventName, func, false);
                    } else if (element.attachEvent) {
                        return element.attachEvent("on" + eventName, func);
                    }
		

                },
                removeEvent: function addEvent(element, eventName, func) {
                    if (element.addEventListener) {
                        return element.removeEventListener(eventName, func, false);
                    } else if (element.attachEvent) {
                        return element.detachEvent("on" + eventName, func);
                    }
                },
                prevent: function(e) {
                    if (e.preventDefault) {
                        e.preventDefault();
                    } else {
                        e.returnValue = false;
                    }
                }
            },
            parentUntil: function(el, attr) {
                var isStr = typeof attr === 'string';
                while (el.parentNode) {
                    if (isStr && el.getAttribute && el.getAttribute(attr)){
                        return el;
                    } else if(!isStr && el === attr){
                        return el;
                    }
                    el = el.parentNode;
                }
                return null;
            }
        },
        action = {
            translate: {
                get: {
                    matrix: function(index) {

                        if( !utils.canTransform() ){
                            return parseInt(settings.element.style.left, 10);
                        } else {
                            var matrix = win.getComputedStyle(settings.element)[cache.vendor+'Transform'].match(/\((.*)\)/),
                                ieOffset = 8;
                            if (matrix) {
                                matrix = matrix[1].split(',');
                                if(matrix.length===16){
                                    index+=ieOffset;
                                }
                                return parseInt(matrix[index], 10);
                            }
                            return 0;
                        }
                    }
                },
                easeCallback: function(){
                    settings.element.style[cache.vendor+'Transition'] = '';
                    cache.translation = action.translate.get.matrix(4);
                    cache.easing = false;
                    clearInterval(cache.animatingInterval);

                    if(cache.easingTo===0){
                        utils.klass.remove(doc.body, 'snapjs-right');
                        utils.klass.remove(doc.body, 'snapjs-left');
                    }

                    utils.dispatchEvent('animated');
                    utils.events.removeEvent(settings.element, utils.transitionCallback(), action.translate.easeCallback);
                },
                easeTo: function(n) {

                    if( !utils.canTransform() ){
                        cache.translation = n;
                        action.translate.x(n);
                    } else {
                        cache.easing = true;
                        cache.easingTo = n;

                        settings.element.style[cache.vendor+'Transition'] = 'all ' + settings.transitionSpeed + 's ' + settings.easing;

                        cache.animatingInterval = setInterval(function() {
                            utils.dispatchEvent('animating');
                        }, 1);
                        
                        utils.events.addEvent(settings.element, utils.transitionCallback(), action.translate.easeCallback);
                        action.translate.x(n);
                    }
                    if(n===0){
                           settings.element.style[cache.vendor+'Transform'] = '';
                       }
                },
                x: function(n) {
                    if( (settings.disable==='left' && n>0) ||
                        (settings.disable==='right' && n<0)
                    ){ return; }
                    
                    if( !settings.hyperextensible ){
                        if( n===settings.maxPosition || n>settings.maxPosition ){
                            n=settings.maxPosition;
                        } else if( n===settings.minPosition || n<settings.minPosition ){
                            n=settings.minPosition;
                        }
                    }
                    
                    n = parseInt(n, 10);
                    if(isNaN(n)){
                        n = 0;
                    }

                    if( utils.canTransform() ){
						$('.snap-content').addClass('snap_overflow');
                        var theTranslate = 'translate3d(' + n + 'px, 0,0)';
                        settings.element.style[cache.vendor+'Transform'] = theTranslate;
                    } else {
                        settings.element.style.width = (win.innerWidth || doc.documentElement.clientWidth)+'px';
						
                        settings.element.style.left = n+'px';
                        settings.element.style.right = '';
                    }
                }
            },
            drag: {
                listen: function() {
                    cache.translation = 0;
                    cache.easing = false;
                    utils.events.addEvent(settings.element, utils.eventType('down'), action.drag.startDrag);
                    utils.events.addEvent(settings.element, utils.eventType('move'), action.drag.dragging);
                    utils.events.addEvent(settings.element, utils.eventType('up'), action.drag.endDrag);
                },
                stopListening: function() {
                    utils.events.removeEvent(settings.element, utils.eventType('down'), action.drag.startDrag);
                    utils.events.removeEvent(settings.element, utils.eventType('move'), action.drag.dragging);
                    utils.events.removeEvent(settings.element, utils.eventType('up'), action.drag.endDrag);
                },
                startDrag: function(e) {
                    // No drag on ignored elements
                    var target = e.target ? e.target : e.srcElement,
                        ignoreParent = utils.parentUntil(target, 'data-snap-ignore');
                    
                    if (ignoreParent) {
                        utils.dispatchEvent('ignore');
                        return;
                    }
                    
                    
                    if(settings.dragger){
                        var dragParent = utils.parentUntil(target, settings.dragger);
                        
                        // Only use dragger if we're in a closed state
                        if( !dragParent && 
                            (cache.translation !== settings.minPosition && 
                            cache.translation !== settings.maxPosition
                        )){
                            return;
                        }
                    }
                    
                    utils.dispatchEvent('start');
                    settings.element.style[cache.vendor+'Transition'] = '';
                    cache.isDragging = true;
                    cache.hasIntent = null;
                    cache.intentChecked = false;
                    cache.startDragX = utils.page('X', e);
                    cache.startDragY = utils.page('Y', e);
                    cache.dragWatchers = {
                        current: 0,
                        last: 0,
                        hold: 0,
                        state: ''
                    };
                    cache.simpleStates = {
                        opening: null,
                        towards: null,
                        hyperExtending: null,
                        halfway: null,
                        flick: null,
                        translation: {
                            absolute: 0,
                            relative: 0,
                            sinceDirectionChange: 0,
                            percentage: 0
                        }
                    };
                },
                dragging: function(e) {
                    if (cache.isDragging && settings.touchToDrag) {

                        var thePageX = utils.page('X', e),
                            thePageY = utils.page('Y', e),
                            translated = cache.translation,
                            absoluteTranslation = action.translate.get.matrix(4),
                            whileDragX = thePageX - cache.startDragX,
                            openingLeft = absoluteTranslation > 0,
                            translateTo = whileDragX,
                            diff;

                        // Shown no intent already
                        if((cache.intentChecked && !cache.hasIntent)){
                            return;
                        }

                        if(settings.addBodyClasses){
                            if((absoluteTranslation)>0){
								
								$('.snap-content').addClass('snap_overflow');
                                utils.klass.add(doc.body, 'snapjs-left');
                                utils.klass.remove(doc.body, 'snapjs-right');
                            } else if((absoluteTranslation)<0){
                                utils.klass.add(doc.body, 'snapjs-right');
                                utils.klass.remove(doc.body, 'snapjs-left');
                            }
                        }

                        if (cache.hasIntent === false || cache.hasIntent === null) {
                            var deg = utils.angleOfDrag(thePageX, thePageY),
                                inRightRange = (deg >= 0 && deg <= settings.slideIntent) || (deg <= 360 && deg > (360 - settings.slideIntent)),
                                inLeftRange = (deg >= 180 && deg <= (180 + settings.slideIntent)) || (deg <= 180 && deg >= (180 - settings.slideIntent));
                            if (!inLeftRange && !inRightRange) {
                                cache.hasIntent = false;
                            } else {
                                cache.hasIntent = true;
                            }
                            cache.intentChecked = true;
                        }

                        if (
                            (settings.minDragDistance>=Math.abs(thePageX-cache.startDragX)) || // Has user met minimum drag distance?
                            (cache.hasIntent === false)
                        ) {
                            return;
                        }

                        utils.events.prevent(e);
                        utils.dispatchEvent('drag');

                        cache.dragWatchers.current = thePageX;
                        // Determine which direction we are going
                        if (cache.dragWatchers.last > thePageX) {
                            if (cache.dragWatchers.state !== 'left') {
                                cache.dragWatchers.state = 'left';
                                cache.dragWatchers.hold = thePageX;
                            }
                            cache.dragWatchers.last = thePageX;
                        } else if (cache.dragWatchers.last < thePageX) {
                            if (cache.dragWatchers.state !== 'right') {
                                cache.dragWatchers.state = 'right';
                                cache.dragWatchers.hold = thePageX;
                            }
                            cache.dragWatchers.last = thePageX;
                        }
                        if (openingLeft) {
                            // Pulling too far to the right
                            if (settings.maxPosition < absoluteTranslation) {
                                diff = (absoluteTranslation - settings.maxPosition) * settings.resistance;
                                translateTo = whileDragX - diff;
                            }
                            cache.simpleStates = {
                                opening: 'left',
                                towards: cache.dragWatchers.state,
                                hyperExtending: settings.maxPosition < absoluteTranslation,
                                halfway: absoluteTranslation > (settings.maxPosition / 2),
                                flick: Math.abs(cache.dragWatchers.current - cache.dragWatchers.hold) > settings.flickThreshold,
                                translation: {
                                    absolute: absoluteTranslation,
                                    relative: whileDragX,
                                    sinceDirectionChange: (cache.dragWatchers.current - cache.dragWatchers.hold),
                                    percentage: (absoluteTranslation/settings.maxPosition)*100
                                }
                            };
                        } else {
                            // Pulling too far to the left
                            if (settings.minPosition > absoluteTranslation) {
                                diff = (absoluteTranslation - settings.minPosition) * settings.resistance;
                                translateTo = whileDragX - diff;
                            }
                            cache.simpleStates = {
                                opening: 'right',
                                towards: cache.dragWatchers.state,
                                hyperExtending: settings.minPosition > absoluteTranslation,
                                halfway: absoluteTranslation < (settings.minPosition / 2),
                                flick: Math.abs(cache.dragWatchers.current - cache.dragWatchers.hold) > settings.flickThreshold,
                                translation: {
                                    absolute: absoluteTranslation,
                                    relative: whileDragX,
                                    sinceDirectionChange: (cache.dragWatchers.current - cache.dragWatchers.hold),
                                    percentage: (absoluteTranslation/settings.minPosition)*100
                                }
                            };
                        }
                        action.translate.x(translateTo + translated);
                    }
                },
                endDrag: function(e) {
					
                    if (cache.isDragging) {
                        utils.dispatchEvent('end');
                        var translated = action.translate.get.matrix(4);

                        // Tap Close
                        if (cache.dragWatchers.current === 0 && translated !== 0 && settings.tapToClose) {
                            utils.dispatchEvent('close');
                            utils.events.prevent(e);
                            action.translate.easeTo(0);

                            cache.isDragging = false;
                            cache.startDragX = 0;
                            return;
                        }

                        // Revealing Left
                        if (cache.simpleStates.opening === 'left') {
                            // Halfway, Flicking, or Too Far Out
                            if ((cache.simpleStates.halfway || cache.simpleStates.hyperExtending || cache.simpleStates.flick)) {
                                if (cache.simpleStates.flick && cache.simpleStates.towards === 'left') { // Flicking Closed
                                    action.translate.easeTo(0);
                                } else if (
                                    (cache.simpleStates.flick && cache.simpleStates.towards === 'right') || // Flicking Open OR
                                    (cache.simpleStates.halfway || cache.simpleStates.hyperExtending) // At least halfway open OR hyperextending
                                ) {
                                    action.translate.easeTo(settings.maxPosition); // Open Left
                                }
                            } else {
								
                                action.translate.easeTo(0); // Close Left
                            }
					
                            // Revealing Right
                        } else if (cache.simpleStates.opening === 'right') {
                            // Halfway, Flicking, or Too Far Out
                            if ((cache.simpleStates.halfway || cache.simpleStates.hyperExtending || cache.simpleStates.flick)) {
                                if (cache.simpleStates.flick && cache.simpleStates.towards === 'right') { // Flicking Closed
                                    action.translate.easeTo(0);
                                } else if (
                                    (cache.simpleStates.flick && cache.simpleStates.towards === 'left') || // Flicking Open OR
                                    (cache.simpleStates.halfway || cache.simpleStates.hyperExtending) // At least halfway open OR hyperextending
                                ) {
                                    action.translate.easeTo(settings.minPosition); // Open Right
                                }
                            } else {
                                action.translate.easeTo(0); // Close Right
                            }
                        }
                        cache.isDragging = false;
                        cache.startDragX = utils.page('X', e);
                    }
                }
            }
        },
        init = function(opts) {
            if (opts.element) {
                utils.deepExtend(settings, opts);
                cache.vendor = utils.vendor();
                action.drag.listen();
            }
        };
        /*
         * Public
         */
        this.open = function(side) {
            utils.dispatchEvent('open');
            utils.klass.remove(doc.body, 'snapjs-expand-left');
            utils.klass.remove(doc.body, 'snapjs-expand-right');

            if (side === 'left') {
                cache.simpleStates.opening = 'left';
                cache.simpleStates.towards = 'right';
                utils.klass.add(doc.body, 'snapjs-left');
                utils.klass.remove(doc.body, 'snapjs-right');
                action.translate.easeTo(settings.maxPosition);
            } else if (side === 'right') {
                cache.simpleStates.opening = 'right';
                cache.simpleStates.towards = 'left';
                utils.klass.remove(doc.body, 'snapjs-left');
                utils.klass.add(doc.body, 'snapjs-right');
                action.translate.easeTo(settings.minPosition);
            }
        };
        this.close = function() {
            utils.dispatchEvent('close');
            action.translate.easeTo(0);
        };
        this.expand = function(side){
            var to = win.innerWidth || doc.documentElement.clientWidth;

            if(side==='left'){
                utils.dispatchEvent('expandLeft');
                utils.klass.add(doc.body, 'snapjs-expand-left');
                utils.klass.remove(doc.body, 'snapjs-expand-right');
            } else {
                utils.dispatchEvent('expandRight');
                utils.klass.add(doc.body, 'snapjs-expand-right');
                utils.klass.remove(doc.body, 'snapjs-expand-left');
                to *= -1;
            }
            action.translate.easeTo(to);
        };

        this.on = function(evt, fn) {
            eventList[evt] = fn;
            return this;
        };
        this.off = function(evt) {
            if (eventList[evt]) {
                eventList[evt] = false;
            }
        };

        this.enable = function() {
            utils.dispatchEvent('enable');
            action.drag.listen();
        };
        this.disable = function() {
            utils.dispatchEvent('disable');
            action.drag.stopListening();
        };

        this.settings = function(opts){
            utils.deepExtend(settings, opts);
        };

        this.state = function() {
            var state,
                fromLeft = action.translate.get.matrix(4);
            if (fromLeft === settings.maxPosition) {
                state = 'left';
            } else if (fromLeft === settings.minPosition) {
                state = 'right';
            } else {
                state = 'closed';
            }
            return {
                state: state,
                info: cache.simpleStates
            };
        };
        init(userOpts);
    };
    if ((typeof module !== 'undefined') && module.exports) {
        module.exports = Snap;
    }
    if (typeof ender === 'undefined') {
        this.Snap = Snap;
    }
    if ((typeof define === "function") && define.amd) {
        define("snap", [], function() {
            return Snap;
        });
    }
}).call(this, window, document);


<? if($view == 'login') { } else { 
   if($view == 'signup') { } else {?>	
    var snapper = new Snap({
        element: document.getElementById('content'),
        disable: 'right'
    });
var addEvent = function addEvent(element, eventName, func) {
	if (element.addEventListener) {
    	return element.addEventListener(eventName, func, false);
    } else if (element.attachEvent) {
        return element.attachEvent("on" + eventName, func);
    }
};
 <? } } ?>
 
addEvent(document.getElementById('open-left'), 'click', function(){
	snapper.open('left');
	$('.snap-content').addClass('snap_overflow');
});

/* Prevent Safari opening links when viewing as a Mobile App */
(function (a, b, c) {
    if(c in b && b[c]) {
        var d, e = a.location,
            f = /^(a|html)$/i;
        a.addEventListener("click", function (a) {
            d = a.target;
            while(!f.test(d.nodeName)) d = d.parentNode;
            "href" in d && (d.href.indexOf("http") || ~d.href.indexOf(e.host)) && (a.preventDefault(), e.href = d.href)
        }, !1)
    }
})(document, window.navigator, "standalone");

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