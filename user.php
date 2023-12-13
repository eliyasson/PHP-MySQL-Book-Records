
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


$query = "SELECT * FROM books";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    // Handle error in the query preparation
    echo "Query preparation error: " . $conn->error;
    exit();
}
$stmt->execute();
$result = $stmt->get_result();
$books = [];
while ($row = $result->fetch_assoc()) {
        $books[] = $row;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
        <title>Käyttäjäsivu</title>
        <style>
          body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        .book {
            width: 20%;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
           display: inline-block;
           vertical-align: top;
           box-sizing: border-box;

        }
        .book p {
            margin: 5px 0;
        }
        </style>
</head>
<body>
        <?php foreach ($books as $book): ?>
        <div class="book">

        <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
            <p>Title: <?php echo htmlspecialchars($book['title']); ?></p>
            <p>Category: <?php echo htmlspecialchars($book['catagory']); ?></p>
            <p>Year: <?php echo htmlspecialchars($book['year']); ?></p>
            <p>ISBN: <?php echo htmlspecialchars($book['isbn']); ?></p>
            <p>Quantity: <?php echo htmlspecialchars($book['quantity']); ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
