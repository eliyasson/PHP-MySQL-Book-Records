<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="sqltest.php" method="post">
        <input type="checkbox" name="pizza" value="Pizza">Pizza<br>
        <input type="checkbox" name="hamburger" value="Hamburger">Hamburger<br>
        <input type="checkbox" name="hotdog" value="Hotdog">Hotdog<br>
        <input type="checkbox" name="tacoa" value="Taco">Taco<br>
        <input type="submit" name="submit">
    </form>
    
</body>
</html>

<?php
    if(isset($_POST["submit"])) {
        if(isset($_POST["pizza"])) {
            echo "You like Pizza";
        }
    }
?>