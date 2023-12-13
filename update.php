<!DOCTYPE html>
<html>
<head>
    <title>Book Records</title>
    <link rel="stylesheet" href="tyylit2.css">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: signin.php');
    exit();
}
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
die("Fatal Connection Error");
}


// Function to sanitize user inputs
function get_post($conn, $var) {
    return $conn->real_escape_string($_POST[$var]);
}

// Update book record if 'Update' is submitted
if (isset($_POST['update']) && isset($_POST['isbn'])) {
    $author = get_post($conn, 'author');
    $title = get_post($conn, 'title');
    $category = get_post($conn, 'category');
    $year = get_post($conn, 'year');
    $isbn = get_post($conn, 'isbn');
    $quantity = get_post($conn, 'quantity');

    // Prepare and execute the UPDATE query using prepared statement
    $stmt = $conn->prepare("UPDATE books SET author=?, title=?, catagory=?, year=?, quantity=? WHERE isbn=?");
    $stmt->bind_param("ssssis", $author, $title, $category, $year, $quantity, $isbn);

    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('location:home.php');
    } else {
        echo "UPDATE failed: " . $conn->error . "<br><br>";
    }
} else {
    echo "No data to update.<br><br>";
}

// Display the form to update records
echo <<<HTML
<form action="update.php" method="post">
    <pre>
        Author:   <input type="text" name="author">
        Title:    <input type="text" name="title">
        Category: <input type="text" name="category">
 Year:     <input type="text" name="year">
        ISBN:     <input type="text" name="isbn">
        Quantity: <input type="text" name="quantity">
        <input type="submit" name="update" value="Update">
    </pre>
</form>
HTML;
?>
</body>
</html>