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


if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];

    // Retrieve book details based on ISBN
    $query = "SELECT * FROM books WHERE isbn='$isbn'";
    $result = $conn->query($query);

    if (!$result) {
        echo "Error fetching data: " . $conn->error;
	exit(); 
   } else {
        $row = $result->fetch_assoc();
        $quantity = $row['quantity'];

        // Check if the book is available
        if ($quantity > 0) {
            // Reduce the quantity by 1 (assuming a book is borrowed)
            $newQuantity = $quantity - 1;

            // Update the book quantity in the database
            $updateQuery = "UPDATE books SET quantity=$newQuantity WHERE isbn='$isbn'";
            $updateResult = $conn->query($updateQuery);

            if (!$updateResult) {
                echo "Error updating book quantity: " . $conn->error;
            } else {
                // Display book details after borrowing
                ?>
                <pre>
                    <p>Author: <?php echo htmlspecialchars($row['author']); ?></p>
                    <p>Title: <?php echo htmlspecialchars($row['title']); ?></p>
                    <p>Category: <?php echo htmlspecialchars($row['catagory']); ?></p>
                    <p>Year: <?php echo htmlspecialchars($row['year']); ?></p>
                    <p>ISBN: <?php echo htmlspecialchars($row['isbn']); ?></p>
                    <p>Quantity after borrowing: <?php echo htmlspecialchars($newQuantity); ?></p>
                    <p>Book borrowed successfully!</p>
                </pre>
                <?php
            }
        } else {
            echo " The book is not available for borrowing. ";
        }
    }
}

$conn->close();
?>

