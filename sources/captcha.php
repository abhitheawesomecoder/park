<?php
/* DEFINE ROOT DIR */
define( 'ROOT_DIR', realpath(dirname(__FILE__) . '/..') );
session_start();
$ranStr = md5(microtime());
$ranStr = substr($ranStr, 0, 6);
$_SESSION['cap_code'] = $ranStr;
$newImage = imagecreatefromjpeg(ROOT_DIR."/themes/default/images/cap_bg.jpg");
$txtColor = imagecolorallocate($newImage, 0, 0, 0);
imagestring($newImage, 5, 5, 5, $ranStr, $txtColor);
header("Content-type: image/jpeg");
imagejpeg($newImage);
?>