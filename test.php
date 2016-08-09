<?php

error_reporting(1);
error_reporting(E_ALL ^ E_NOTICE);
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
