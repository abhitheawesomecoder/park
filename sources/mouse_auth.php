<?php

ob_start();
session_start();

if($_POST['buy_product']){
	define('DATABASE_HOST', 'localhost');
	define('DATABASE_NAME', 'usr_web26337299_1');
	define('DATABASE_USERNAME', 'web26337299');
	define('DATABASE_PASSWORD', 'CDC2gqTW');
	mysql_connect(DATABASE_HOST,DATABASE_USERNAME,DATABASE_PASSWORD) or die(mysql_error());
	mysql_select_db(DATABASE_NAME) or die(mysql_error());
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET NAMES 'utf8'");

	// check if user has entered allthe info if not return error message
	// save prodct id seller id and buyer id return success message

	$buyer_id = $_POST['buyer_id'];
	$product_id = $_POST['product_id'];
	$seller_id = $_POST['seller_id'];

	$result_purchases = mysql_query("INSERT INTO `purchases` (`product_id`,`buyer_id`,`seller_id`, `date`) VALUES('".$product_id."','".$buyer_id."','".$seller_id."','".date("Y-m-d")."')");


	echo json_encode([ "code" => $result_purchases ]);

	exit();
}

$root = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($root, -1)=="/")
$root = 'http://' . $_SERVER['SERVER_NAME'];
$document = '' . $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($document, -1)=="/")
$document = '' . $_SERVER['DOCUMENT_ROOT'];


include_once ($document.'/includes/config.php');
include_once ($document.'/includes/db_connect.php');
include_once ($document.'/sources/functions.php');



// Re-type Password
if($_POST['social_password_submit']){
	$members = get_members($id);

	$email = mysql_real_escape_string($_POST['email']);
	$password = md5($_POST['password']);
	$re_password = md5($_POST['re_password']);
	if($_POST['email']) { $display_email = "`email`='$email',"; }
	if(!$password || !$re_password){ } else {
			$Password_Reminder_Changer = "UPDATE `users` SET $display_email `password`='$password', `active`='1' WHERE `username`='".$_SESSION['username']."' OR `email`='".$_SESSION['username']."' ";
			mysql_query($Password_Reminder_Changer) or die(mysql_error());
			header('Location: /');
	}
}
// Login
if($_POST['login_submit']){
// Retrieve email and password from database
$LOGIN['Email'] = mysql_real_escape_string($_POST['Email']);
$LOGIN['password'] = md5(mysql_real_escape_string($_POST['login_password']));
$LOGIN_QUERY = "SELECT * FROM users WHERE email='".$LOGIN['Email']."' AND password='".$LOGIN['password']."' AND email_verified='1'";
$LOGIN_RESULT = mysql_query($LOGIN_QUERY);
$LOGIN_ROW = mysql_num_rows($LOGIN_RESULT);
// Check email and password match
if(mysql_num_rows($LOGIN_RESULT)) {
	$LOGIN_ROW = mysql_num_rows($LOGIN_RESULT);
        // Set email session variable
		$_SESSION['id'] = $LOGIN_ROW['id'];
		$_SESSION['username'] = $_POST['Email'];
		$_SESSION['password'] = $_POST['login_password'];
        // Jump to secured page
        header('Location: /home');
} else {
        // Jump to login page
        header('Location: ');
}
}

