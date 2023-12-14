<?php
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Fatal connection Error");
    }
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
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Device Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1>Add a New Device</h1>
        <form action="newdevice.php" method="post">
            <div class="form-group">
                <label for="device">Device</label>
                <input type="text" name="device" id="device">
            </div>
            <div class="form-group">
                <label for="maker">Maker</label>
                <input type="text" name="maker" id="maker">
            </div>
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" name="model" id="model">
            </div>
            <div class="form-group">
                <label for="year">Year</label>
                <input type="text" name="year" id="year">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="text" name="stock" id="stock">
            </div>
            <div class="form-group">
                <label for="loans">Loans</label>
                <input type="text" name="loans" id="loans">
            </div>
            
            <input type="submit" value="ADD DEVICE" class="btn">
        </form>
        
        <div class="device-info">
            <?php
                $query = "SELECT * FROM devices";
                $result = $conn->query($query);
            
                if (!$result) {
                    die("Database access failed: " . $conn->error);
                }
            
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
                
                function get_post($conn, $var) {
                    return $conn->real_escape_string($_POST[$var]);
                }
            ?>
        </div>
    </div>
</body>
</html>
