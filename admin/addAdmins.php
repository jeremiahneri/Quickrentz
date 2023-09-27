<?php
include "includes/database.php";
session_start();

if (isset($_SESSION['AdminUsername']) && isset($_SESSION['profilePhoto'])) {

    $username = $_SESSION['AdminUsername'];
    $profilePic = $_SESSION['profilePhoto'];
} else {

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin | Add Admins</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main-container d-flex h-100">
        <div class="sidebar bg-dark" id="side_nav">
            <div class="header-box px-3 pt-3 pd-4 d-flex justify-content-between">
                <h2 class="text-white px-2">
                    QuickRentz
                </h2>
                <button class="btn d-md-none d-block close-btn px-1 py-0"><i class="fa-solid fa-bars-staggered"
                        style="color: #ffffff;"></i>
                </button>
            </div>
            <ul class="list-unstyled px-2 pt-3">
                <li class="p-3"><a href="main.php" class="text-decoration-none fs-4"><i class="fa-solid fa-gauge"></i>
                        Dashboard</a></li>
                <li class="p-3"><a href="bookings.php" class="text-decoration-none fs-4"><i
                            class="fa-regular fa-pen-to-square"></i> Manage Booking</a></li>
                <li class="p-3"><a href="manageUsers.php" class="text-decoration-none fs-4"><i
                            class="fa-solid fa-users-gear"></i> Manage Users</a></li>
                <li class="p-3"><a href="users.php" class="text-decoration-none fs-4"><i class="fa-solid fa-users"></i>
                        Users Credential</a></li>
                <li class="p-3"><a href="vehicles.php" class="text-decoration-none fs-4"><i class="fa-solid fa-car"></i>
                        Manage Vehicle</a></li>
                <li class="p-3 active"> <a class="text-decoration-none fs-4" data-bs-toggle="collapse"
                        href="#collapseAdd" role="button" aria-expanded="false" aria-controls="collapseAdd"><i
                            class="fa-solid fa-plus"></i>
                        Add <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <ul class="collapse list-unstyled" id="collapseAdd">
                        <a class="text-decoration-none fs-5 " href="addVehicles.php">
                            <li class="pb-2 px-5">Car</li>
                        </a>
                        <a class="text-decoration-none fs-5 " href="addBrand.php">
                            <li class="pb-2 px-5">Brand</li>
                        </a>
                        <a class="text-decoration-none fs-5" href="addAdmins.php">
                            <li class="pb-2 px-5">Admin</li>
                        </a>
                    </ul>
                </li>
            </ul>
            <ul class="list-unstyled signout px-4">
                <li>
                    <form method="POST" action="">
                        <a class="text-decoration-none fs-4" href="log-out.php" type="button">Log-out <i
                                class="fa-solid fa-arrow-right-from-bracket"></i></a>
                    </form>
                </li>
            </ul>
        </div>
        <div class="content">
            <?php include "includes/navbar.php"; ?>
            <div class="container-fluid bg-white">
                <h1 class="col-md-12 px-3">Add Admin</h1>
                <hr>
            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $AdminFname = $_POST['fname'];
                $AdminLname = $_POST['lname'];
                $AdminPhone = $_POST['number'];
                $AdminFullAdd = $_POST['address'];
                $AdminEmail = $_POST['email'];
                $AdminUsername = $_POST['username'];
                $AdminPassword = $_POST['password'];

                if (!empty($AdminFname) && !empty($AdminLname) && !empty($AdminEmail) && !empty($AdminPassword) && !is_numeric($AdminEmail)) {

                    $insert = "INSERT INTO `admin`(`FirstName`, `LastName`, `PhoneNumber`, `Address`, `AdminUsername`, `Email`, `Password`) VALUES ('$AdminFname','$AdminLname','$AdminPhone','$AdminFullAdd','$AdminUsername','$AdminEmail','$AdminPassword')";
                    mysqli_query($conn, $insert);

                    echo "<script>alert('Admin Added Successfully!');</script>";
                } else {
                    echo "<script>alert('Invalid Characters');</script>";
                }
            }
            ?>
            <div class="container p-2">
                <div style="border: 2px solid #000; border-radius: 8px;height: 100%; background-color: #C1DBB3;">
                    <div class="container p-4">
                        <form class="row g-3" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname">
                            </div>
                            <div class="col-md-6">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lname">
                            </div>
                            <div class="col-md-3">
                                <label for="number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="number">
                            </div>
                            <div class="col-md-9">
                                <label for="address" class="form-label">Full Address</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <hr>
                            <h3>Log-in Details</h3>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Add Admin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</body>

</html>