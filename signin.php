<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'login.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql="select * from customers 
    where username='$username' and password='$password'";

    $sql = "select * from customers where username = '$username'";
    $result=mysqli_query($conn,$sql);
    if($result){
        $num=mysqli_num_rows($result);
        if($num) {
            if($num>0) {
                echo "<p class='error-message'>Login successful</p>";
                    
            } else {
                echo "invalid data";
            }
        } else {
            echo "<p class='error-message'>Invalid username</p>";
        }
    } else {
        echo "<p class='error-message'>Connection error</p>";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Login page</title>
    <link rel="stylesheet" href="tyylit.css">
</head>
<body>
    <h2>Login to Library</h2>
    <form action="signin.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>


    
