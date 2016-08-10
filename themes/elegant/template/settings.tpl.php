<?  $THEME_CONTENT_WRAP_RIGHT = 'off';  ?>
<div class="Container_Page">

<?  if($_GET['subaction'] == '') {
	if($_POST['submit_setting']) {
		if($members['oauth_provider'] == '') {
    		$username = $_POST['username'];
		} else {
			$username = $members['username'];
		}
		$hide_profile = $_POST['hide_profile'];

		$payment_method= $_POST['payment_method'];

		$paypal_id= $_POST['paypal_id'];

		$holder_name = $_POST['holder_name'];

		$bank_name = $_POST['bank_name'];

		$iban = $_POST['iban'];

		$bic_swift = $_POST['bic_swift'];



		if (!isset($hide_profile)) $hide_profile = 0;

		mysql_query("UPDATE users SET username='$username',hide_profile='$hide_profile',payment_method='".$payment_method."',paypal_id='".$paypal_id."',holder_name='$holder_name',bank_name='$bank_name',iban='$iban',bic_swift='$bic_swift' WHERE id='".$members['id']."'");
        //print success message.
	}
	// Session Member Info
$members = get_members($id);
	  ?>  <!-- Index Action -->
<form id="setting" action="" method="POST">
<h2><?=$LANG['Account_subtitle'];?></h2>

 <? if($members['oauth_provider']) {?> <font style="color:#F00"><?=$LANG['if_you_are_registered_with_social_networks'];?></font><? }?>
<div class="field">
    <label><?=$LANG['Username_title'];?></label>
    <input type="text" name="username" value="<?=$members['username']?>" maxlength="50" style="border: 1px solid #ccc;" <? if($members['oauth_provider']) {?> disabled<? }?>>
    <p class="tips"><?=$root;?>/u/<?=$members['username']?></p>

</div>

<div class="field">
    <label><?=$LANG['Email_title'];?></label>
    <input type="email" name="email" value="<?=$members['email']?>" maxlength="200" style="border: 1px solid #ccc;"  disabled>
    <p class="tips"><?=$LANG['Email_will_not_be_displayed_publicly'];?></p>

</div>
<script>
// A $( document ).ready() block.
$( document ).ready(function() {
	$('#payment_method').change(function() {
if(this.value == 'Paypal' ){
$("#paypal").show();
$('#bank').hide();
//$("#paypal").find('input').each(function(j, element){ 			$(element).val(""); });

}else if(this.value == 'Bank'){
	$("#paypal").hide();
	$('#bank').show();
//	$("#bank").find('input').each(function(j, element){ $(element).val(""); });

}else{
	$("#paypal").hide();
	$('#bank').hide();

}
	});
});
</script>

<div class="field">
    <label>Payment Method</label>
    <select name="payment_method" id="payment_method">
        <option value="">Select</option>
        <option value="Paypal" <? if($members['payment_method'] == 'Paypal') { ?>selected="selected"<? }?>>Paypal</option>
        <option value="Bank" <? if($members['payment_method'] == 'Bank') { ?>selected="selected"<? }?>>Bank</option>
    </select>

</div>

<div id="paypal" style="display:none">
<div class="field">
    <label>Paypal Email Id</label>
    <input type="email" name="paypal_id" maxlength="100" value="<?php echo $members['paypal_id']; ?>" style="border: 1px solid #ccc;">
</div>
</div>

<div id="bank"  style="display:none">

<div class="field">
    <label>Holder Name</label>
    <input type="text" name="holder_name" value="<?php echo $members['holder_name']; ?>" maxlength="100" style="border: 1px solid #ccc;">
</div>
<div class="field">
    <label>Bank Name</label>
    <input type="text" name="bank_name" value="<?php echo $members['bank_name']; ?>" maxlength="100" style="border: 1px solid #ccc;">
</div>
<div class="field">
    <label>IBAN </label>
    <input type="text" name="iban" value="<?php echo $members['iban']; ?>" maxlength="100" style="border: 1px solid #ccc;">
</div>
<div class="field">
    <label>BIC/SWIFT Code</label>
    <input type="text" name="bic_swift" value="<?php echo $members['bic_swift']; ?>" maxlength="100" style="border: 1px solid #ccc;">
</div>

</div>

<div class="field">
    <label><?=$LANG['Hidden_profile_title'];?></label>
    <div class="field checkbox">
        <label><input type="checkbox" name="hide_profile" value="1" <? if($members['hide_profile'] == '1') {?> checked<? }?>><?=$LANG['Hide_my_profile_to_others'];?></label>
    </div>
</div>
        <div class="btn-container">
            <input name="submit_setting" type="submit" value="<?=$LANG['save_changes_title'];?>">
        </div>

<div class="btn-container"><a class="link" href="<?=$root;?>/member/delete"><?=$LANG['Delete_my_account'];?></a></div>
</form>
<?  }  ?> <!-- Index Action -->


