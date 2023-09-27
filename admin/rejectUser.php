<?php
include "includes/database.php";
session_start();

$id = $_GET['UserID'];
$status = "Account Rejected";


$updateStatus = "UPDATE `user` SET `Status`='$status' WHERE `UserID` = $id";
mysqli_query($conn, $updateStatus);

header('location: manageUsers.php');
?>