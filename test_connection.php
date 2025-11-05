<?php

// Report all errors

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

// --- Connection Details ---

$servername = "127.0.0.1";

$username = "webapp_user";

$password = "Ubuntu@1235";

$dbname = "webapp_db";

// --- Create and Check Connection ---

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection error

if ($conn->connect_error) {

  die("Connection failed: " . $conn->connect_error);

}

// --- If Connection is Successful ---

echo "<h1>Connection Successful!</h1>";

echo "<p>PHP is successfully connected to the MySQL database '" . $dbname . "'.</p>";

$conn->close();

?>