<?  if($_GET['subaction'] == 'password') {
    if($_POST['submit_password']) {
    	$old_password = $_POST['old_password'];
		$new_password = $_POST['new_password'];
		$new_password_repeat = $_POST['new_password_repeat'];

		if(md5($old_password) == $members['password']) {
		   if($new_password == $new_password_repeat) {
				mysql_query("UPDATE users SET password='".md5($new_password)."' WHERE id='".$members['id']."'");
      		    //print success message.
		   }
		 }
	} ?> <!-- Password Action -->
<form id="setting" action="" method="POST">
<h2><?=$LANG['Password_title'];?></h2>
<?
if($_POST['submit_password']) {
   if($_POST['old_password'] == $members['password']) {
		   if($_POST['new_password'] == $_POST['new_password_repeat']) {
			   echo "<font color='#FF0000'>".$LANG['Password_settings_has_been_saved'].".</font>";
		   }
   }
}
?>
<div class="field">
    <label><?=$LANG['old_password_title'];?></label>
    <input type="password" name="old_password" maxlength="32" autocomplete="off" style="border: 1px solid #ccc;"/>
</div>
<div class="field">
    <label><?=$LANG['new_password_title'];?></label>
    <input type="password" name="new_password" maxlength="32" autocomplete="off" style="border: 1px solid #ccc;"/>
</div>
<div class="field">
    <label><?=$LANG['re_type_new_password_title'];?></label>
    <input type="password" name="new_password_repeat" maxlength="32" autocomplete="off" style="border: 1px solid #ccc;"/>
</div>

        <div class="btn-container">
            <input name="submit_password" type="submit" value="<?=$LANG['save_changes_title'];?>">
        </div>
</form>
<? } ?><!-- Password Action -->


