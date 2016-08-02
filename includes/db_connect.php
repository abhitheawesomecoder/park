<?php
header( 'Content-Type: text/html; charset=utf-8' );
//connect to the database
mysql_connect(DATABASE_HOST,DATABASE_USERNAME,DATABASE_PASSWORD) or die(mysql_error());
mysql_select_db(DATABASE_NAME) or die(mysqli_connect_error());
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET NAMES 'utf8'");
?>
