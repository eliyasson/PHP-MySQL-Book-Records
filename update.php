<!DOCTYPE html>
<html>
<head>
    <title>Update Book Record</title>
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

function get_post($conn, $var) {
    return $conn->real_escape_string($_POST[$var]);
}

if (isset($_POST['isbn'])) {
    $isbn = get_post($conn, 'isbn');
    $query = "SELECT * FROM books WHERE isbn='$isbn'";
    $result = $conn->query($query);
    if (!$result) {
        echo "Error fetching data: " . $conn->error;
    } else {
        $row = $result->fetch_assoc();
        $author = $row['author'];
        $title = $row['title'];
        $catagory = $row['catagory'];
        $year = $row['year'];
        $quantity = $row['quantity'];
    }
}

if (isset($_POST['update']) && isset($_POST['isbn'])) {
    $author = get_post($conn, 'author');
    $title = get_post($conn, 'title');
    $catagory = get_post($conn, 'catagory');
    $year = get_post($conn, 'year');
    $isbn = get_post($conn, 'isbn');
    $quantity = get_post($conn, 'quantity');

    $stmt = $conn->prepare("UPDATE books SET author=?, title=?, catagory=?, year=?, quantity=? WHERE isbn=?");
    $stmt->bind_param("ssssis", $author, $title, $catagory, $year, $quantity, $isbn);

    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('location:home.php');
    } else {
        echo "UPDATE failed: " . $conn->error . "<br><br>";
    }
} else {
    echo "No data to update.<br><br>";
}
?>
<form action="update.php" method="post">
    <pre>
        Author:   <input type="text" name="author" value="<?php echo $author ?? ''; ?>">
        Title:    <input type="text" name="title" value="<?php echo $title ?? ''; ?>">
        Category: <input type="text" name="catagory" value="<?php echo $catagory ?? ''; ?>">
        Year:     <input type="text" name="year" value="<?php echo $year ?? ''; ?>">
        ISBN:     <input type="text" name="isbn" value="<?php echo $isbn ?? ''; ?>" readonly>
        Quantity: <input type="text" name="quantity" value="<?php echo $quantity ?? ''; ?>">
        <input type="submit" name="update" value="Update">
    </pre>
</form>
</body>
</html>

