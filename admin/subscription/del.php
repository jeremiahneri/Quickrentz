<?php
include "../includes/database.php";

$id = $_GET['subscriber'];
// echo $id;

$sqlDelete = "DELETE FROM `subscription` WHERE `subsID` = '$id'";
mysqli_query($conn, $sqlDelete);
header("Location: subscribers.php");
?>