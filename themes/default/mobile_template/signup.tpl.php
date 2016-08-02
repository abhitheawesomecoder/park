<div class="Theme_Container" style="margin-top: -20px;">

<form class="Theme_Container_Form" name="" action="" method="POST">
<h2><?=$LANG['signup_title'];?></h2>
<p class="Lead_Title"><?=$LANG['connect_with_a_social_network'];?></p>
<div class="social-signup">
<a class="btn-connect-option facebook" href="<?=$root;?>/?login&oauth_provider=facebook">Facebook</a>
<a class="btn-connect-option twitter" href="<?=$root;?>/?login&oauth_provider=twitter">Twitter</a>
</div>
<p class="Lead_Title"><?=$LANG['sign_up_with_your_email_adress'];?> </p>
<div class="field">
<input name="register_username" type="text" id="Field_Value" value="" placeholder="<?=$LANG['Username_title'];?>" autofocus="autofocus" style="border-width: 1px; border-color: #A0A0FF;">
</div>
<div class="field">
<input name="register_email" type="text" id="Field_Value" value="" placeholder="<?=$LANG['Email_title'];?>" style="border-width: 1px; border-color: #A0A0FF;">
</div>
<div class="field">
<input name="register_password" type="password" id="Field_Value" value="" placeholder="<?=$LANG['Password_title'];?>" style="border-width: 1px; border-color: #A0A0FF;">
</div>
<div class="field">
<input name="register_firstname" type="text" id="Field_Value" value="" placeholder="<?=$LANG['First_name_title'];?>" style="border-width: 1px; border-color: #A0A0FF;">
</div>
<div class="field">
<input name="register_lastname" type="text" id="Field_Value" value="" placeholder="<?=$LANG['Last_name_title'];?>" style="border-width: 1px; border-color: #A0A0FF;">
</div>

<img src='/sources/captcha.php' style="border: 1px solid #fff; float: left; margin-top: 7px;" />
<div class="field">
<input type="text" name="captcha" id="Field_Value" placeholder="<?=$LANG['Enter_captcha_code'];?>" style="margin-left: 10px; float: left; width: 100px; border-width: 1px; border-color: #A0A0FF;" />
</div>

<div class="btn-container">
<input name="register_submit" type="submit" class="submit_button" value="<?=$LANG['signup_title'];?>">
</div>

</form>

</div>