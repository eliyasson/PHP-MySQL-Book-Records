<?php
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Fatal connection Error");
    }
    if (isset($_POST['delete']) && isset($_POST['device'])) {
        $device = get_post($conn, 'device');
        $query = "DELETE FROM devices WHERE device='$device'";
        $result = $conn->query($query);
        if (!$result) {
            echo "DELETE failed<br><br>";
        }
    }
    $query = "SELECT * FROM devices";
    $result=$conn->query($query);
    if (!$result) die ("Database access failed");
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title>Delete Device</title>
        <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
            <h1>Delete Device</h1>
        <div class="device-info">
        <?php
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
                function get_post($conn,$var)
                {
                return $conn->real_escape_string($_POST[$var]);
                }
            ?>

    </div>
    </div>
</body>
</html>