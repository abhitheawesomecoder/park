<?php
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
include_once ('../sources/functions.php');
include_once ('../includes/languages.php');

$id = $_POST['id'];
$user_id = $_POST['user_id'];
$action = $_POST['action'];

if(!isset($_SESSION['username'])) { 

$q = "SELECT * FROM comments_votes WHERE news_id = $id";
$r = mysql_query($q);
if($r) //voting done
	{
		echo "".$LANG['sources_HAVE_AN_ACCOUNT']." <a href='../view/login' target='_blank' style='color: #0087F7; text-decoration: none; font-weight: bold;'>".$LANG['header_LOGIN_title']."</a>";
	}
elseif(!$r) //voting failed
	{
		$effectiveVote = getEffectiveVotes($id);
		echo $effectiveVote." ".$LANG['sources_POINTS_title'];
	}
	

} else {

function getAllVotes($id)
	{
	/**
	Returns an array whose first element is votes_up and the second one is votes_down
	**/
	$votes = array();
	$q = "SELECT * FROM comments_votes WHERE news_id = $id";
	$r = mysql_query($q);
	if(mysql_num_rows($r)==1)//id found in the table
		{
		$row = mysql_fetch_assoc($r);
		$votes[0] = $row['votes'];
		}
	return $votes;
	}

function getEffectiveVotes($id)
	{
	/**
	Returns an integer
	**/
	$q = "SELECT * FROM comments_votes WHERE news_id = $id";
	$r = mysql_query($q);
	$effectiveVote = mysql_num_rows($r);
	return $effectiveVote;
	}

//get the current votes
$cur_votes = getAllVotes($id);

//ok, now update the votes

if($action=='vote_up') //voting up
{
	$votes_up = $cur_votes[0]+1;
	$query_distinct = mysql_query("SELECT * FROM comments_votes WHERE news_id='$id' AND user_id='$user_id'");
	if (mysql_num_rows($query_distinct) )
    {
    
    } else {
		$result = mysql_query('INSERT INTO comments_votes (news_id, user_id) VALUES ("'.$id.'", "'.$user_id.'")');
	}
}
elseif($action=='vote_down') //voting down
{
	$votes_down = $cur_votes[1]+1;
	$query_distinct = mysql_query("SELECT * FROM comments_votes WHERE news_id='$id' AND user_id='$user_id'");
	if (mysql_num_rows($query_distinct) )
    {
    	mysql_query('DELETE FROM comments_votes WHERE news_id="'.$id.'" AND user_id="'.$user_id.'"');
    } else {
		
	}
}

$r = mysql_query($q);
if($r) //voting done
	{
		$effectiveVote = getEffectiveVotes($id);
		echo "<font style='font-weight: bold;color: #08f'>".$effectiveVote." ".$LANG['sources_POINTS_title']."</font>";
	}
elseif(!$r) //voting failed
	{
		$effectiveVote = getEffectiveVotes($id);
		echo "<font style='font-weight: bold;color: #08f'>".$effectiveVote." ".$LANG['sources_POINTS_title']."</font>";
	}
	
}
?>