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

$query = "SELECT * FROM borrowed_books WHERE user_id = ?"; // Change this query as needed to fetch the user's borrowed books
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$borrowed_books = [];
while ($row = $result->fetch_assoc()) {
    $borrowed_books[] = $row;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your HTML head content -->
</head>
<body>
    <h1>List of Borrowed Books</h1>
    <ul>
        <?php foreach ($borrowed_books as $book): ?>
            <li>
                <!-- Display borrowed book information -->
                <!-- Adjust this section to display the necessary information for each borrowed book -->
                Title: <?php echo $book['title']; ?><br>
                Author: <?php echo $book['author']; ?><br>
                Borrowed on: <?php echo $book['borrow_date']; ?><br>
                Return by: <?php echo $book['return_date']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

