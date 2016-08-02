<? $members = get_members($id); ?>
<div style="min-height: 800px;">
<div style="position: fixed;" ><br>
<br>
<form id="social_password" action="" method="POST" enctype="multipart/form-data">
<h2><?=$LANG['Password_title'];?><? if($members['oauth_provider'] == 'twitter') { ?> <?=$LANG['and_email'];?><? } ?></h2><br><br>

<? if($members['oauth_provider'] == 'twitter') { ?>
<div class="field">
    <label><?=$LANG['EMAIL_title'];?></label>
    <input type="email" name="email" value="" style="border: 1px solid #ddd;">
    
</div>
<? } ?>


<div class="field">
    <label><?=$LANG['New_Password_title'];?></label>
    <input type="password" name="password" value="" maxlength="15" style="border: 1px solid #ddd;">
    
</div>

<div class="field">
    <label><?=$LANG['Re_New_Password_title'];?></label>
    <input type="password" name="re_password" value="" maxlength="15" style="border: 1px solid #ddd;">
</div>


<div class="btn-container">
<input name="social_password_submit" type="submit" value="<?=$LANG['save_changes_title'];?>">
</div>

</form>


</div>
</div>