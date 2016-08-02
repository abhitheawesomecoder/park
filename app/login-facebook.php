<?php
/* DEFINE ROOT DIR */
define('ROOT_DIR', realpath(dirname(__FILE__).'/..'));

include_once ('facebook/facebook.php');

include_once (ROOT_DIR.'/includes/config.php');
include_once (ROOT_DIR.'/includes/site_info.php');

//connect to the database
mysql_connect(DATABASE_HOST,DATABASE_USERNAME,DATABASE_PASSWORD) or die(mysql_error());
mysql_select_db(DATABASE_NAME) or die(mysql_error());


mysql_query("SET NAMES utf8");

class User {

    function checkUser($uid,$oauth_provider,$username,$middle_name,$email,$birthday,$first_name,$last_name,$picture,$twitter_otoken,$twitter_otoken_secret) 
	{
		mysql_query("SET NAMES utf8");
        $query = mysql_query("SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'") or die(mysql_error());
        $result = mysql_fetch_array($query);
        if (!empty($result)) {
            # User is already present
        } else {
            #user not present. Insert a new Record
            $query = mysql_query("INSERT INTO `users` 
			(oauth_provider, oauth_uid, username,email,first_name,last_name,photo,register_date) 
			VALUES ('$oauth_provider', $uid, '".mysql_real_escape_string($username)."','$email','".mysql_real_escape_string($first_name)."','".mysql_real_escape_string($last_name)."','$picture','".date("Y-m-d")."')") or die(mysql_error());
            $query = mysql_query("SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'");
            $result = mysql_fetch_array($query);
            return $result;
        }
        return $result;
    }
	
	function checkUserGoogle($uid, $oauth_provider, $username, $email)
	{
        $query = mysql_query("SELECT * FROM `users` WHERE email = '$email' and oauth_provider = '$oauth_provider'") or die(mysql_error());
        $result = mysql_fetch_array($query);
        if (!empty($result)) {
            # User is already present
        } else {
            #user not present. Insert a new Record
            echo "INSERT INTO `users` (oauth_provider, oauth_uid, username, email) VALUES ('$oauth_provider', '$uid', '$username', '$email')";
            echo "<br/>INSERT INTO `users` (oauth_provider, oauth_uid, username, email) VALUES ('$oauth_provider', $uid, '$username', '$email')";
            $query = mysql_query("INSERT INTO `users` (oauth_provider, oauth_uid, username, email) VALUES ('$oauth_provider', '$uid', '$username', '$email')") or die(mysql_error());
            $query = mysql_query("SELECT * FROM `users` WHERE email = '$email' and oauth_provider = '$oauth_provider'");
            $result = mysql_fetch_array($query);
            return $result;
        }
        return $result;
    }

    

}


$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            ));

$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }






    if (!empty($user )) {
        # User info ok? Let's print it (Here we will be adding the login and registering routines)
  
        $username = mysql_real_escape_string($user_profile['name']);
			 $uid = $user_profile['id'];
		$middle_name = mysql_real_escape_string($user_profile['middle_name']);
		$email = mysql_real_escape_string($user_profile['email']);
		$first_name = mysql_real_escape_string($user_profile['first_name']);
		$last_name = mysql_real_escape_string($user_profile['last_name']);
		$birthday = $user_profile['birthday'];
		$picture = "https://graph.facebook.com/".$uid."/picture?width=140&height=140";
        $user = new User();
        $userdata = $user->checkUser($uid, 'facebook', $username,$middle_name,$email,$birthday,$first_name,$last_name,$picture,$twitter_otoken,$twitter_otoken_secret);
        if(!empty($userdata)){
            session_start();
            $_SESSION['id'] = $userdata['id'];
 $_SESSION['oauth_id'] = $uid;

            $_SESSION['middle_name'] = $userdata['middle_name'];
			$_SESSION['username'] = $userdata['username'];
			$_SESSION['birthday'] = $userdata['birthday'];
			$_SESSION['first_name'] = $userdata['first_name'];
			$_SESSION['last_name'] = $userdata['last_name'];

			$_SESSION['email'] = $email;
            $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
            header("Location: /");
        }
    } else {
        # For testing purposes, if there was an error, let's kill the script
        die("There was an error.");
    }
} else {
    # There's no active session, let's generate one
	$login_url = $facebook->getLoginUrl(array( 'scope' => 'email'));
    header("Location: " . $login_url);
}
?>
