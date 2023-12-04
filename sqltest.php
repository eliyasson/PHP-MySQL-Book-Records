<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="sqltest.php" method="post">
        <label for="username">username:</label><br>
        <input type="text" name="username"></label><br>
        <label for="password">password:</label><br>
        <input type="password" name="password"></label><br>
        <input type="submit" name="login" value="Log in">
    </form>
    
</body>
</html>

<?php
    if(isset($_POST["login"])) {
        $username  = $_POST["username"];
        $password  = $_POST["password"];

        if(empty($username)){
            echo "Username is missing!";
        } elseif(empty($password)){
            echo "Password is missing!";
        } else {
            echo "Hello {$username}";
        }
    } 
?>