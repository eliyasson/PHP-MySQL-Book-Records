<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: signin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_to_add'])) {
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error) {
        die("Fatal Error");
    }
    $id_to_add = $_POST['id_to_add'];

    $query = "SELECT * FROM wishvolume WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        echo "Query preparation error: " . $conn->error;
        exit();
    }

    $stmt->bind_param("i", $id_to_add);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $author = $row['author'];
        $title = $row['title'];
        $year = $row['year'];
        $publisher = $row['publisher'];
        $isbn = $row['id'];
        $quantity = 1;

        $insert_query = "INSERT INTO books (author, title, catagory, year, isbn, quantity) VALUES (?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);

        if ($insert_stmt === false) {
            echo "Insert query preparation error: " . $conn->error;
            exit();
        }

        $insert_stmt->bind_param("sssssi", $author, $title, $publisher, $year, $isbn, $quantity);
        $insert_stmt->execute();

        if ($insert_stmt->affected_rows > 0) {
            echo "Book added successfully to the book list";
        } else {
            echo "Failed to add book to the list";
        }
    } else {
        echo "Book not found in wish list";
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
        background-color: #8EC5FC;
        background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);

        }
    </style>
</head>
<body style="isolatio: isolate;">
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="frontpage.php" class="d-flex align-items-center link-body-emphasis text-decoration-none">
                <span class="fs-4">Mysqli Kirjasto</span>
                </a>
                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="home.php">Lisää kirjoja</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="newdevice.php">Lisää laitteita</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="displaywish.php">Customer wishes</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="displaychat.php">viestejä</a>
                    <a class="py-2 link-body-emphasis text-decoration-none" href="logout.php">Logout</a>
                </nav>
            </div>
        </header>
    <h3>Tämä on asiakkaan toivomia kirjoja. Jos löydät kirjan, voit klikata 'Lisää kirjalistaan'.</h3>
</div>
</body>
</html>

<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

$query = "SELECT * FROM wishvolume";
$result = $conn->query($query);
if (!$result) die ("Database access failed");
$rows = $result->num_rows;
for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $r0 = htmlspecialchars($row['author']);
    $r1 = htmlspecialchars($row['title']);
    $r2 = htmlspecialchars($row['year']);
    $r3 = htmlspecialchars($row['publisher']);
    $r4 = htmlspecialchars($row['id']);
    echo <<<HTML
    <center><pre>
    Author:          $r0
    Title:           $r1
    Year:            $r2
    Publisher:       $r3
    ID:              $r4
    <form action="displaywish.php" method="post">
        <input type="hidden" name="id_to_add" value="$r4">
        <input type="submit" value="Lisää kirjalistaan">
    </form>
    </pre></center>
HTML;
}
$result->close();
$conn->close();
function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}
?>
