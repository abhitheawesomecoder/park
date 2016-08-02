<? $members = get_members($id); ?>
<style>.field {margin: 10px 10px;padding-right: 30px;}</style>
<div style="width: 100%;overflow: hidden; padding:10px;"><br>

<form id="social_password" action="" method="POST" enctype="multipart/form-data">
<h2><?=$LANG['Password_title'];?><? if($members['oauth_provider'] == 'twitter') { ?> <?=$LANG['and_email'];?><? } ?></h2><br><br>

<? if($members['oauth_provider'] == 'twitter') { ?>
<div class="field">
    <label><?=$LANG['EMAIL_title'];?></label>
    <input type="email" name="email" value="" style="width: 100%; padding-right: 0px;border: 1px solid #ddd;">
    
</div>
<? } ?>


<div class="field">
    <label><?=$LANG['New_Password_title'];?></label>
    <input type="password" name="password" value="" maxlength="15" style="width: 100%; padding-right: 0px;border: 1px solid #ddd;">
    
</div>

<div class="field">
    <label><?=$LANG['Re_New_Password_title'];?></label>
    <input type="password" name="re_password" value="" maxlength="15" style="width: 100%; padding-right: 0px;border: 1px solid #ddd;">
</div>


<div id="btn-container2" style="margin-left:10px; margin-top: 30px;">
<input name="social_password_submit" type="submit" value="<?=$LANG['save_changes_title'];?>">
</div>

</form>


</div>