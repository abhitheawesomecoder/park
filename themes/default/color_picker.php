<? if($SETTINGS['box_type'] == 'big') { $box_type = "630"; } elseif($SETTINGS['box_type'] == 'small') { $box_type = "300"; } ?>
.box { width: <?=$box_type;?>px; }
.box-media-title { width: <?=$box_type - 20;?>px; }
<? if($SETTINGS['box_type'] == 'big') {?>.profile_content .box { width: <?=$box_type - 10;?>px; }<? }?>
.meme-grid .box { width: auto; }
.Theme_Header_Bar a.selected span.label { color: <?=$SETTINGS['theme_color']?>; border-color: <?=$SETTINGS['theme_color']?>; }
a.upload { background-color: <?=$SETTINGS['theme_color']?>; }
#toggle_cat a:hover { background-color: <?=$SETTINGS['theme_color']?>; }
#toggle_avatar a:hover { background-color: <?=$SETTINGS['theme_color']?>; }
input[type='submit'] { background-color: <?=$SETTINGS['theme_buttons_color']?>; border: 1px solid <?=$SETTINGS['theme_buttons_color']?>; }
.others_popup a:hover { background-color: <?=$SETTINGS['theme_color']?>; }
.post-nav a.next span.label { background-color: <?=$SETTINGS['theme_color']?>; }
.post-nav a.next span.arrow { border-left: 12px solid <?=$SETTINGS['theme_color']?>; }
a.btn.red{background-color:<?=$SETTINGS['theme_color']?>;}
#Theme_Sidebar { background: <?=$SETTINGS['theme_sidebar_color']?>; }
#Theme_Sidebar2 { background: <?=$SETTINGS['theme_sidebar_color']?>; }
#setting input[type='submit'] { background-color:<?=$SETTINGS['theme_buttons_color']?>; border-color:<?=$SETTINGS['theme_buttons_color']?>; }
.box { background: <?=$SETTINGS['theme_media_box_color']?>; border-color: <?=$SETTINGS['theme_media_box_border_color']?>; }
.box:hover { background-color: <?=$SETTINGS['theme_media_box_hover_color']?>; }

header#Theme_Header_Nav { background-color: <?=$SETTINGS['theme_header_color']?>; }
.Theme_Header_Bar a { color: <?=$SETTINGS['theme_header_text_color']?>; }
div.sign_in { color: <?=$SETTINGS['theme_header_auth_box_text_color']?>; background-color: <?=$SETTINGS['theme_header_auth_box_color']?>; }
.toggle_avatar span.name { color: <?=$SETTINGS['theme_header_text_color']?>; }
#Theme_Content { background: <?=$SETTINGS['theme_content_color']?>; }
#Theme_Content .Theme_Content_Wrap { background: <?=$SETTINGS['theme_inner_content_color']?>; }
#Theme_Sidebar .Title { color: <?=$SETTINGS['theme_sidebar_text_color']?>; }