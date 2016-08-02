<?
ob_start();
session_start();

$root = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($root, -1)=="/")
$root = 'http://' . $_SERVER['SERVER_NAME'];
$document = '' . $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($document, -1)=="/")
$document = '' . $_SERVER['DOCUMENT_ROOT'];

include_once ('../includes/config.php');
include_once ('../includes/db_connect.php');

$id = $_POST['id'];
$user_id = $_POST['user_id'];
$news_id = $_POST['news_id'];
$action = $_GET['action'];

if(!isset($_SESSION['username'])) { 

} else {
	    $activities_sql = mysql_query("SELECT * FROM activities WHERE userId='".$user_id."' AND productId='".$news_id."'");
		$activities_row = mysql_fetch_row($activities_sql);
		if($activities_row['2'] == 'like') {
			$result_activities = mysql_query("UPDATE activities SET activity = '' WHERE userId='".$user_id."' AND productId='".$news_id."'");
			if($activities_row['2'] == '') {
				mysql_query("DELETE FROM activities WHERE userId='".$user_id."' AND productId='".$news_id."'");
			}
		}
		$delete = mysql_query("DELETE FROM comments WHERE c_id='".$id."'");
}
?>