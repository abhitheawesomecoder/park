<?php

include_once("includes/paypal.class.php");
include_once ('sources/process.php');

$expiry_date = $_SESSION["expiry_date"];
$transaction_id = $_SESSION["transation_id"];

//echo $expiry_date." ".$transaction_id." ".$members['id'];

mysql_query("UPDATE users SET expiry_date='$expiry_date',transation_id='$transaction_id' WHERE id='".$members['id']."'");
?>
<h1 style="padding: 100px;color: green;"">Transaction Successfull. Click to go to <a href="/">home</a></h1>
