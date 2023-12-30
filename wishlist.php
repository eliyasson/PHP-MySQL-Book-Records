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

    $query = "DELETE FROM wishvolume WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        echo "Query preparation error: " . $conn->error;
        exit();
    }

    $stmt->bind_param("i", $id_to_remove);
    $stmt->execute();

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    body {
     background-image: linear-gradient(0deg, #D9AFD9 0%, #97D9E1 100%);
    }
    </style>
</head>
<body style="isolatio: isolate;">
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="frontpage.php" class="d-flex align-items-center link-body-emphasis text-decoration-none">
		<svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
</svg>
                    <span class="fs-4">Mysqli Kirjasto</span>
                </a>
                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="availablebook.php">kirjalissraus</a>
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
if (isset($_POST['author']))
{
$author = get_post($conn, 'author');
$title = get_post($conn, 'title');
$year = get_post($conn, 'year');
$publisher = get_post($conn, 'publisher');
$id = get_post($conn, 'isbn');
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
ID:              <input type ="text" name="isbn">
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

