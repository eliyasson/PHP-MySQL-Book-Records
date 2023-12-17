
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: signin.php');
    exit();
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
                <a href="welcome.php" class="d-flex align-items-center link-body-emphasis text-decoration-none">
		<svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
</svg>
                    <span class="fs-4">Mysqli Kirjasto</span>
                </a>
                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="home.php">Lisää kirjoja</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="newdevice.php">Lisää laitteita</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">Chat</a>
                    <a class="py-2 link-body-emphasis text-decoration-none" href="logout.php">Logout</a>
                </nav>
            </div>
        </header>
    <h2>Lisää laitteet tietokantaan</h2>
</div>

<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Connection Error");
if (isset($_POST['device'])) {
    $device = get_post($conn, 'device');
    $maker = get_post($conn, 'maker');
    $model = get_post($conn, 'model');
    $year = get_post($conn, 'year');
    $stock = get_post($conn, 'stock');
    $loans = get_post($conn, 'loans');
    $query = "INSERT INTO devices (device, maker, model, year, stock, loans) VALUES ('$device', '$maker', '$model', '$year', '$stock', '$loans')";

    $result = $conn->query($query);
    if(!$result) echo "INSERT failed<br><br>";
} echo <<<HTML

<form action="newdevice.php" method="post"><pre>
    Device  <input type="text" name="device">
    Maker   <input type="text" name="maker">
    Model   <input type="text" name="model">
    Year    <input type="text" name="year">
    Stock   <input type="text" name="stock">
    Loans   <input type="text" name="loans">
    <input type="submit" value="ADD DEVICE">
</pre></form>
HTML;
$query = "SELECT * from devices";
$result = $conn->query($query);
if(!$result) die ("Database access failed");

while ($row = $result->fetch_array(MYSQLI_NUM)) {
    $r0 = htmlspecialchars($row[0]);
    $r1 = htmlspecialchars($row[1]);
    $r2 = htmlspecialchars($row[2]);
    $r3 = htmlspecialchars($row[3]);
    $r4 = htmlspecialchars($row[4]);
    $r5 = htmlspecialchars($row[5]);
    echo "<center><pre>";
    echo "Device: $r0<br>";
    echo "Maker: $r1<br>";
    echo "Model: $r2<br>";
    echo "Year: $r3<br>";
    echo "Stock: $r4<br>";
    echo "Loans: $r5<br>";
    echo "<form action='deldevice.php' method='post'>";
    echo "<input type='hidden' name='delete' value='yes'>";
    echo "<input type='hidden' name='device' value='$r0'>";
    echo "<input type='submit' value='DELETE DEVICE'>";
    echo "</form>";
    echo "</pre></center>";


}
$result->close();
$conn->close();
function get_post($conn, $var)
{
return $conn->real_escape_string($_POST[$var]);
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>