<?  if($_GET['subaction'] == 'profile') {
    if($_POST['submit_profile']) {
    	$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$birthday = $_POST['dob_year']."-".$_POST['dob_month']."-".$_POST['dob_day'];
		$country = $_POST['country'];
		$about_me = $_POST['about_me'];
		$address_line1 = $_POST['address_line1'];
		$address_line2 = $_POST['address_line2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];

		$path = "uploads/avatars/";
		$valid_formats = array("jpg", "png", "gif");
		$name = $_FILES['photoimg']['name'];
		$size = $_FILES['photoimg']['size'];
	    list($txt, $ext) = explode(".", $name);
						$actual_image_name = time().substr($txt, 5).".".$ext;
						$tmp = $_FILES['photoimg']['tmp_name'];
	if(move_uploaded_file($tmp, $path.$actual_image_name)) {


		if($first_name || $last_name || $gender || $birthday || $country || $about_me || $address_line1|| $address_line2 || $city || $state|| $zip) {
				mysql_query("UPDATE users SET first_name='$first_name',last_name='$last_name',gender='$gender',born='$birthday',country='$country',photo='$actual_image_name',about_me='$about_me',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',zip='$zip' WHERE id='".$members['id']."'");
      		    //print success message.
		}
	} else {
		if($first_name || $last_name || $gender || $birthday || $country || $about_me || $address_line1|| $address_line2 || $city || $state|| $zip) {
				mysql_query("UPDATE users SET first_name='$first_name',last_name='$last_name',gender='$gender',born='$birthday',country='$country',about_me='$about_me',address_line1='$address_line1',address_line2='$address_line2',city='$city',state='$state',zip='$zip' WHERE id='".$members['id']."'");
      		    //print success message.
		}
	}

	} // Session Member Info
$members = get_members($id);	?> <!-- Profile Action -->
<form id="setting" action="" method="POST" enctype="multipart/form-data">
<h2><?=$LANG['Profile_title'];?></h2>
<?
if($_POST['submit_profile']) {
   if($first_name || $last_name || $gender || $birthday || $country || $about_me || $address_line1|| $address_line2 || $city || $state|| $zip) {
			   echo "<font color='#FF0000'>".$LANG['Profile_settings_has_been_saved'].".</font>";
   }
}
?>
<div class="field avatars">
    <label style="top: -5px;position: relative;"><?=$LANG['Avatar_title'];?></label>
    <div class="avatar-container">
        <div class="placeholder avatar-80"><? if($members['oauth_provider'] == '') {?><img width="100" src="<?=$root;?>/uploads/avatars/<?=$members['photo']?>" alt="Avatar"><? }else{?><img width="100" src="<?=$members['photo']?>" alt="Avatar"><? }?></div>
    </div>
    <div class="control">
                <? if($members['oauth_provider'] == '') { ?>
                <input type="file" name="photoimg" accept=".jpg, .gif, .png">
                <p class="tips"><?=$LANG['jpg_gif_png_max_size_title'];?></p><? }?>
                <input type="hidden" name="default_avatar" />
    </div>
    <div class="clearfix"></div>

</div>
<input type="hidden" name="profile_color" value="">
<div class="field">
    <label><?=$LANG['your_first_name_title'];?></label>
    <input type="text" name="first_name" value="<?=$members['first_name']?>" maxlength="20" style="border: 1px solid #ccc;">
    <p class="tips"><?=$LANG['This_is_the_name_that_will_be_visible'];?>.</p>
</div>

<div class="field">
    <label><?=$LANG['your_last_name_title'];?></label>
    <input type="text" name="last_name" value="<?=$members['last_name']?>" maxlength="20" style="border: 1px solid #ccc;">
    <p class="tips"><?=$LANG['This_is_the_name_that_will_be_visible'];?>.</p>
</div>

<div class="field">
    <label><?=$LANG['Gender_title'];?></label>
    <select name="gender">
        <option><?=$LANG['Select_Gender_title'];?>...</option>
        <option value="F" <? if($members['gender'] == 'F') { ?>selected="selected"<? }?>><?=$LANG['Female_title'];?></option>
        <option value="M" <? if($members['gender'] == 'M') { ?>selected="selected"<? }?>><?=$LANG['Male_title'];?></option>
        <option value="X" <? if($members['gender'] == 'X') { ?>selected="selected"<? }?>><?=$LANG['Unspecified_title'];?></option>
    </select>

</div>

<div class="field">
    <label><?=$LANG['Birthday_title'];?></label>
    <div class="date-picker">
    <? if($members['born'] == '0000-00-00') {  } else { $born_date_y = date("Y", strtotime($members['born'])); $born_date_m = date("m", strtotime($members['born'])); $born_date_d = date("d", strtotime($members['born'])); } ?>
        <input class="year" type="text" name="dob_year" value="<?=$born_date_y;?>" placeholder="YYYY"  style="float: left; border: 1px solid #ccc;"/>
        <input class="month" type="text" name="dob_month" value="<?=$born_date_m;?>" placeholder="MM"  style="float: left; border: 1px solid #ccc;"/>
        <input class="day" type="text" name="dob_day" value="<?=$born_date_d;?>" placeholder="DD"  style="float: left; border: 1px solid #ccc;"/>
    </div>

</div>

<div class="field">
    <label>About me</label>
		<textarea name="about_me" rows="4" cols="52" style="border: 1px solid #ccc;"><?=$members['about_me']?></textarea>
</div>

<div class="field">
    <label>Address line 1</label>
    <input type="text" name="address_line1" value="<?=$members['address_line1']?>" maxlength="40" style="border: 1px solid #ccc;">
</div>
<div class="field">
    <label>Address line 2</label>
    <input type="text" name="address_line2" value="<?=$members['address_line2']?>" maxlength="40" style="border: 1px solid #ccc;">
</div>
<div class="field">
    <label>City</label>
    <input type="text" name="city" value="<?=$members['city']?>" maxlength="20" style="border: 1px solid #ccc;">
</div>
<div class="field">
    <label>State</label>
    <input type="text" name="state" value="<?=$members['state']?>" maxlength="20" style="border: 1px solid #ccc;">
</div>
<div class="field">
    <label>Zip</label>
    <input type="text" name="zip" value="<?=$members['zip']?>" maxlength="20" style="border: 1px solid #ccc;">
</div>

<div class="field">
    <label><?=$LANG['Country_title'];?></label>
        <select name="country" id="country_selector">
        <option value=""></option>
        <option value="af" <? if($members['country'] == 'af') {?>selected="selected"<? }?>>Afghanistan</option>
        <option value="al" <? if($members['country'] == 'al') {?>selected="selected"<? }?>>Albania</option>
        <option value="dz" <? if($members['country'] == 'dz') {?>selected="selected"<? }?>>Algeria</option>
        <option value="as" <? if($members['country'] == 'as') {?>selected="selected"<? }?>>American Samoa</option>
        <option value="ad" <? if($members['country'] == 'ad') {?>selected="selected"<? }?>>Andorra</option>
        <option value="ao" <? if($members['country'] == 'ao') {?>selected="selected"<? }?>>Angola</option>
        <option value="ai" <? if($members['country'] == 'ai') {?>selected="selected"<? }?>>Anguilla</option>
        <option value="aq" <? if($members['country'] == 'aq') {?>selected="selected"<? }?>>Antarctica</option>
        <option value="ag" <? if($members['country'] == 'ag') {?>selected="selected"<? }?>>Antigua And Barbuda</option>
        <option value="ar" <? if($members['country'] == 'ar') {?>selected="selected"<? }?>>Argentina</option>
        <option value="am" <? if($members['country'] == 'am') {?>selected="selected"<? }?>>Armenia</option>
        <option value="aw" <? if($members['country'] == 'aw') {?>selected="selected"<? }?>>Aruba</option>
        <option value="au" <? if($members['country'] == 'au') {?>selected="selected"<? }?>>Australia</option>
        <option value="at" <? if($members['country'] == 'at') {?>selected="selected"<? }?>>Austria</option>
        <option value="az" <? if($members['country'] == 'az') {?>selected="selected"<? }?>>Azerbaijan</option>
        <option value="bs" <? if($members['country'] == 'bs') {?>selected="selected"<? }?>>Bahamas</option>
        <option value="bh" <? if($members['country'] == 'bh') {?>selected="selected"<? }?>>Bahrain</option>
        <option value="bd" <? if($members['country'] == 'bd') {?>selected="selected"<? }?>>Bangladesh</option>
        <option value="bb" <? if($members['country'] == 'bb') {?>selected="selected"<? }?>>Barbados</option>
        <option value="by" <? if($members['country'] == 'by') {?>selected="selected"<? }?>>Belarus</option>
        <option value="be" <? if($members['country'] == 'be') {?>selected="selected"<? }?>>Belgium</option>
        <option value="bz" <? if($members['country'] == 'bz') {?>selected="selected"<? }?>>Belize</option>
        <option value="bj" <? if($members['country'] == 'bj') {?>selected="selected"<? }?>>Benin</option>
        <option value="bm" <? if($members['country'] == 'bm') {?>selected="selected"<? }?>>Bermuda</option>
        <option value="bt" <? if($members['country'] == 'bt') {?>selected="selected"<? }?>>Bhutan</option>
        <option value="bo" <? if($members['country'] == 'bo') {?>selected="selected"<? }?>>Bolivia</option>
        <option value="ba" <? if($members['country'] == 'ba') {?>selected="selected"<? }?>>Bosnia And Herzegovina</option>
        <option value="bw" <? if($members['country'] == 'bw') {?>selected="selected"<? }?>>Botswana</option>
        <option value="br" <? if($members['country'] == 'br') {?>selected="selected"<? }?>>Brazil</option>
        <option value="io" <? if($members['country'] == 'io') {?>selected="selected"<? }?>>British Indian Ocean Territory</option>
        <option value="bn" <? if($members['country'] == 'bn') {?>selected="selected"<? }?>>Brunei Darussalam</option>
        <option value="bg" <? if($members['country'] == 'bg') {?>selected="selected"<? }?>>Bulgaria</option>
        <option value="bf" <? if($members['country'] == 'bf') {?>selected="selected"<? }?>>Burkina Faso</option>
        <option value="bi" <? if($members['country'] == 'bi') {?>selected="selected"<? }?>>Burundi</option>
        <option value="kh" <? if($members['country'] == 'kh') {?>selected="selected"<? }?>>Cambodia</option>
        <option value="cm" <? if($members['country'] == 'cm') {?>selected="selected"<? }?>>Cameroon</option>
        <option value="ca" <? if($members['country'] == 'ca') {?>selected="selected"<? }?>>Canada</option>
        <option value="cv" <? if($members['country'] == 'cv') {?>selected="selected"<? }?>>Cape Verde</option>
        <option value="ky" <? if($members['country'] == 'ky') {?>selected="selected"<? }?>>Cayman Islands</option>
        <option value="cf" <? if($members['country'] == 'cf') {?>selected="selected"<? }?>>Central African Republic</option>
        <option value="td" <? if($members['country'] == 'td') {?>selected="selected"<? }?>>Chad</option>
        <option value="cl" <? if($members['country'] == 'cl') {?>selected="selected"<? }?>>Chile</option>
        <option value="cn" <? if($members['country'] == 'cn') {?>selected="selected"<? }?>>China</option>
        <option value="co" <? if($members['country'] == 'co') {?>selected="selected"<? }?>>Colombia</option>
        <option value="km" <? if($members['country'] == 'km') {?>selected="selected"<? }?>>Comoros</option>
        <option value="cg" <? if($members['country'] == 'cg') {?>selected="selected"<? }?>>Congo</option>
        <option value="ck" <? if($members['country'] == 'ck') {?>selected="selected"<? }?>>Cook Islands</option>
        <option value="cr" <? if($members['country'] == 'cr') {?>selected="selected"<? }?>>Costa Rica</option>
        <option value="ci" <? if($members['country'] == 'ci') {?>selected="selected"<? }?>>Cote D'Ivoire</option>
        <option value="hr" <? if($members['country'] == 'hr') {?>selected="selected"<? }?>>Croatia</option>
        <option value="cu" <? if($members['country'] == 'cu') {?>selected="selected"<? }?>>Cuba</option>
        <option value="cy" <? if($members['country'] == 'cy') {?>selected="selected"<? }?>>Cyprus</option>
        <option value="cz" <? if($members['country'] == 'cz') {?>selected="selected"<? }?>>Czech Republic</option>
        <option value="dk" <? if($members['country'] == 'dk') {?>selected="selected"<? }?>>Denmark</option>
        <option value="dj" <? if($members['country'] == 'dj') {?>selected="selected"<? }?>>Djibouti</option>
        <option value="dm" <? if($members['country'] == 'dm') {?>selected="selected"<? }?>>Dominica</option>
        <option value="do" <? if($members['country'] == 'do') {?>selected="selected"<? }?>>Dominican Republic</option>
        <option value="ec" <? if($members['country'] == 'ec') {?>selected="selected"<? }?>>Ecuador</option>
        <option value="eg" <? if($members['country'] == 'eg') {?>selected="selected"<? }?>>Egypt</option>
        <option value="sv" <? if($members['country'] == 'sv') {?>selected="selected"<? }?>>El Salvador</option>
        <option value="gq" <? if($members['country'] == 'gq') {?>selected="selected"<? }?>>Equatorial Guinea</option>
        <option value="er" <? if($members['country'] == 'er') {?>selected="selected"<? }?>>Eritrea</option>
        <option value="ee" <? if($members['country'] == 'ee') {?>selected="selected"<? }?>>Estonia</option>
        <option value="et" <? if($members['country'] == 'et') {?>selected="selected"<? }?>>Ethiopia</option>
        <option value="fk" <? if($members['country'] == 'fk') {?>selected="selected"<? }?>>Falkland Islands (Malvinas)</option>
        <option value="fo" <? if($members['country'] == 'fo') {?>selected="selected"<? }?>>Faroe Islands</option>
        <option value="fm" <? if($members['country'] == 'fm') {?>selected="selected"<? }?>>Federated States Of Micronesia</option>
        <option value="fj" <? if($members['country'] == 'fj') {?>selected="selected"<? }?>>Fiji</option>
        <option value="fi" <? if($members['country'] == 'fi') {?>selected="selected"<? }?>>Finland</option>
        <option value="fr" <? if($members['country'] == 'fr') {?>selected="selected"<? }?>>France</option>
        <option value="gf" <? if($members['country'] == 'gf') {?>selected="selected"<? }?>>French Guiana</option>
        <option value="pf" <? if($members['country'] == 'pf') {?>selected="selected"<? }?>>French Polynesia</option>
        <option value="ga" <? if($members['country'] == 'ga') {?>selected="selected"<? }?>>Gabon</option>
        <option value="gm" <? if($members['country'] == 'gm') {?>selected="selected"<? }?>>Gambia</option>
        <option value="ge" <? if($members['country'] == 'ge') {?>selected="selected"<? }?>>Georgia</option>
        <option value="de" <? if($members['country'] == 'de') {?>selected="selected"<? }?>>Germany</option>
        <option value="gh" <? if($members['country'] == 'gh') {?>selected="selected"<? }?>>Ghana</option>
        <option value="gi" <? if($members['country'] == 'gi') {?>selected="selected"<? }?>>Gibraltar</option>
        <option value="gr" <? if($members['country'] == 'gr') {?>selected="selected"<? }?>>Greece</option>
        <option value="gl" <? if($members['country'] == 'gl') {?>selected="selected"<? }?>>Greenland</option>
        <option value="gd" <? if($members['country'] == 'gd') {?>selected="selected"<? }?>>Grenada</option>
        <option value="gp" <? if($members['country'] == 'gp') {?>selected="selected"<? }?>>Guadeloupe</option>
        <option value="gu" <? if($members['country'] == 'gu') {?>selected="selected"<? }?>>Guam</option>
        <option value="gt" <? if($members['country'] == 'gt') {?>selected="selected"<? }?>>Guatemala</option>
        <option value="gn" <? if($members['country'] == 'gn') {?>selected="selected"<? }?>>Guinea</option>
        <option value="gw" <? if($members['country'] == 'gw') {?>selected="selected"<? }?>>Guinea-Bissau</option>
        <option value="gy" <? if($members['country'] == 'gy') {?>selected="selected"<? }?>>Guyana</option>
        <option value="ht" <? if($members['country'] == 'ht') {?>selected="selected"<? }?>>Haiti</option>
        <option value="va" <? if($members['country'] == 'va') {?>selected="selected"<? }?>>Holy See (Vatican City State)</option>
        <option value="hn" <? if($members['country'] == 'hn') {?>selected="selected"<? }?>>Honduras</option>
        <option value="hk" <? if($members['country'] == 'hk') {?>selected="selected"<? }?>>Hong Kong</option>
        <option value="hu" <? if($members['country'] == 'hu') {?>selected="selected"<? }?>>Hungary</option>
        <option value="is" <? if($members['country'] == 'is') {?>selected="selected"<? }?>>Iceland</option>
        <option value="in" <? if($members['country'] == 'in') {?>selected="selected"<? }?>>India</option>
        <option value="id" <? if($members['country'] == 'id') {?>selected="selected"<? }?>>Indonesia</option>
        <option value="iq" <? if($members['country'] == 'iq') {?>selected="selected"<? }?>>Iraq</option>
        <option value="ie" <? if($members['country'] == 'ie') {?>selected="selected"<? }?>>Ireland</option>
        <option value="ir" <? if($members['country'] == 'ir') {?>selected="selected"<? }?>>Islamic Republic Of Iran</option>
        <option value="il" <? if($members['country'] == 'il') {?>selected="selected"<? }?>>Israel</option>
        <option value="it" <? if($members['country'] == 'it') {?>selected="selected"<? }?>>Italy</option>
        <option value="jm" <? if($members['country'] == 'jm') {?>selected="selected"<? }?>>Jamaica</option>
        <option value="jp" <? if($members['country'] == 'jp') {?>selected="selected"<? }?>>Japan</option>
        <option value="jo" <? if($members['country'] == 'jo') {?>selected="selected"<? }?>>Jordan</option>
        <option value="kz" <? if($members['country'] == 'kz') {?>selected="selected"<? }?>>Kazakhstan</option>
        <option value="ke" <? if($members['country'] == 'ke') {?>selected="selected"<? }?>>Kenya</option>
        <option value="ki" <? if($members['country'] == 'ki') {?>selected="selected"<? }?>>Kiribati</option>
        <option value="kw" <? if($members['country'] == 'kw') {?>selected="selected"<? }?>>Kuwait</option>
        <option value="kg" <? if($members['country'] == 'kg') {?>selected="selected"<? }?>>Kyrgyzstan</option>
        <option value="la" <? if($members['country'] == 'la') {?>selected="selected"<? }?>>Lao People'S Democratic Republic</option>
        <option value="lv" <? if($members['country'] == 'lv') {?>selected="selected"<? }?>>Latvia</option>
        <option value="lb" <? if($members['country'] == 'lb') {?>selected="selected"<? }?>>Lebanon</option>
        <option value="ls" <? if($members['country'] == 'ls') {?>selected="selected"<? }?>>Lesotho</option>
        <option value="lr" <? if($members['country'] == 'lr') {?>selected="selected"<? }?>>Liberia</option>
        <option value="ly" <? if($members['country'] == 'ly') {?>selected="selected"<? }?>>Libyan Arab Jamahiriya</option>
        <option value="li" <? if($members['country'] == 'li') {?>selected="selected"<? }?>>Liechtenstein</option>
        <option value="lt" <? if($members['country'] == 'lt') {?>selected="selected"<? }?>>Lithuania</option>
        <option value="lu" <? if($members['country'] == 'lu') {?>selected="selected"<? }?>>Luxembourg</option>
        <option value="mo" <? if($members['country'] == 'mo') {?>selected="selected"<? }?>>Macao</option>
        <option value="mg" <? if($members['country'] == 'mg') {?>selected="selected"<? }?>>Madagascar</option>
        <option value="mw" <? if($members['country'] == 'mw') {?>selected="selected"<? }?>>Malawi</option>
        <option value="my" <? if($members['country'] == 'my') {?>selected="selected"<? }?>>Malaysia</option>
        <option value="mv" <? if($members['country'] == 'mv') {?>selected="selected"<? }?>>Maldives</option>
        <option value="ml" <? if($members['country'] == 'ml') {?>selected="selected"<? }?>>Mali</option>
        <option value="mt" <? if($members['country'] == 'mt') {?>selected="selected"<? }?>>Malta</option>
        <option value="mh" <? if($members['country'] == 'mh') {?>selected="selected"<? }?>>Marshall Islands</option>
        <option value="mq" <? if($members['country'] == 'mq') {?>selected="selected"<? }?>>Martinique</option>
        <option value="mr" <? if($members['country'] == 'mr') {?>selected="selected"<? }?>>Mauritania</option>
        <option value="mu" <? if($members['country'] == 'mu') {?>selected="selected"<? }?>>Mauritius</option>
        <option value="yt" <? if($members['country'] == 'yt') {?>selected="selected"<? }?>>Mayotte</option>
        <option value="mx" <? if($members['country'] == 'mx') {?>selected="selected"<? }?>>Mexico</option>
        <option value="mc" <? if($members['country'] == 'mc') {?>selected="selected"<? }?>>Monaco</option>
        <option value="mn" <? if($members['country'] == 'mn') {?>selected="selected"<? }?>>Mongolia</option>
        <option value="me" <? if($members['country'] == 'me') {?>selected="selected"<? }?>>Montenegro</option>
        <option value="ms" <? if($members['country'] == 'ms') {?>selected="selected"<? }?>>Montserrat</option>
        <option value="ma" <? if($members['country'] == 'ma') {?>selected="selected"<? }?>>Morocco</option>
        <option value="mz" <? if($members['country'] == 'mz') {?>selected="selected"<? }?>>Mozambique</option>
        <option value="mm" <? if($members['country'] == 'mm') {?>selected="selected"<? }?>>Myanmar</option>
        <option value="na" <? if($members['country'] == 'na') {?>selected="selected"<? }?>>Namibia</option>
        <option value="nr" <? if($members['country'] == 'nr') {?>selected="selected"<? }?>>Nauru</option>
        <option value="np" <? if($members['country'] == 'np') {?>selected="selected"<? }?>>Nepal</option>
        <option value="nl" <? if($members['country'] == 'nl') {?>selected="selected"<? }?>>Netherlands</option>
        <option value="an" <? if($members['country'] == 'an') {?>selected="selected"<? }?>>Netherlands Antilles</option>
        <option value="nc" <? if($members['country'] == 'nc') {?>selected="selected"<? }?>>New Caledonia</option>
        <option value="nz" <? if($members['country'] == 'nz') {?>selected="selected"<? }?>>New Zealand</option>
        <option value="ni" <? if($members['country'] == 'ni') {?>selected="selected"<? }?>>Nicaragua</option>
        <option value="ne" <? if($members['country'] == 'ne') {?>selected="selected"<? }?>>Niger</option>
        <option value="ng" <? if($members['country'] == 'ng') {?>selected="selected"<? }?>>Nigeria</option>
        <option value="nu" <? if($members['country'] == 'nu') {?>selected="selected"<? }?>>Niue</option>
        <option value="nf" <? if($members['country'] == 'nf') {?>selected="selected"<? }?>>Norfolk Island</option>
        <option value="mp" <? if($members['country'] == 'mp') {?>selected="selected"<? }?>>Northern Mariana Islands</option>
        <option value="no" <? if($members['country'] == 'no') {?>selected="selected"<? }?>>Norway</option>
        <option value="om" <? if($members['country'] == 'om') {?>selected="selected"<? }?>>Oman</option>
        <option value="pk" <? if($members['country'] == 'pk') {?>selected="selected"<? }?>>Pakistan</option>
        <option value="pw" <? if($members['country'] == 'pw') {?>selected="selected"<? }?>>Palau</option>
        <option value="ps" <? if($members['country'] == 'ps') {?>selected="selected"<? }?>>Palestinian Territory, Occupied</option>
        <option value="pa" <? if($members['country'] == 'pa') {?>selected="selected"<? }?>>Panama</option>
        <option value="pg" <? if($members['country'] == 'pg') {?>selected="selected"<? }?>>Papua New Guinea</option>
        <option value="py" <? if($members['country'] == 'py') {?>selected="selected"<? }?>>Paraguay</option>
        <option value="pe" <? if($members['country'] == 'pe') {?>selected="selected"<? }?>>Peru</option>
        <option value="ph" <? if($members['country'] == 'ph') {?>selected="selected"<? }?>>Philippines</option>
        <option value="pl" <? if($members['country'] == 'pl') {?>selected="selected"<? }?>>Poland</option>
        <option value="pt" <? if($members['country'] == 'pt') {?>selected="selected"<? }?>>Portugal</option>
        <option value="pr" <? if($members['country'] == 'pr') {?>selected="selected"<? }?>>Puerto Rico</option>
        <option value="qa" <? if($members['country'] == 'qa') {?>selected="selected"<? }?>>Qatar</option>
        <option value="kr" <? if($members['country'] == 'kr') {?>selected="selected"<? }?>>Republic Of Korea</option>
        <option value="xk" <? if($members['country'] == 'xk') {?>selected="selected"<? }?>>Republic of Kosovo</option>
        <option value="mk" <? if($members['country'] == 'mk') {?>selected="selected"<? }?>>Republic Of Macedonia</option>
        <option value="md" <? if($members['country'] == 'md') {?>selected="selected"<? }?>>Republic Of Moldova</option>
        <option value="rs" <? if($members['country'] == 'rs') {?>selected="selected"<? }?>>Republic Of Serbia</option>
        <option value="re" <? if($members['country'] == 're') {?>selected="selected"<? }?>>Reunion</option>
        <option value="ro" <? if($members['country'] == 'ro') {?>selected="selected"<? }?>>Romania</option>
        <option value="ru" <? if($members['country'] == 'ru') {?>selected="selected"<? }?>>Russian Federation</option>
        <option value="rw" <? if($members['country'] == 'rw') {?>selected="selected"<? }?>>Rwanda</option>
        <option value="kn" <? if($members['country'] == 'kn') {?>selected="selected"<? }?>>Saint Kitts And Nevis</option>
        <option value="lc" <? if($members['country'] == 'lc') {?>selected="selected"<? }?>>Saint Lucia</option>
        <option value="vc" <? if($members['country'] == 'vc') {?>selected="selected"<? }?>>Saint Vincent And The Grenadines</option>
        <option value="ws" <? if($members['country'] == 'ws') {?>selected="selected"<? }?>>Samoa</option>
        <option value="sm" <? if($members['country'] == 'sm') {?>selected="selected"<? }?>>San Marino</option>
        <option value="st" <? if($members['country'] == 'st') {?>selected="selected"<? }?>>Sao Tome And Principe</option>
        <option value="sa" <? if($members['country'] == 'sa') {?>selected="selected"<? }?>>Saudi Arabia</option>
        <option value="sn" <? if($members['country'] == 'sn') {?>selected="selected"<? }?>>Senegal</option>
        <option value="sc" <? if($members['country'] == 'sc') {?>selected="selected"<? }?>>Seychelles</option>
        <option value="sl" <? if($members['country'] == 'sl') {?>selected="selected"<? }?>>Sierra Leone</option>
        <option value="sg" <? if($members['country'] == 'sg') {?>selected="selected"<? }?>>Singapore</option>
        <option value="sk" <? if($members['country'] == 'sk') {?>selected="selected"<? }?>>Slovakia</option>
        <option value="si" <? if($members['country'] == 'si') {?>selected="selected"<? }?>>Slovenia</option>
        <option value="sb" <? if($members['country'] == 'sb') {?>selected="selected"<? }?>>Solomon Islands</option>
        <option value="so" <? if($members['country'] == 'so') {?>selected="selected"<? }?>>Somalia</option>
        <option value="za" <? if($members['country'] == 'za') {?>selected="selected"<? }?>>South Africa</option>
        <option value="gs" <? if($members['country'] == 'gs') {?>selected="selected"<? }?>>South Georgia And The South Sandwich Islands</option>
        <option value="es" <? if($members['country'] == 'es') {?>selected="selected"<? }?>>Spain</option>
        <option value="lk" <? if($members['country'] == 'lk') {?>selected="selected"<? }?>>Sri Lanka</option>
        <option value="sd" <? if($members['country'] == 'sd') {?>selected="selected"<? }?>>Sudan</option>
        <option value="sr" <? if($members['country'] == 'sr') {?>selected="selected"<? }?>>Suriname</option>
        <option value="sz" <? if($members['country'] == 'sz') {?>selected="selected"<? }?>>Swaziland</option>
        <option value="se" <? if($members['country'] == 'se') {?>selected="selected"<? }?>>Sweden</option>
        <option value="ch" <? if($members['country'] == 'ch') {?>selected="selected"<? }?>>Switzerland</option>
        <option value="sy" <? if($members['country'] == 'sy') {?>selected="selected"<? }?>>Syrian Arab Republic</option>
        <option value="tw" <? if($members['country'] == 'tw') {?>selected="selected"<? }?>>Taiwan</option>
        <option value="tj" <? if($members['country'] == 'tj') {?>selected="selected"<? }?>>Tajikistan</option>
        <option value="th" <? if($members['country'] == 'th') {?>selected="selected"<? }?>>Thailand</option>
        <option value="cd" <? if($members['country'] == 'cd') {?>selected="selected"<? }?>>The Democratic Republic Of The Congo</option>
        <option value="tl" <? if($members['country'] == 'tl') {?>selected="selected"<? }?>>Timor-Leste</option>
        <option value="tg" <? if($members['country'] == 'tg') {?>selected="selected"<? }?>>Togo</option>
        <option value="tk" <? if($members['country'] == 'tk') {?>selected="selected"<? }?>>Tokelau</option>
        <option value="to" <? if($members['country'] == 'to') {?>selected="selected"<? }?>>Tonga</option>
        <option value="tt" <? if($members['country'] == 'tt') {?>selected="selected"<? }?>>Trinidad And Tobago</option>
        <option value="tn" <? if($members['country'] == 'tn') {?>selected="selected"<? }?>>Tunisia</option>
        <option value="tr" <? if($members['country'] == 'tr') {?>selected="selected"<? }?>>Turkey</option>
        <option value="tm" <? if($members['country'] == 'tm') {?>selected="selected"<? }?>>Turkmenistan</option>
        <option value="tv" <? if($members['country'] == 'tv') {?>selected="selected"<? }?>>Tuvalu</option>
        <option value="ug" <? if($members['country'] == 'ug') {?>selected="selected"<? }?>>Uganda</option>
        <option value="ua" <? if($members['country'] == 'ua') {?>selected="selected"<? }?>>Ukraine</option>
        <option value="ae" <? if($members['country'] == 'ae') {?>selected="selected"<? }?>>United Arab Emirates</option>
        <option value="gb" <? if($members['country'] == 'gb') {?>selected="selected"<? }?>>United Kingdom</option>
        <option value="tz" <? if($members['country'] == 'tz') {?>selected="selected"<? }?>>United Republic Of Tanzania</option>
        <option value="us" <? if($members['country'] == 'us') {?>selected="selected"<? }?>>United States</option>
        <option value="um" <? if($members['country'] == 'um') {?>selected="selected"<? }?>>United States Minor Outlying Islands</option>
        <option value="uy" <? if($members['country'] == 'uy') {?>selected="selected"<? }?>>Uruguay</option>
        <option value="uz" <? if($members['country'] == 'uz') {?>selected="selected"<? }?>>Uzbekistan</option>
        <option value="vu" <? if($members['country'] == 'vu') {?>selected="selected"<? }?>>Vanuatu</option>
        <option value="ve" <? if($members['country'] == 've') {?>selected="selected"<? }?>>Venezuela</option>
        <option value="vn" <? if($members['country'] == 'vn') {?>selected="selected"<? }?>>Viet Nam</option>
        <option value="vg" <? if($members['country'] == 'vg') {?>selected="selected"<? }?>>Virgin Islands, British</option>
        <option value="vi" <? if($members['country'] == 'vi') {?>selected="selected"<? }?>>Virgin Islands, U.S.</option>
        <option value="wf" <? if($members['country'] == 'wf') {?>selected="selected"<? }?>>Wallis And Futuna</option>
        <option value="ye" <? if($members['country'] == 'ye') {?>selected="selected"<? }?>>Yemen</option>
        <option value="zm" <? if($members['country'] == 'zm') {?>selected="selected"<? }?>>Zambia</option>
        <option value="zw" <? if($members['country'] == 'zw') {?>selected="selected"<? }?>>Zimbabwe</option>
    </select>
    <p class="tips"><?=$LANG['Tell_us_where_you_are_from'];?>.</p>
</div>

        <div class="btn-container">
            <input name="submit_profile" type="submit" value="<?=$LANG['save_changes_title'];?>">
        </div>

</form>
<? } ?> <!-- Profile Action -->

<ul class="form-nav">
        <li><a href="<?=$root;?>/user/settings/" <? if($_GET['subaction'] == '') { echo 'class="selected"'; }?>><?=$LANG['Account_subtitle'];?></a></li>
        <li><a href="<?=$root;?>/user/settings/password" <? if($_GET['subaction'] == 'password') { echo 'class="selected"'; }?>><?=$LANG['Password_subtitle'];?></a></li>
        <li><a href="<?=$root;?>/user/settings/profile" <? if($_GET['subaction'] == 'profile') { echo 'class="selected"'; }?>><?=$LANG['Profile_subtitle'];?></a></li>
    </ul>

<div class="clearfix"></div>
</div>
