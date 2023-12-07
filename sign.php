<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'login.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* $sql = "INSERT INTO customers (username,password)
    values('$username', '$password')";
    $result = mysqli_query($conn, $sql);

    if($result) {
        echo "Data inserted successfully";
    } else {
        die("Connection failed" . mysqli_error($conn));
    } */
    $sql = "select * from customers where username = '$username'";
    $result=mysqli_query($conn,$sql);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0) {
            echo "Username already exist";
        } else {
            $sql = "INSERT INTO customers (username,password)
            values('$username', '$password')";
            $result = mysqli_query($conn, $sql);
        
            if($result) {
                echo "Signup Successful";
            } else {
                die("Connection failed" . mysqli_error($conn));
            }
        }
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="tyylit.css">
</head>
<body>
    <h2>Sign Up</h2>
    <form action="signup_process.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <input type="submit" value="Sign Up">
    </form>
</body>
</html>


