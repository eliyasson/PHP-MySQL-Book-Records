
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'login.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM customers WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_type = $row['user_type'];

            session_start();
            $_SESSION['username'] = $username;

            if ($user_type === 'librarian') {
                header('Location: home.php');
                exit();
            } else if ($user_type === 'customer') {
                header('Location: user.php');
                exit();
            }
        } else {
            echo "<p class='error-message'>Invalid username or password</p>";
        }
    } else {
        echo "<p class='error-message'>Error in query: " . mysqli_error($conn) . "</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
 <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignup">

  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <h1 class="fw-bold mb-0 fs-2">Kirjaudu sisään</h1>
        <a href="frontpage.php" onclick="$('#yourModalId').modal('hide');" aria-label="Close">Close</a>

      </div>

      <div class="modal-body p-5 pt-0">
        <form action="signin.php" method="post">
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control rounded-3" id="floatingInput" placeholder="Username">
            <label for="username">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" fdprocessedid="fqch9">
            <label  for="password">Password</label>
          </div>
          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit"  fdprocessedid="jmae6a">Kirjaudu</button>
          <hr class="my-4">
          <h2 class="fs-5 fw-bold mb-3">Jos sinulla ei ole tiliä, paina Sign up</h2>
        </form>
        <form action="signup.php" method="post">
          <button class="w-100 py-2 mb-2 btn btn-outline-primary rounded-3" type="submit" fdprocessedid="e7wrx4">
            <svg class="bi me-1" width="16" height="16"><use xlink:href="#facebook"></use></svg>
            Sign up
          </button>
        </form>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>



    
