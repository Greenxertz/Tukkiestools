<?php
// require_once 'load_env.php';

// Load .env file
// load_env(__DIR__ . '/.env');

// Retrieve database credentials from environment variables
$db_server = "localhost";
$db_username =  "root";
$db_password =  "";
$db_name = "php_tukkiestools";

// Establish the connection
$conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);

// Check the connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Your code here...

// Close the connection when done
// mysqli_close($conn);
// 
