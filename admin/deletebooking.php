<?php
include "includes/database.php";

$id = $_GET['ReservationID'];


$sqlDelete = "DELETE FROM `reservation` WHERE ReservationID = '$id'";
mysqli_query($conn, $sqlDelete);
header("Location: bookings.php");
?>