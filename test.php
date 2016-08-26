<?php

error_reporting(1);
error_reporting(E_ALL ^ E_NOTICE);


		//	$link = $root.'/view/verify/'.$new_id.'~'.$hash.'';
			$to      = 'ak75963@gmail.com';
			$subject = 'Thai-park Account Activation';
			$message = 'Please click the link below to activate your account';
			$headers = 'From: admin@thai-park.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			$ret = mail($to, $subject, $message, $headers);

			echo $ret;

/*
$servername = "localhost";
$username = "root";
$password = "welcome1";
$dbname = "thaipark";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
*/
