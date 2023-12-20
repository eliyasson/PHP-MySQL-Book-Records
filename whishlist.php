<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: signin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_to_remove'])) {
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error) {
        die("Fatal Error");
    }

    $id_to_remove = $_POST['id_to_remove'];

    // Delete the item from the wish list based on the provided ID
    $query = "DELETE FROM wishvolume WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        echo "Query preparation error: " . $conn->error;
        exit();
    }

    $stmt->bind_param("i", $id_to_remove);
    $stmt->execute();

    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
        echo "Item removed successfully";
    } else {
        echo "Failed to remove item";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="tyylit2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="$
</head>
<body style="isolatio: isolate;">
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="frontpage.php" class="d-flex align-items-center link-body-emphasis text-decoration-none">
                <span class="fs-4">Mysqli Kirjasto</span>
                </a>
                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="user.php">kirjalissraus</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="borrow.php">Laitteiden Lainaus</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="wishlist.php">Wish List</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="chat.php">Chat</a>
                    <a class="py-2 link-body-emphasis text-decoration-none" href="logout.php">Logout</a>
                </nav>
            </div>
        </header>
    <h2>Lähetä meille kirjatoive</h2>
</div>
</body>
</html>

<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

$query_create_table = "CREATE TABLE IF NOT EXISTS libkeliyas.wishvolume (
    author VARCHAR(100),
    title VARCHAR(100),
    year VARCHAR(4),
    publisher VARCHAR(100),
    id INT AUTO_INCREMENT PRIMARY KEY
)";

if ($conn->query($query_create_table) === TRUE) {
    echo "Table 'wishvolume' created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
} 
if (isset($_POST['author']))
{
$author = get_post($conn, 'author');
$title = get_post($conn, 'title');
$year = get_post($conn, 'year');
$publisher = get_post($conn, 'publisher');
$id = get_post($conn, 'id');
$query = "INSERT INTO wishvolume VALUES" . "('$author','$title','$year','$publisher','$id')";
$result = $conn->query($query);
if (!$result) echo "INSERT failed<br><br>";
}
echo <<<_END
<center>
<form action ="wishlist.php" method="post"><pre>
Author:          <input type ="text" name="author">
Title:           <input type ="text" name="title">
Year:            <input type ="text" name="year">
Publisher:       <input type ="text" name="publisher">
ID:              <input type ="text" name="id">
<input type="submit" value="Send">
</pre></form></center>
_END;
$query = "SELECT * FROM wishvolume";
$result = $conn->query($query);
if (!$result) die ("Database access failed");
$rows = $result->num_rows;
for ($j = 0; $j < $rows; ++$j)
{
$row = $result->fetch_array(MYSQLI_NUM);
$r0 = htmlspecialchars($row[0]);
$r1 = htmlspecialchars($row[1]);
$r2 = htmlspecialchars($row[2]);
$r3 = htmlspecialchars($row[3]);
$r4 = htmlspecialchars($row[4]);
echo <<<_END
<center><pre>
Author:          $r0
Title:           $r1
Year:            $r2
Publisher:       $r3
ID:              $r4
<form action="wishlist.php" method="post">
        <input type="hidden" name="id_to_remove" value="$r4">
        <input type="submit" value="Remove">
    </form>
</pre></center>
_END;
}
$result->close();
$conn->close();
function get_post($conn, $var)
{
return $conn->real_escape_string($_POST[$var]);
}
?>
