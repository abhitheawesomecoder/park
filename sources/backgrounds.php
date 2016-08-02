<?php
session_start();

while($row = mysql_fetch_array($result)) {
echo '$row["background;],';
}

$backgrounds = array('1','2','3','4','5');


if($_SESSION['background'] == '') {
	$_SESSION['background'] = '1';
}

  if(isset($_GET['background']) && $_GET['background'] != ''){ 
    // check if the language is one we support
    if(in_array($_GET['background'], $backgrounds))
    {       
      $_SESSION['background'] = $_GET['background']; // Set session
    }
  }
  
while($row2 = mysql_fetch_array($result2)) {
echo '$row2["background;],';
}

$backgrounds2 = array('6','7','8','9','10');


if($_SESSION['background2'] == '') {
	$_SESSION['background2'] = '6';
}

  if(isset($_GET['background']) && $_GET['background'] != ''){ 
    // check if the language is one we support
    if(in_array($_GET['background'], $backgrounds2))
    {       
      $_SESSION['background2'] = $_GET['background']; // Set session
    }
  }
?>