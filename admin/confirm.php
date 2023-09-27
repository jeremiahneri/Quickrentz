<?php
include "includes/database.php";
session_start();

$id = $_GET['ReservationID'];
$status = "Booking Confirmed";


$updateStatus = "UPDATE `reservation` SET `Status`='$status' WHERE `ReservationID` = $id";
mysqli_query($conn, $updateStatus);

header('location: bookings.php')
?>