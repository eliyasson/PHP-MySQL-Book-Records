<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'login.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    if ($user_type !== 'librarian' && $user_type !== 'customer') {
        echo "<p class='error-message'>Please select a user type (librarian or customer).</p>";
    } else {
        $insertQuery = "INSERT INTO customers (username, password, user_type)
                        VALUES ('$username', '$password', '$user_type')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            echo "<p class='success-message'>Signup Successful</p>";
            header('Location: signin.php');
            exit();
        } else {
            echo "<p class='error-message'>Insertion failed: " . mysqli_error($conn) . "</p>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .form-check.fw-bold {
            margin: 10px 50px;
            font-size: 16px;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
        .success-message {
            color: green;
            font-weight: bold;
        }
    </style>
    <title>Sign Up</title>

</head>
<body>
    <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignup">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">
            <form action="signup.php" method="post">
        <div class="modal-header p-5 pb-4 border-bottom-0">
        <h1 class="fw-bold mb-0 fs-2">Kirjaudu sisään</h1>
        <a href="frontpage.php" onclick="$('#yourModalId').modal('hide');" aria-label="Close">Close</a>
      </div>
        <p style="margin-left: 10px;"  class="fw-bold fs-5 mt-3">Ennen kuin rekisteröidyt, valitse roolisi: joko librarian or customer.</p>

        <div class="form-check fw-bold">
            <input class="form-check-input" type="radio" name="user_type" id="librarianRadio" value="librarian">
            <label class="form-check-label" for="librarianRadio">
                Librarian
            </label>
        </div>
        <div class="form-check fw-bold">
            <input class="form-check-input" type="radio" name="user_type" id="customerRadio" value="customer">
            <label class="form-check-label" for="customerRadio">
                Customer
            </label>
        </div>

        <div class="modal-body p-5 pt-0">
            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control rounded-3" id="floatingInput" placeholder="Username">
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
                <label  for="password">Password</label>
            </div>
            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit"  fdprocessedid="jmae6a">Sign Up</button>
            <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
            <hr class="my-4">
        </div>
      </form>

      </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
