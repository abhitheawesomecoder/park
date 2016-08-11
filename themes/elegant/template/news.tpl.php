<?
	// --- PERMALINK --- //
	$permalink_cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $permalink_cat_row = mysql_fetch_array($permalink_cat_query);
	if($settings['permalink'] == '1') {
		$permalink = '/'.$permalink_cat_row['cat_id'].'/'.$media['news_id'];
	} elseif($settings['permalink'] == '2') {
		$permalink = '/'.$permalink_cat_row['cat_id'].'/'.$media['news_id'].'.html';
	}
	// --- PERMALINK --- //
?>
<div style="width: 630px;">
	 <input type="hidden" id="product_id" value="<?php echo $media['id'] ?>" >
<h2  id="product_title" style="font-size: 26px; line-height: 1.3em; margin-bottom: 7px; font-family: Arial,Helvetica,Geneva,sans-serif;"><?=$media['product_title'];?></h2>

<? $domain = $root.$permalink; $CommentQuery = mysql_query("SELECT * FROM comments WHERE domain = '".$domain."'");$effective_comments = mysql_num_rows($CommentQuery);$q = "SELECT * FROM votes WHERE news_id = '".$media['id']."'";$r = mysql_query($q);$effective_vote = mysql_num_rows($r);?>
<span class='votes_count' id='votes_count<?php echo $media['id']; ?>'><?php echo $effective_vote." ".$LANG['points_title'].""; ?></span>

<a class="comments_num" href="#site">
<span><?=$effective_comments?></span> <?=$LANG['comments_title'];?></a>
<br />
<br />
<? $cat_display = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_display_row = mysql_fetch_row($cat_display);
   if(($_COOKIE['age'] || $_COOKIE['age'] == '1')) { ?>

<?
    if($media['type'] == 'pic') {
      $media_photos = mysql_query("SELECT * FROM mouse_multiple WHERE post_id='".$media['news_id']."' ORDER BY media_id ASC");
      while($media_photo = mysql_fetch_array($media_photos)) {
        echo '<img src='.$root."/uploads/media_photos/".$media_photo['file_name'].' width="630" alt="'.$media['title'].'" title="'.$media['title'].'">';
      }
    }
    if($media['type'] == 'gif') { echo '<img src='.$root."/uploads/media_photos/".$media['file'].' width="630">'; }
    if($media['type'] == 'vid') { echo(get_video_code($media['thumb'])); }
?>

<br />

<? } else {
		include('nsfw_full.tpl.php');
   } ?>
<div style="width: 630px; background-color: #ffffff">
	<div style="padding:20px">
		<h3>Description:</h3>
		<br>
		<? if($media['description'] == '') { }else{?><div style='margin-top: 5px; margin-bottom:5px;'><?=LINKS_CLICKABLE($media['description']);?></div><? } ?>
  	<br>
		<div style="height: 50px;">

			<div style="float:left">
				Payment By: Paypal, Bank
			</div>

			<div style="float:right">
				<b><? echo $media['product_currency']." ".$media['product_price'];?></b>
				<br>
				+shipping
			</div>

		</div>
<script>

$( document ).ready(function() {
	$( "#buynow" ).click(function() {

		$("#hidden_buy_now").click();

	});

	$( "#buy_confirm" ).click(function() {

		product_id = $( "#product_id" ).val();
		seller_id = $( "#seller_id" ).val();
		buyer_id = $("#member_id").val();
		console.log(product_id);
		console.log(seller_id);

		data = new FormData();
    data.append( 'product_id', product_id );
		data.append( 'seller_id', seller_id );
		data.append( 'buyer_id', buyer_id );

		data.append( 'buy_product', true);
		var URL = "../sources/mouse_auth.php";

		 fetch(URL, {
			method: 'post',
			mode: 'no-cors',
			credentials: "same-origin",
			body: data
		}).then(function(response){

					return response.json();
			})  .then(function(json){
			  $.fancybox.close();
				console.log(json.code);
			//	$('#formpart2').show();
			//	$("#course_id").html(json.html);
//  return json_encode([ "html" => $html ]);
			})
				.catch(function(error){
					  $.fancybox.close();

				});

	});

    $('.fancybox').fancybox({
			afterLoad : function() {
			$("#product_title_modal").text($("#product_title").text());

			},
				helpers : {
					title : null,
					overlay : {
						css : {
							'background-color' : '#eee',
							opacity    : 0.5
						}
					}
				}
			});
});

