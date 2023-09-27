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
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <title>Login</title>
  </head>
  <body>

    <div class="loginform mt-5" >
        <h3 class="text-center" style="color:#806393;">Admin Login</h3>

    <div class="container">
        <form method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="Enter Email" name="email" aria-describedby="emailHelp">
              <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" placeholder="Enter Password" name="password">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                &nbsp;&nbsp; <a href="#" style="color:#806393;">Forgot password?</a>
            </div>
            <button type="submit" class="btn col-lg-12 col-12 mt-2 mb-3 text-light" style="background-color:#806393;" name="submitbtn">Login</button>
          </form>

    </div>
</div> 

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  
  </body>
</html>