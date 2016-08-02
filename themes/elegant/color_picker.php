<? if($SETTINGS['box_type'] == 'big') { $box_type = "630"; $box_type_width = "800"; } elseif($SETTINGS['box_type'] == 'small') { $box_type = "300"; $box_type_width = "377"; } ?>
<? if($view == 'account') {?>.box { width: <?=$box_type_width;?>px; } .profile_content .box img { width: <?=$box_type_width;?>px; }<? } else { ?>.box { width: <?=$box_type;?>px; }<? } ?>
.box-media-title { width: <?=$box_type - 20;?>px; }
<? if($SETTINGS['box_type'] == 'big') {?>.profile_content .box { width: <?=$box_type_width - 23;?>px; } .profile_content .box img { width: <?=$box_type_width - 23;?>px; }<? }?>
.meme-grid .box { width: auto; }