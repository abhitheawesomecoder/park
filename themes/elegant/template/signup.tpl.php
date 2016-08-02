
<div class="Theme_Container">

<form class="Theme_Container_Form" name="" action="" method="POST">
<h2><?=$LANG['signup_title'];?></h2>
<p class="Lead_Title"><?=$LANG['connect_with_a_social_network'];?></p>
<div class="social-signup">
<a class="btn-connect-option facebook" href="<?=$root;?>/?login&oauth_provider=facebook">Facebook</a>

</div>
<p class="Lead_Title"><?=$LANG['sign_up_with_your_email_adress'];?> </p>
<div class="field">
<input name="register_username" type="text" id="Field_Value" value="<?=$_POST['register_username']?>" placeholder="<?=$LANG['Username_title'];?>" autofocus="autofocus" style="border-width: 1px; border-color: #A0A0FF;">
</div>
<div class="field">
<input name="register_email" type="text" id="Field_Value" value="<?=$_POST['register_email']?>" placeholder="<?=$LANG['Email_title'];?>" style="border-width: 1px; border-color: #A0A0FF;">
</div>
<div class="field">
<input name="register_password" type="password" id="Field_Value" value="" placeholder="<?=$LANG['Password_title'];?>" style="border-width: 1px; border-color: #A0A0FF;">
</div>
<div class="field">
<input name="register_firstname" type="text" id="Field_Value" value="<?=$_POST['register_firstname']?>" placeholder="<?=$LANG['First_name_title'];?>" style="border-width: 1px; border-color: #A0A0FF;">
</div>
<div class="field">
<input name="register_lastname" type="text" id="Field_Value" value="<?=$_POST['register_lastname']?>" placeholder="<?=$LANG['Last_name_title'];?>" style="border-width: 1px; border-color: #A0A0FF;">
</div>

<img src='/sources/captcha.php' style="border: 1px solid #fff; float: left; margin-top: 7px;" />
<input type="text" name="captcha" id="captcha" placeholder="<?=$LANG['Enter_captcha_code'];?>" style="margin-left: 10px; float: left; width: 100px; border-width: 1px; border-color: #A0A0FF;" />

<div class="btn-container">
<input name="register_submit" type="submit" class="submit_button" value="<?=$LANG['header_SIGNUP_title'];?>">
</div>

</form>

</div>