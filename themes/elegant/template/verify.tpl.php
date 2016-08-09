<?php

$action = $_GET['action'];

$arr = explode("~",$action);

$search = mysql_query("SELECT * FROM users WHERE id='".$arr[0]."' AND hash='".$arr[1]."' AND email_verified='0'") or die(mysql_error());
$match  = mysql_num_rows($search);
if($match > 0){

  mysql_query("UPDATE users SET email_verified='1' WHERE id='".$arr[0]."' AND hash='".$arr[1]."' AND email_verified='0'") or die(mysql_error());
  echo '<div class="statusmsg">Your account has been activated, you can now login</div>';

}else{
  echo "SELECT email, hash, email_verified FROM users WHERE email='".$email."' AND hash='".$hash."' AND email_verified='0'";
}
