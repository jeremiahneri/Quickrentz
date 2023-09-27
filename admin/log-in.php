<?php
session_start();
include "includes/database.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];


  if (!empty($email) && !empty($password) && !is_numeric($email)) {
    $select_query = "SELECT * FROM `admin` WHERE `Email` = '$email' LIMIT 1";
    $result = mysqli_query($conn, $select_query);

    if ($result && mysqli_num_rows($result) > 0) {
      $user_data = mysqli_fetch_assoc($result);

      if ($user_data['Password'] == $password) {

        $_SESSION['AdminUsername'] = $user_data['AdminUsername'];
        $_SESSION['profilePhoto'] = $user_data['Photo'];

        header("location: main.php");
        exit(); 
      } else {
        echo "<script type='text/javascript'>alert('Incorrect Email or Password!')</script>";
      }
    } else {
      echo "<script type='text/javascript'>alert('Incorrect Email or Password!')</script>";
    }
  } else {
    echo "<script type='text/javascript'>alert('Incorrect Email or Password!')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Log-in</title>
</head>
<body>
    <div class="container-fluid py-5" style="background-color: aqua;">
        <h1 class="text-center py-4">Login Page</h1>
        <div class="card mx-auto p-3" style="width: 50rem;">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
            <a href="signup.php">
              <p class="text-end" style="text-decoration: none !important;">Create Account</p>
            </a>
          </div>
            <button type="submit" name="submitbtn" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
        <!-- Js Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
</body>
</html>