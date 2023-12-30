<?php
$credentialsFile = '/www/keliyas/projectityö/credentials.json'; 

$credentials = json_decode(file_get_contents($credentialsFile), true);

if (!$credentials) {
    // Log the error or handle it internally without exposing detailed information
    error_log("Error reading credentials from JSON file");
    // Display a generic error message to the user
    die("Error reading credentials. Please contact the system administrator.");
}

$hn = $credentials['hn'];
$db = $credentials['db'];
$un = $credentials['un'];
$pw = $credentials['pw'];

// Attempt to connect to the database
$conn = mysqli_connect($hn, $un, $pw, $db);

// Check the connection
if (!$conn) {
    // Log the error or handle it internally without exposing detailed information
    error_log("Connection failed: " . mysqli_connect_error());
    // Display a generic error message to the user
    die("Connection failed. Please contact the system administrator.");
}
?>
