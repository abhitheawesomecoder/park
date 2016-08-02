<?php
ob_start();
require("twitter/twitteroauth.php");

include_once ('../includes/config.php');
include_once ('../includes/site_info.php');

//connect to the database
mysql_connect(DATABASE_HOST,DATABASE_USERNAME,DATABASE_PASSWORD) or die(mysql_error());
mysql_query("SET NAMES utf8");
mysql_select_db(DATABASE_NAME) or die(mysql_error());


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
	
	function checkUserTwitter($uid,$oauth_provider,$username,$first_name,$picture,$twitter_otoken,$twitter_otoken_secret) 
	{
		mysql_query("SET NAMES utf8");
        $query = mysql_query("SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'") or die(mysql_error());
        $result = mysql_fetch_array($query);
        if (!empty($result)) {
            # User is already present
        } else {
            #user not present. Insert a new Record
$username = mysql_real_escape_string($username);
$first_name = mysql_real_escape_string($first_name);
$date = date("Y-m-d");
            $query = mysql_query("INSERT INTO `users` 
			(oauth_provider, oauth_uid, username,first_name,photo,register_date) 
			VALUES ('$oauth_provider', '$uid', '$username','$first_name','avatar-blank.jpg','$date')") or die(mysql_error());
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



session_start();

if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
    // We've got everything we need
    $twitteroauth = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
// Let's request the access token
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var
    $_SESSION['access_token'] = $access_token;
// Let's get the user's info
    $user_info = $twitteroauth->get('account/verify_credentials');
// Print user's info
    echo '<pre>';
    //print_r($user_info);
    echo '</pre><br/>';
    if (isset($user_info->error)) {
        // Something's wrong, go back to square 1  
        header('Location: login-twitter.php');
    } else {
	   $twitter_otoken=$_SESSION['oauth_token'];
	   $twitter_otoken_secret=$_SESSION['oauth_token_secret'];
	   $email='';
        $uid = $user_info->id;
        $username = $user_info->name;
		$first_name = $user_info->name;
		$picture = $user_info->profile_image_url;
        $user = new User();
        $userdata = $user->checkUserTwitter($uid, 'twitter', $username,$first_name,$picture,$twitter_otoken,$twitter_otoken_secret);
        if(!empty($userdata)){
            session_start();
            $_SESSION['id'] = $userdata['id'];
 $_SESSION['oauth_id'] = $uid;
 
			$_SESSION['username'] = $userdata['username'];
			$_SESSION['first_name'] = $userdata['first_name'];
            $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
            header("Location: /");
        }
    }
} else {
    // Something's missing, go back to square 1
    header('Location: login-twitter.php');
}
?>
