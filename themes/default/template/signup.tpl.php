<div id="bgimage" class="bgimage"></div>
<div style="position: absolute; top: 20px; right: 30px;">
<div style="position: absolute; top: -10px; right: -20px;">
<a class="customize_wallpaper" href="javascript: void(0);"><?=$LANG['personalise_title'];?></a>
</div>
<div id="customize_wallpaper">
<? $Theme_Background = mysql_query("SELECT * FROM backgrounds WHERE type='signup'");while($Theme_Background_Row = mysql_fetch_array($Theme_Background)) { ?>
<div style="width: 100%;height: 70px;">
<a href="<?=$root;?>/view/signup/<?=$Theme_Background_Row['background'];?>"><img src="<?=$root;?>/uploads/backgrounds/0<?=$Theme_Background_Row['background'];?>.jpg" style="width: 124px; max-width: 100% !important;max-height: 100% !important;display: block;margin: 0 auto;"></a>
</div>
<br><? } ?></div>
</div>


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
<input name="register_submit" type="submit" class="submit_button" value="<?=$LANG['signup_title'];?>">
</div>

</form>

</div>