// Register
if(isset($_POST['register_submit'])){
	$username = protect(mysql_real_escape_string($_POST['register_username']));
	$password = protect(mysql_real_escape_string($_POST['register_password']));
	$name = protect(mysql_real_escape_string($_POST['register_firstname']));
	$surname = protect(mysql_real_escape_string($_POST['register_lastname']));
	$EMail = protect(mysql_real_escape_string($_POST['register_email']));
	$birthday = protect(mysql_real_escape_string($_POST['BirthDay']."-".$_POST['BirthMonth']."-".$_POST['BirthYear']));

if ($_POST['captcha'] == $_SESSION['cap_code']) {

//check to see if any of the boxes were not filled in
if(!$username || !$password || !$name || !$surname || !$EMail){
	//if any weren't display the error message
	echo "<div style='width: 960px; margin: 0 auto;'><div class='Reg_Error'>".$LANG['sources_Please_Fill_Out_All_Required_Fields']."</div></div>";
			}else{
	//if all were filled in continue checking
		//Check if the wanted username is more than 32 or less than 3 charcters long
		if(strlen($username) > 32 || strlen($username) < 5){
		echo "<div style='width: 960px; margin: 0 auto;'><div class='Reg_Error'>Dein Username muss mind. 6 Zeichen haben.</div></div>";
		}else{
		//if not continue checking

		//select all the rows from out users table where the posted username matches the username stored
		$res = mysql_query("SELECT * FROM users WHERE `username` = '".$username."'");
		$num = mysql_num_rows($res);

		//check if theres a match
		if($num == 1){
		//if yes the username is taken so display error message
		echo  "<div style='width: 960px; margin: 0 auto;'><div class='Reg_Error'>Der Username existiert leider bereits.</div></div>";
		}else{
		//otherwise continue checking

		//check if the password is less than 5 or more than 32 characters long
		if(strlen($password) < 5 || strlen($password) > 32){
		//if it is display error message
		echo "<div style='width: 960px; margin: 0 auto;'><div class='Reg_Error'>Dein Passwort mind. 6 Zeichen haben.</div></div>";
		}else{
		//else continue checking

		//check if the password and confirm password match
		if($password){

		//otherwise continue checking

	        //Set the format we want to check out email address against
			$checkemail = "/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";

			//check if the formats match
			if(!preg_match($checkemail, $EMail)){
			//if not display error message
			echo "<div style='width: 960px; margin: 0 auto;'><div class='Reg_Error'>eMail ist falsch oder nicht korrekt!</div></div>";
			}else{
			//if they do, continue checking

			//select all rows from our users table where the emails match
			$res1 = mysql_query("SELECT * FROM `users` WHERE `email` = '".$EMail."'");
			$num1 = mysql_num_rows($res1);

			//if the number of matchs is 1
			if($num1 == 1){
			//the email address supplied is taken so display error message
			echo "<div style='width: 960px; margin: 0 auto;'><div class='Reg_Error'>Diese eMail wird bereits benutzt.</div></div>";
			}else{
			//finally, otherwise register there account

			//time of register (unix)
			$registerTime = date('U');

			function generateActivationString() {
			   $randomSalt = '*&(*(JHjhkjnkjn9898';
			   $uniqId = uniqid(mt_rand(), true);
			   return md5($randomSalt.$uniqId);
			}

			//make a code for our activation key
			$act_code = generateActivationString();
			$username = protect(mysql_real_escape_string($_POST['register_username']));
	$password = md5(protect(mysql_real_escape_string($_POST['register_password'])));
	$name = protect(mysql_real_escape_string($_POST['register_firstname']));
	$surname = protect(mysql_real_escape_string($_POST['register_lastname']));
	$EMail = protect(mysql_real_escape_string($_POST['register_email']));
	$birthday = protect(mysql_real_escape_string($_POST['BirthDay']."-".$_POST['BirthMonth']."-".$_POST['BirthYear']));
	$hash= md5(date("DMdYGi"));

//insert the row into the database

$res2 = mysql_query("INSERT INTO `users` (`username`,`hash`,`password`, `email`, `first_name`, `last_name`, `photo`, `active`, `register_date`) VALUES('".$username."','".$hash."','".$password."','".$EMail."','".$name."','".$surname."','avatar-blank.jpg','1','".date("Y-m-d")."')");
$new_id = mysql_insert_id();
			// $_SESSION['username'] = $_POST['register_username'];
			// $_SESSION['first_name'] = $_POST['register_firstname'];
			// $_SESSION['last_name'] = $_POST['register_lastname'];
			// $_SESSION['email'] = $_POST['register_email'];

			//email verification mail

			$link = $root.'/view/verify/'.$new_id.'~'.$hash.'';
			$to      = 'ak75963@gmail.com';
			$subject = 'Thai-park Account Activation';
			$message = 'Please click the link below to activate your account' . "\r\n" . $link;
			$headers = 'From: admin@thai-park.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			mail($to, $subject, $message, $headers);


		//		header("Location: /");
		echo "<div style='width: 960px; margin: 0 auto;'><div style='color:green' class='Reg_Error'>Registration successful. Please click the verification link sent to your email.</div></div>";

									}
								}
							}
						}
					}
				}
			}


} else {
	echo "<div style='width: 960px; margin: 0 auto;'><div class='Reg_Error'>".$LANG['sources_Please_Write_Correct_Captcha_Code']."</div></div>";
}
}


// Activation
$stype = $_GET['stype'];

