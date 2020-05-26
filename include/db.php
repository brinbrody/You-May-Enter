<?php
$user = "You-May-Enter";
$pass = "[2rq(qp.BQ6w";
$host = "localhost"; //Can be changed if needed... will need to test the connection first
$dbname = "You-May-Enter";

// Create connection
$db = new mysqli($host, $username, $password, $dbname);

// Check connection, die w/ error if failed.
if ($db->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>