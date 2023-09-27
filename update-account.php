<?php
include "admin/includes/database.php";



$username = $_GET['username'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$address = $_GET['address'];

$updateUser = "UPDATE `user` SET `Username`='$username',`FirstName`='$fname',`LastName`='$lname',`PhoneNumber`='$phone',`Address`='$address',`Email`='$email' WHERE `UserID` = $userID";
mysqli_query($conn, $updateUser);

echo "<script>alert('Information Updated')</script>";

?>