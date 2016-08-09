<?php

$email = $_GET['email'];
$hash = $_GET['hash'];

$search = mysql_query("SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
$match  = mysql_num_rows($search);
if($match > 0){

  mysql_query("UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND email_verified='0'") or die(mysql_error());
  echo '<div class="statusmsg">Your account has been activated, you can now login</div>';

}