//check if there was no code found
if(!$stype){
  //if not display error message
  echo "";
  }else{
  //other wise continue the check

  //select all the rows where the accounts are not active
  $res = mysql_query("SELECT * FROM `users` WHERE `active` = '0'");

  //loop through this script for each row found not active
  while($row = mysql_fetch_assoc($res)){
  //check if the code from the row in the database matches the one from the user
  if($_GET['stype'] == $row['act_code']){
  //if it does then activate there account and display success message
  $res1 = mysql_query("UPDATE `users` SET `active` = '1' WHERE `id` = '".$row['id']."'");

// Login If Activated
$ACT_LOGIN['username'] = mysql_real_escape_string($row['username']);
$ACT_LOGIN['password'] = md5(mysql_real_escape_string($row['password']));
$ACT_LOGIN_QUERY = "SELECT * FROM users WHERE username='".$ACT_LOGIN['username']."' AND password='".$ACT_LOGIN['password']."'";
$ACT_LOGIN_RESULT = mysql_query($ACT_LOGIN_QUERY);
$ACT_LOGIN_ROW = mysql_num_rows($ACT_LOGIN_RESULT);
// Check email and password match
if(mysql_num_rows($ACT_LOGIN_RESULT)) {
	$ACT_LOGIN_ROW = mysql_num_rows($ACT_LOGIN_RESULT);
        // Set email session variable
		$_SESSION['id'] = $ACT_LOGIN_ROW['id'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['password'] = $row['password'];
        // Jump to secured page
        header('Location: /home');
} else {
        // Jump to login page
        header('Location: ');
}


  echo "<div style='width: 960px; margin: 0 auto;'><div class='Reg_Error'>Willkommen bei Thaipark! Du bist nun angemeldet.</div></div>";
}
}
}



// Lost Password
if($_POST['lost_submit']){
//if it is continue checks
         //store the posted email to variable after protection
         $EMail = $_POST['lost_email'];
         //check if the email box was not filled in
         if(!$EMail){
         //if it wasn't display error message
         $error = "<div style='width: 960px; margin: 0 auto;'><div class='Reg_Error'>Informationen fehlen.</div></div>";
         }else{
         //else continue checking
         //set the format to check the email against
         $checkemail = "/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
         //check if the email doesnt match the required format
         if(!preg_match($checkemail, $EMail)){
         //if not then display error message
         $error = "<div style='width: 960px; margin: 0 auto;'><div class='Reg_Error'>Falsche eMail.</div></div>";
         }else{
         //otherwise continue checking

         //select all rows from the database where the emails match
         $res = mysql_query("SELECT * FROM `users` WHERE `email` = '".$EMail."'");
         $num = mysql_num_rows($res);

         //check if the number of row matched is equal to 0
         if($num == 0){
         //if it is display error message
         $error = "<div style='width: 960px; margin: 0 auto;'><div class='Reg_Error'>eMail existiert nicht.</div></div>";
         }else{
         //otherwise complete forgot pass function
            $seed = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789');
            shuffle($seed);
            $rand = '';
            foreach (array_rand($seed, 7) as $k) $rand .= $seed[$k];

         //split the row into an associative array
         $lost_row = mysql_fetch_assoc($res);
            mysql_query("UPDATE `users` SET `password`='".md5($rand)."' WHERE `email`='".$EMail."'");
         //send email containing their password to their email address
		 header('Content-type: text/html; charset=utf-8\r\n');
         mail($EMail, 'Neues Thaipark Passwort',"Hallo,\n\nDein neues Passwort lautet: ".$rand."\nHier kannst du dich einloggen: www.thaipark.de\n
		 Du hast Fragen oder Anmerkungen?\ninfo@thaipark.de\n\n
		 Beste Gruesse aus Berlin\nDein Thaipark Team\n\n
		 Thaipark\nc/o Wolke8 Mediencenter\nGottlieb-Dunkel-Str. 43-44\n 12099 Berlin", 'From: '.EMAIL.'');

         //display success message
         $error= "<div style='width: 960px; margin: 0 auto;'><div class='Reg_Error'>Email sent.</div></div>";
}
}
}
}


// Profile Edit
if($_POST['edit_submit']){
	$username = $_POST['edit_username'];
	$password = md5($_POST['edit_password']);
	$EMail = $_POST['edit_email'];
	$name = $_POST['edit_firstname'];
	$surname = $_POST['edit_lastname'];

	$USER_SQL = mysql_query("SELECT * FROM users WHERE username = '".$_SESSION['username']."'");
	$USER_ROW = mysql_fetch_array($USER_SQL);
	mysql_query("UPDATE users SET password='".$password."', email='".$EMail."', first_name='".$name."', last_name='".$surname."'  WHERE id='".$USER_ROW['id']."'");
}

?>
