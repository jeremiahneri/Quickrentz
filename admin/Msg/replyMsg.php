<?php
include "../includes/database.php";

$id = $_GET['ReplyMsgID'];
// echo $id;

$sqlDelete = "DELETE FROM `message` WHERE `MessageID` = '$id'";
mysqli_query($conn, $sqlDelete);
header("Location: messages.php");
?>