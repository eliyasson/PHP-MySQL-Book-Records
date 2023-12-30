<?php
require_once 'login.php';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) {
    die("Fatal Error");
}

if (isset($_POST['delete']) && isset($_POST['name'])) {
    $name = get_post($conn, 'name');
    $query = "DELETE FROM libusers WHERE name='$name'";
    $result = $conn->query($query);

    if (!$result) {
        echo "DELETE failed<br><br>";
    }
}

if (
    isset($_POST['name']) &&
    isset($_POST['address']) &&
    isset($_POST['email']) &&
    isset($_POST['mobile']) &&
    isset($_POST['cardnum']) &&
    isset($_POST['ldate']) &&
    isset($_POST['rdate']) &&
    isset($_POST['isbn'])
) {
    $name = get_post($conn, 'name');
    $address = get_post($conn, 'address');
    $email = get_post($conn, 'email');
    $mobile = get_post($conn, 'mobile');
    $cardnum = get_post($conn, 'cardnum');
    $ldate = get_post($conn, 'ldate');
    $rdate = get_post($conn, 'rdate');
    $isbn = get_post($conn, 'isbn');

    $query = "INSERT INTO libusers VALUES ('$name', '$address', '$email', '$mobile', '$cardnum', '$ldate', '$rdate', '$isbn')";
    $result = $conn->query($query);

    if (!$result) {
        echo "INSERT failed<br><br>";
    }
}

echo <<<_END
<form action="user.php" method="post">
    <pre>
        Name <input type="text" name="name">
        Address <input type="text" name="address">
        Email <input type="text" name="email">
        Mobile <input type="text" name="mobile">
        Cardnum <input type="text" name="cardnum">
        Ldate <input type="text" name="ldate">
        Rdate <input type="text" name="rdate">
        ISBN <input type="text" name="isbn">
        <input type="submit" value="Add USER">
    </pre>
</form>
_END;

$query = "SELECT * from libusers";
$result = $conn->query($query);
if (!$result) {
    die("Database access failed");
}

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_NUM);

    $r0 = htmlspecialchars($row[0]);
    $r1 = htmlspecialchars($row[1]);
    $r2 = htmlspecialchars($row[2]);
    $r3 = htmlspecialchars($row[3]);
    $r4 = htmlspecialchars($row[4]);
    $r5 = htmlspecialchars($row[5]);
    $r6 = htmlspecialchars($row[6]);
    $r7 = htmlspecialchars($row[7]);
    echo <<<_END
    <pre>
        Name $r0
        Address $r1
        Email $r2
        Mobile $r3
        Cardnum $r4
        Date $r5
        Rdate $r6
        ISBN $r7
    </pre>
    
    <form action='user.php' method='post'>
        <input type='hidden' name='delete' value='yes'>
        <input type='hidden' name='name' value='$r0'>
        <input type='submit' value='DELETE USER'>
    </form>
_END;
} 
$result->close();   
$conn->close();

function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}
?>

