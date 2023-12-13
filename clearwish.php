<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");
if (isset($_POST['delete']) && isset($_POST['author']))
{
$author = get_post($conn,'author');
$query = "DELETE FROM wishvolume WHERE author='$author'";
$result = $conn->query($query);
if (!$result) echo "DELETE failed <br><br>";
}
$query = "SELECT * FROM wishvolume";
$result = $conn->query($query);
if (!$result) die("Database access failed");
$rows = $result->num_rows;
for ($j = 0; $j < $rows ; ++$j)
{
$row = $result->fetch_array(MYSQLI_NUM);
$r0 = htmlspecialchars($row[0]);
$r1 = htmlspecialchars($row[1]);
$r2 = htmlspecialchars($row[2]);
$r3 = htmlspecialchars($row[3]);
$r4 = htmlspecialchars($row[4]);
echo <<<_END
<center><pre>
Author:         $r0
Title:          $r1
Year:           $r2
Publisher:      $r3
ID:             $r4 </pre>
<form action='clearwish.php' method='post'>
<input type='hidden' name='delete' value='yes'>
<input type='hidden' name='author' value='$r0'>
<input type='submit' value='REMOVE'></form>
</center>
_END;
}
$result->close();
$conn->close();
function get_post($conn, $var)
{
return $conn->real_escape_string($_POST[$var]);
}
?>
