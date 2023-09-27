<?php
session_start();
include "admin/includes/database.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){

  $email = $_POST['email'];
  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $phone = $_POST['phonenumber'];
  $address = $_POST['address'];
  $password = $_POST['password'];
  $conpassword = $_POST['conpassword'];
  $photo = "avatar1.png";
  $status = "Not Yet Verified";

  if(!empty($email) && !empty($password) && !is_numeric($email)){


    if($password == $conpassword){

      $check_query = "SELECT * FROM `user` WHERE `Email` = '$email'";
      $result = mysqli_query($conn, $check_query);

      if(mysqli_num_rows($result) == 0){
        
        $check_query = "SELECT * FROM `user` WHERE `username` = '$username'";
        $result = mysqli_query($conn, $check_query);

        if(mysqli_num_rows($result) == 0){

          // $enc_password = password_hash($password, $password_default);

          $insert = "INSERT INTO `user`(`Username`, `FirstName`, `LastName`, `PhoneNumber`, `Address`, `Email`, `Password`, `Status`, `Photo`) VALUES ('$username','$fname','$lname','$phone','$address','$email','$password','$status','$photo')";
          mysqli_query($conn, $insert);

          echo "<script type='text/javascript'>alert('Successully Registered!')</script>";
          header("location: log-in.php");

        }else{
          echo "<script type='text/javascript'>alert('Username already exist!')</script>";
        }
        
      }else{
        
        echo "<script type='text/javascript'>alert('Email is already taken!')</script>";
      }

    }else{
      echo "<script type='text/javascript'>alert('Password didnt matched!')</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/signup_login_style.css">
    <title>Signup</title>
</head>
<body>
    <div class="container">
        <form method="POST" class="form-signup">
            <h2 class="mb-3 text-center" style="color:#806393;">Register</h2>
            <p class="text-center text-light mb-4 mt-0">Create your account</p>
            <div class="row mb-4">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="fname" placeholder="First Name">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="lname" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group mb-4">
                <input type="text" class="form-control" name="username" placeholder="User Name">
            </div>
            <div class="form-group mb-4">
                <input type="email" class="form-control" name="email" placeholder="Email Address">
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="phonenumber" placeholder="Contact Number">
                </div>
                <div class="col-md-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                        <label class="form-check-label text-light" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                        <label class="form-check-label  text-light" for="female">Female</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group mb-4">
                <input type="text" class="form-control" name="address" placeholder="Address">
            </div>
            <div class="form-group mb-4">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group mb-4">
                <input type="password" class="form-control" name="conpassword" placeholder="Confirm Password">
            </div>
            <div class="form-group mb-4">
                <label class="form-check-label">
                    <input type="checkbox" name="" required> 
                    <span style="color: white;">I accept the <a href="#" style="color:#806393;">Terms of Use</a> & <a href="#" style="color:#806393;">Privacy Policy</a></span>
                </label>
            </div>
            <input type="submit" class="btn mt-2 w-100 mb-4 text-light" style="background-color:#806393;" name="submitbtn">
        </form>
    </div>
</body>
</html>