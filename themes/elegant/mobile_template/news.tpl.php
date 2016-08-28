<?
$cat_query2 = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row2 = mysql_fetch_row($cat_query2); if($cat_row2['2'] == '') { $cat_row2 = 'other'; }else{ $cat_row2=$cat_row2['2']; } if($SETTINGS['permalink'] == 'gag') { $permalink2 = "/gag/".$next_media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { $permalink2 = "/".$cat_row2."/".$next_media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $permalink2 = "/".$cat_row2."/".slugify($next_media['title']); }
$cat_query3 = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row3 = mysql_fetch_row($cat_query3); if($cat_row3['2'] == '') { $cat_row3 = 'other'; }else{ $cat_row3=$cat_row3['2']; } if($prev_media['news_id'] == '') { $if_prev=$id; } if($SETTINGS['permalink'] == 'gag') { $permalink3 = "/gag/".$prev_media['news_id'].$if_prev; } elseif($SETTINGS['permalink'] == 'cat') { $permalink3 = "/".$cat_row3."/".$prev_media['news_id'].$if_prev; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $permalink3 = "/".$cat_row3."/".slugify($prev_media['title']).$if_prev; }
$cat_query4 = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row4 = mysql_fetch_row($cat_query4); if($cat_row4['2'] == '') { $cat_row4 = 'other'; }else{ $cat_row4=$cat_row4['2']; } if($prev_media['news_id'] == '') { $if_prev=$id; } if($SETTINGS['permalink'] == 'gag') { $permalink4 = "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { $permalink4 = "/".$cat_row4."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { $permalink4 = "/".$cat_row4."/".slugify($media['title']); }
?>
<ul class="big-list">
<li class="article">
<h2><a id="product_title" href="<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>"><?=$media['product_title']?></a></h2>
<div class="post-container"><a>
<? $cat_display = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_display_row = mysql_fetch_row($cat_display);
   if(($_COOKIE['age'] || $_COOKIE['age'] == '1')) { ?>

<? if($media['type'] == 'pic') {
      $media_photos = mysql_query("SELECT * FROM mouse_multiple WHERE post_id='".$media['news_id']."' ORDER BY media_id ASC");
      while($media_photo = mysql_fetch_array($media_photos)) {
        echo '<div class="gif-post"><img src='.$root."/uploads/media_photos/".$media_photo['file_name'].' width="630" alt="'.$media['title'].'" title="'.$media['title'].'"></div>';
      }
    }
   if($media['type'] == 'gif') { echo '</a><div class="gif-post"><img class="gif-image animation" id='.$media['news_id'].' src='.$root."/uploads/media_photos/".$media['thumb'].' data-animation='.$root."/uploads/media_photos/".$media['file'].' data-original='.$root."/uploads/media_photos/".$media['thumb'].' data-state="0" width="300"/> <span class="play">GIF</span></div>'; }
   if($media['type'] == 'vid') { echo(get_video_code($media['thumb'])); } ?>

<? } else {
		include('nsfw_full.tpl.php');
   } ?>


</div><!--end .post-continaer-->
<div class="post-function">
<? if(SHARE_SOCIAL_NETWORK_TURN == '1') { ?>
<ul class="social">
<li><a class="share facebook" onclick="javascript:fbshare('<?=$root;?><? $cat_query = mysql_query("SELECT * FROM categories WHERE id=".$media['cat'].""); $cat_row = mysql_fetch_row($cat_query); if($cat_row['2'] == '') { $cat_row = 'other'; }else{ $cat_row=$cat_row['2']; } if($SETTINGS['permalink'] == 'gag') { echo "/gag/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat') { echo "/".$cat_row."/".$media['news_id']; } elseif($SETTINGS['permalink'] == 'cat_slugify') { echo "/".$cat_row."/".slugify($media['title']); } ?>')">Facebook</a></li>
<li><? if($media['source']!="") {?><li><a class="share twitter" href="<?php echo $media['source']; ?>" target="_blank">Zur Website</a></li><? } ?> </li>

</ul>
<? } ?>
<ul class="horizontal-vote <? $query_distinct = mysql_query("SELECT * FROM votes WHERE news_id='".$media['id']."' AND user_id='".$members['id']."'");
if (mysql_num_rows($query_distinct) ){ echo "up"; } else { } ?>" id='vote_buttons<?php echo $media['id']; ?>'>
    <li><a class="up" href='javascript:;' id='<?=$media['id'];?>' user_id='<?=$members['id'];?>'><span>UP</span></a></li>
    <li><a class="down" href='javascript:;' id='<?=$media['id'];?>' user_id='<?=$members['id'];?>'><span>DOWN</span></a></li>
</ul>
</div><!--end post-function-->

<script>

jQuery(document).ready(function( $ ) {

 buyer_id = $("#member_id").val();

 $( "#buynow" ).click(function() {

   // if user not logged in then redirect to login else click event

   if(buyer_id == "")
     window.location.href='http://thai-park.com/view/login';
   else{

    data = new FormData();
    data.append( 'check_user_info', true);
    var URL = "../sources/nisgeo-post.php";

     fetch(URL, {
      method: 'post',
      mode: 'no-cors',
      credentials: "same-origin",
      body: data
    }).then(function(response){

          return response.json();
      })  .then(function(json){

        console.log(json.code);
        console.log(json.alert);
        if(json.code != 0){
          alert(json.alert);
        }
        else {
        //  $("#hidden_buy_now").click();
        //   console.log("clicked");

        $("#buynow").hide();
        $("#inline1").show();


        }

      })
        .catch(function(error){


        });




   }


 });

  $( "#cancel" ).click(function() {
    $("#inline1").hide();
    $("#buynow").show();
  });

 $( "#buy_confirm" ).click(function() {

   product_id = $( "#product_id" ).val();
   seller_id = $( "#seller_id" ).val();


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
    //   $.fancybox.close();
    //   console.log(json.code);
     //	$('#formpart2').show();
     //	$("#course_id").html(json.html);
//  return json_encode([ "html" => $html ]);
// forward to purchases
   window.location.href='http://www.thai-park.com/view/purchases';
     })
       .catch(function(error){
         $("#inline1").hide();
         $("#buynow").show();

       });

 });


/*    $('.fancybox').fancybox({
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
     });*/
});

