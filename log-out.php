<?php
    include "admin/includes/database.php";
    session_start();

    unset($_SESSION['username']);

    header("location: index.php");
    exit;
?>