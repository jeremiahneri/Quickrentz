<?php
    include "includes/database.php";
    session_start();

    unset($_SESSION['AdminUsername']);

    header("location: index.php");
    exit;
?>