</script>
<input type="hidden" id="member_id" value="<?php echo $members["id"] ?>" >
<div class="post-stats">
<p>
<? $domain = $root.$permalink4;$CommentQuery = mysql_query("SELECT * FROM comments WHERE domain = '".$domain."'");$effective_comments = mysql_num_rows($CommentQuery);$q = "SELECT * FROM votes WHERE news_id = '".$media['id']."'";$r = mysql_query($q);$effective_vote = mysql_num_rows($r);?>
<span class='votes_count' id='votes_count<?php echo $media['id']; ?>'><?php echo $effective_vote." Punkte"; ?></span>
</p><br>
</div>

</li>
<? $extra_menu2 = mysql_query("SELECT * FROM users WHERE id='".$media['author']."'");
   $remove_button2 = mysql_fetch_array($extra_menu2); ?>
<div style="margin:10px; background-color: #ffffff">
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

  	<div style="text-align:center">
      <?php if($members["id"] == $remove_button2['id']){ ?>

      <?php }else{ ?>
    	<button  id="buynow" style="background-color: #53a93f;border-color: #53a93f;padding: 5px 20px;font-weight: bold;color: #fff;" type="button">Buy now!</button>
      <a id="hidden_buy_now" style="display:none" class="fancybox" href="#inline1" title="Lorem ipsum dolor sit amet">test</a>
      <div id="inline1" style="width:400px;display: none;text-align: center;">
    		<h3 id="product_title_modal"></h3>

    			<br>
    		<p>
          Do you want to buy this product?
    		</p>
    			<br>
    	  <div >
    			<button id="cancel" style="background-color: red;border-color: red;padding: 5px 20px;font-weight: bold;color: #fff;" type="button">No</button>
    			<button id="buy_confirm" style="background-color: green;border-color: green;padding: 5px 20px;font-weight: bold;color: #fff;" type="button" >Yes</button>

    		</div>

    	</div>
<?php } ?>
  	</div>

	</div>

 </div>





 <div style="margin:10px;height: 100px;">
 <div style="padding:20px">

    <div style="float: left;margin-right: 10px;"><img src="http://thai-park.com/uploads/avatars/<? echo $remove_button2['photo']; ?>" alt="Avatar" height="80" width="80"></img> </div>
    <div style="float: left;">
      Seller

      <h3 style="padding-top:5px;padding-bottom:5px;"><? echo $remove_button2['first_name']." ".$remove_button2['last_name']; ?></h3>

      From <? echo country_code_to_country($remove_button2['country']); ?>

    </div>
 </div>

 </div>

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
<div id="nis-comments" width="100%" href="<? echo $root.$permalink4; ?>" user_id="<?=$members['id'];?>" news_id="<?=$media['id']?>" news_num="500" nis_key="278394375505800"></div>
</span>
</div></div>

<div id="facebook" class="post-comment" style="display:none"><div class="fb_iframe_widget">
<span id="fbcomments" style="">
<div class="fb-comments" data-href="<?=$root.$permalink4;?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
</span>
</div>

</div>
<? } ?>
</ul>
