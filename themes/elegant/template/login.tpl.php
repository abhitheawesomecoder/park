<div class="Theme_Container">

<div class="Display_Login">
<form class="Theme_Container_Form" name="" action="" method="POST">
<h2><?=$LANG['login_title'];?></h2>
<p class="Lead_Title"><?=$LANG['connect_with_a_social_network'];?></p>
<div class="social-signup">
<a class="btn-connect-option facebook" href="<?=$root;?>/?login&oauth_provider=facebook">Facebook</a>

</div>
<p class="Lead_Title"><?=$LANG['log_in_with_your_email_adress'];?> </p>
<div class="field">
<input name="Email" type="email" name="Email" id="Email" value="" autofocus="autofocus" placeholder="Deine E-Mailadresse">
</div>
<div class="field">

<input name="login_password" type="password" name="Password" id="Password" value="" placeholder="Dein Passwort">
</div>

<div class="btn-container">
<input name="login_submit" type="submit" class="submit_button" value="<?=$LANG['Log_in_title'];?>">
<a class="forgot-password" href="javascript:void(0);"><?=$LANG['Forgot_Password_title'];?></a>
</div>

 
</form>
</div>


<div class="Display_Recover">
<form class="Theme_Container_Form" name="myForm_Lost" id="myForm_Lost" action="#" method="POST">
<h2 style="width:400px;"><?=$LANG['Forgot_Password_title'];?></h2>

<div class="field">
<input name="lost_email" type="email" id="Email" value=""  aria-describedby="email-format" required aria-required="true" autofocus="autofocus" placeholder="Dein E-Mailadresse">
</div>

<div class="btn-container">
<input name="lost_submit" onclick="return checkform()" id="lost_submit" type="submit" class="submit_button" value="<?=$LANG['Send_instruction'];?>" style="border: 1px solid #fff; background-color: #0087F7;padding: 9px 20px;">
</div>

 
</form>
<p id="result"></p>
</div>


</div>