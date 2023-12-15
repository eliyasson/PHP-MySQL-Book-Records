<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Fatal connection Error");
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get values from the form
    $username = $_POST['username'];
    $message = $_POST['message'];
    
    // Use the current timestamp for the database insertion
    $timestamp = date('Y-m-d H:i:s'); // Format the timestamp as per your database column

    // Insert data into the database
    $query = "INSERT INTO messages (username, message, timestamp) VALUES ('$username', '$message', '$timestamp')";
    $result = $conn->query($query);

    if (!$result) {
        echo "INSERT failed: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
</head>
<body>

<form action="chat.php" method="post">
    <pre>
        Username: <input type="text" name="username">
        Message: <textarea name="message"></textarea>
        <input type="submit" value="Send">
    </pre>
</form>

<?php
// Display the messages
$query = "SELECT * FROM messages";
$result = $conn->query($query);

if (!$result) {
    die("Database access failed: " . $conn->error);
}

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $r0 = htmlspecialchars($row['id']);
    $r1 = htmlspecialchars($row['username']);
    $r2 = htmlspecialchars($row['message']);
    $r3 = htmlspecialchars($row['timestamp']);
    
    echo "<pre>";
    echo "Id: $r0<br>";
    echo "Username: $r1<br>";
    echo "Message: $r2<br>";
    echo "Timestamp: $r3<br>";
    echo "</pre>";
}

$result->close();
$conn->close();
?>
</body>
</html>
