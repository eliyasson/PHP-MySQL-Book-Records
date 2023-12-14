<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Fatal connection Error");
}

if (isset($_POST['username'])) {
    $username = get_post($conn, 'username');
    $message = get_post($conn, 'message');
    $timestamp = get_post($conn, 'timestamp'); // Corrected 'timetamp' to 'timestamp'

    $query = "INSERT INTO messages (username, message, timestamp) VALUES ('$username', '$message', '$timestamp')";
    $result = $conn->query($query);
    if (!$result) {
        echo "INSERT failed<br><br>";
    }
}

echo <<<_END
<form action="chat.php" method="post"><pre>
Username: <input type="text" name="username">
Message: <textarea type="text" name="message"></textarea>
Timestamp: <input type="text" name="timestamp">
<input type="submit" value="send">
</pre></form></center>
_END;

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
    echo <<<_END
    <pre>
    Id: $r0
    Username: $r1
    Message: $r2
    Timestamp: $r3
    </pre>
_END;
}

$result->close();
$conn->close();

function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}
?>
