<?php
include "includes/database.php";

$id = $_GET['DeleteVehicleID'];
echo $id;

$sqlDelete = "DELETE FROM `vehicle` WHERE VehicleID = '$id'";
mysqli_query($conn, $sqlDelete);
header("Location: vehicles.php");
?>