</script>
<input type="hidden" id="member_id" value="<?php echo $members["id"] ?>" >
  	<div style="text-align:center">
      <button onclick="window.location.href='http://thai-park.com/view/messages/new'" style="background-color: orange;border-color: orange;padding: 5px 20px;font-weight: bold;color: #fff;" type="button">Contact seller</button>
			<button id="buynow" style="background-color: #53a93f;border-color: #53a93f;padding: 5px 20px;font-weight: bold;color: #fff;" type="button">Buy now!</button>
      <a id="hidden_buy_now" style="display:none" class="fancybox" href="#inline1" title="Lorem ipsum dolor sit amet">test</a>
		</div>

	<div id="inline1" style="width:400px;display: none;text-align: center;">
		<h3 id="product_title_modal"></h3>

			<br>
		<p>
      Do you want to buy this product?
		</p>
			<br>
	  <div >
			<button onclick="javascript:jQuery.fancybox.close();" style="background-color: red;border-color: red;padding: 5px 20px;font-weight: bold;color: #fff;" type="button">No</button>
			<button id="buy_confirm" style="background-color: green;border-color: green;padding: 5px 20px;font-weight: bold;color: #fff;" type="button" >Yes</button>

		</div

	</div>

	</div>

 </div>

 <div style="width: 630px;height: 100px;">
	<div style="padding:20px">
		<? $extra_menu2 = mysql_query("SELECT * FROM users WHERE id='".$media['author']."'");
		   $remove_button2 = mysql_fetch_array($extra_menu2); ?>
			 <input type="hidden" id="seller_id" value="<?php echo $remove_button2['id'] ?>" >
		 <div style="float: left;margin-right: 10px;"><img src="http://thai-park.com/uploads/avatars/<? echo $remove_button2['photo']; ?>" alt="Avatar" height="80" width="80"></img> </div>
		 <div style="float: left;">
			 Seller

			 <h3 style="padding-top:5px;padding-bottom:5px;"><? echo $remove_button2['first_name']." ".$remove_button2['last_name']; ?></h3>

			 From <? echo country_code_to_country($remove_button2['country']); ?>

		 </div>
	</div>

 </div>

<div id="fixed-toolbar" style="width: 630px; height: 2px; z-index: 999999; padding: 10px 0;"><div style="">

<ul class="horizontal-vote <? $query_distinct = mysql_query("SELECT * FROM votes WHERE news_id='".$media['id']."' AND user_id='".$members['id']."'");
if (mysql_num_rows($query_distinct) ){ echo "up"; } else { } ?>" id='vote_buttons<?php echo $media['id']; ?>'>
    <li><a class="up" href='javascript:;' id='<?=$media['id'];?>' user_id='<?=$members['id'];?>'><span>UP</span></a></li>
    <li><a class="down" href='javascript:;' id='<?=$media['id'];?>' user_id='<?=$members['id'];?>'><span>DOWN</span></a></li>
</ul>
<? if(SHARE_SOCIAL_NETWORK_TURN == '1') { ?>
<div class="share">
<ul>
    <li><a class="btn-share facebook" onclick="javascript:fbshare('<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>')">Facebook</a></li>
    <li><a class="btn-share twitter" onclick="javascript:twittershare('<?=$media['title']?>','<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>')" data_title="<?=$media['title']?>">Twitter</a></li>
    <li><a class="btn-share google" onclick="javascript:googleshare('<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>')" data_title="<?=$media['title']?>">Google</a></li>
    <li><? if($media['source']!="") {?><li><a class="btn-share" href="<?php echo $media['source']; ?>" target="_blank" style="background:
#53a840; padding: 0 19px 0 21px;">Zur Website</a></li><? } ?> </li>
</ul>
</div>
<? } ?>


</div></div><br />

<div class="post-afterbar-meta">
<? $extra_menu = mysql_query("SELECT * FROM users WHERE id='".$media['author']."'");
   $remove_button = mysql_fetch_array($extra_menu); ?>
<p><?=$media['date']?> <?=$LANG['by_title'];?> <a href="<?=$root;?>/u/<?=str_replace(' ', '.', urldecode($remove_button['username']));?>" target="_blank"><?=$remove_button['username'];?></a>
<? if($remove_button['id'] == $members['id']) { ?>
· <a class="" href="<?=$root;?>/gag/delete/<?=$media['news_id'];?>" onclick="return confirm('<?=$LANG['confirm_to_delete_this_post'];?>');"><?=$LANG['delete_title'];?></a>
<? }?>
</p></div>


<? if(COMMENTS_TURN == '1') { ?>
<div id="comments_form">
<div class="comments_navigation">
<div class="comments_option">
<ul>
<li><a class="comments-option site selected" data-comments="#site" href="javascript:void(0);"><?=$LANG['comments_title'];?> (<span class="badge-item-comment-count"><?=$effective_comments;?></span>)</a></li>

</ul>
</div>
</div>

<div id="site" class="post-comment">
<span style="width: 630px;">
<div id="nis-comments" theme="<?=$SETTINGS['theme'];?>" width="631" href="<? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query);  if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { $link = "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { $link = "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $link = "/".$cat_row."/".slugify($media['title']); } echo $root.$link; ?>" user_id="<?=$members['id'];?>" news_id="<?=$media['id']?>" news_num="500" nis_key="278394375505800"></div>
</span>
</div></div>

<div id="facebook" class="post-comment" style="display:none"><div class="fb_iframe_widget">
<span style="height: 160px; width: 630px;">
<div class="fb-comments" data-href="<?=$root.$link;?>" data-width="630" data-numposts="5" data-colorscheme="light"></div>
</span>
</div>

</div>
<? } ?>





</div>
