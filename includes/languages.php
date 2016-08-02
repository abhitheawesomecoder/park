<?php
ob_start();
session_start();

$document = '' . $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($document, -1)=="/")
$document = '' . $_SERVER['DOCUMENT_ROOT'];

$languages = array('de', 'en', 'th');

  if(isset($_GET['lang']) && $_GET['lang'] != ''){
    // check if the language is one we support
    if(in_array($_GET['lang'], $languages))
    {
      $_SESSION['lang'] = $_GET['lang']; // Set session
	  setcookie("lang", $_SESSION['lang'], time()+60*60*24*15);
    }
  }

if($_REQUEST['lang'] == '') {
	if($_SESSION['lang'] == '') {
		$_SESSION['lang'] = "de";
	} else {
		$_SESSION['lang'] = $_SESSION['lang'];
	}
}

$SETTINGS = get_settings();	

  if($_SESSION['lang'] == '') {
    $session_lang = "de";
  } else {
    $session_lang = $_SESSION['lang'];
  }

// do stuff with LANG constant
include($document.'/languages/'.$session_lang.'/'.$_GET['view'].'.php');
include('../languages/'.$session_lang.'/theme.php');
include($document.'/languages/'.$session_lang.'/theme.php');
include($document.'/languages/'.$session_lang.'/upload.php');

$LANG['lang_en'] = "English";
$LANG['lang_ru'] = "Русский";
$LANG['lang_ge'] = "ქართული";
?>