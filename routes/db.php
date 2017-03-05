<?php
function getDB() {
	$dbhost = "tyrant.local";
	$dbusername = "root";
	$dbuserpassword = "";
	$dbname = "androidmoviedb";
	
	// Create a DB connection
	$conn = new mysqli ( $dbhost, $dbusername, $dbuserpassword, $dbname );
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error . "\n" );
	}
	
	return $conn;
}