
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
$id = get_post($conn, 'id');
$query = "INSERT INTO wishvolume VALUES" . "('$author','$title','$year','$publisher','$id')";
$result = $conn->query($query);
if (!$result) echo "INSERT failed<br><br>";
}
echo <<<_END
<center>
<form action ="wishlist.php" method="post"><pre>
Author          <input type ="text" name="author">
Title           <input type ="text" name="title">
Year            <input type ="text" name="year">
Publisher       <input type ="text" name="publisher">
ID              <input type ="text" name="id">
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
Author          $r0
Title           $r1
Year            $r2
Publisher       $r3
ID              $r4
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
