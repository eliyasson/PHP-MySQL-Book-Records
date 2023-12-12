<!DOCTYPE html>
<html>
<head>
    <title>Book Records</title>
    <link rel="stylesheet" href="tyylit2.css">
</head>
<body>
<?php
// Include login credentials
require_once 'login.php';

// Establish connection to the database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Fatal connection Error: " . $conn->connect_error);
}

// Function to sanitize user inputs
function get_post($conn, $var) {
    return $conn->real_escape_string($_POST[$var]);
}

// Update book record if 'Update' is submitted
if (isset($_POST['submit'])) {
    $author = get_post($conn, 'author');
    $title = get_post($conn, 'title');
    $category = get_post($conn, 'category');
    $year = get_post($conn, 'year');
    $isbn = get_post($conn, 'isbn');
    $quantity = get_post($conn, 'quantity');

    // Prepare and execute the UPDATE query using prepared statement
    $stmt = $conn->prepare("UPDATE books SET author=?, title=?, category=?, year=?, quantity=? WHERE isbn=?");
    $stmt->bind_param("ssssi", $author, $title, $category, $year, $isbn, $quantity);
    
    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
    } else {
        echo "UPDATE failed: " . $conn->error . "<br><br>";
    }
}

// Display the form to update records
echo <<<_END
<form action="home.php" method="post"><pre>
Author:         <input type="text" name="author">
Title:          <input type="text" name="title">
Category:       <input type="text" name="category">
Year:           <input type="text" name="year">
ISBN:           <input type="text" name="isbn">
Quantity:       <input type="text" name="quantity">
<input type="submit" name="submit" value="Update">
</pre></form>
_END;
?>
</body>
</html>
