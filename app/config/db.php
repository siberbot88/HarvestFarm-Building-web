<?php
// Database connection configuration
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "harvestfarm";

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set
$conn->set_charset("utf8");
?>