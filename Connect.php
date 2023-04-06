<?php

$host = "bbc353.encs.concordia.ca";
$user = "bbc353_4";
$password = "e35gt765";
$dbname = "bbc353_4";

// Connect to MySQL server
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

?>
