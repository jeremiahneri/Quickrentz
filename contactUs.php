<?php
include "admin/includes/database.php";
session_start();

if (isset($_POST['send'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $insertMsg = "INSERT INTO `message`(`Name`, `Email`, `Message`) VALUES ('$name','$email','$message')";
  mysqli_query($conn, $insertMsg);

  echo "<script>alert('Message Sent!')</script>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/contactUs.css">
  <title>Contact Us</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1 class="text-center">Contact Us</h1>
        <form method="POST">
          <!-- Form fields go here -->
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter your name">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email">
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" rows="5" placeholder="Enter your message"></textarea>
          </div>
          <button type="submit" name="send" class="btn w-100 text-light"
            style="background-color: #806393;">Submit</button>
        </form>
      </div>
    </div>
  </div>

</body>

</html>