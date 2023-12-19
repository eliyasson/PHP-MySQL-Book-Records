
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
                <a href="" class="d-flex align-items-center link-body-emphasis text-decoration-none">
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

