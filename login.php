<?php
$hn = 'localhost';
$db = 'libkeliyas';
$un = 'kassaye';
$pw = 'tietomekaanikko';

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

