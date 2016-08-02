<style>.box { width: 190px; }.box-media-title { width: 190px; text-align: center; }
.profile_content .box { width: 777px; } .profile_content .box a img { width: 100%; }.meme-grid .box { width: auto; }</style>
<div id="container">

<? $i = 7;
foreach(array_slice($news, $startResults, $resultsPerPage) as $user): 
?>
<div class="box">
<a href="<?=$root;?>/u/<?php echo str_replace(' ', '.', urldecode($user['username'])); ?>">
<? if($user['oauth_provider'] == '') {?><img src="<?=$root;?>/uploads/avatars/<?=$user['photo']?>" style="width: 100%;" alt="Avatar"><? }elseif($user['oauth_provider'] == 'facebook') {?><img src="<?=$user['photo']?>" style="width: 100%;" alt="Avatar"><? }elseif($user['oauth_provider'] == 'twitter') {?><img src="<?=$root;?>/uploads/avatars/<?=$user['photo']?>" style="width: 100%;" alt="Avatar"><? }?>
<div class="box-media-title"><?=$user['first_name']?> <?=$user['last_name']?></div>
</div>


<? $i++;
endforeach; ?>

</div>

<!-- contains the content to be loaded when scrolled -->
<nav id="page-nav">
<? if($_GET['page'] = '') { $page=$_GET['page']; } else { $page='1'; } ?>
  <a href="<?=$root;?>/?view=users&page=<?=$page+1;?>"></a>
</nav>