<?php
$servername = "localhost";
$username = "mpapin_clg_rfid";
$password = "password@TPI";
$db = "mpapin_clg_rfid_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
//echo "Connected successfully";
}
?>