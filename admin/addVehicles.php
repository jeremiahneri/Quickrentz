<?php
include "includes/database.php";
session_start();

if (isset($_SESSION['AdminUsername'])&&isset($_SESSION['profilePhoto'])) {

    $username = $_SESSION['AdminUsername'];
    $profilePic = $_SESSION['profilePhoto'];
} else {

    header("Location: log-in.php");
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
    <title>Admin | Add Vehicles</title>
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
                <h1 class="col-md-12 px-3">Add Vehicle</h1>
                <hr>
            </div>
            <?php
            function generateUniqueFileName($originalFileName)
            {
                $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                $timestamp = time();
                $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);
                return $timestamp . "_" . $randomString . "." . $extension;
            }

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $vehicleModel = $_POST['VehicleModel'];
                $vehicleBrandID = $_POST['VehicleBrandID'];
                $vehicleYear = $_POST['year'];
                $vehicleType = $_POST['type'];
                $vehicleFuelType = $_POST['fuelType'];
                $vehicleTransmision = $_POST['transmision'];
                $vehicleMileage = $_POST['mileage'];
                $vehicleRate = $_POST['rate'];
                $vehicleSeatingCap = $_POST['seat'];
                $image1 = generateUniqueFileName($_FILES["image1"]["name"]);
                $image2 = generateUniqueFileName($_FILES["image2"]["name"]);
                $image3 = generateUniqueFileName($_FILES["image3"]["name"]);
                $image4 = generateUniqueFileName($_FILES["image4"]["name"]);

                move_uploaded_file($_FILES["image1"]["tmp_name"], "img/vehicleuploads/" . $image1);
                move_uploaded_file($_FILES["image2"]["tmp_name"], "img/vehicleuploads/" . $image2);
                move_uploaded_file($_FILES["image3"]["tmp_name"], "img/vehicleuploads/" . $image3);
                move_uploaded_file($_FILES["image4"]["tmp_name"], "img/vehicleuploads/" . $image4);


                $query = "INSERT INTO `vehicle`(`BrandID`, `Model`, `Year`, `Type`, `FuelType`, `Transmision`, `Mileage`, `SeatingCapacity`, `Rate`, `Image1`, `Image2`, `Image3`, `Image4`) VALUES ('$vehicleBrandID','$vehicleModel','$vehicleYear','$vehicleType','$vehicleFuelType','$vehicleTransmision','$vehicleMileage','$vehicleSeatingCap ','$vehicleRate','$image1','$image2','$image3','$image4')";
                mysqli_query($conn, $query);
            }
            ?>
            <div class="container p-2">
                <div style="border: 2px solid #000; border-radius: 8px;height: 100%; background-color: #F2C078;">
                    <div class="container p-4">
                        <form class="row g-3" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="VehicleModel" class="form-label">Vehicle Model</label>
                                <input type="text" class="form-control" name="VehicleModel" required>
                            </div>
                            <div class="col-md-4">
                                <label for="VehicleBrandID" class="form-label">Vehicle Brand</label>
                                <select class="form-select" name="VehicleBrandID" required>
                                <?php
                                    $sqlSelect = "SELECT * FROM `brand`";
                                    $initiateSqlSelect = mysqli_query($conn, $sqlSelect);
                                    while($result = mysqli_fetch_assoc($initiateSqlSelect)){
                                        echo "<option value='$result[BrandID]' selected>$result[brandName]</option>";
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="year" class="form-label">Year</label>
                                <input type="text" class="form-control" name="year" required>
                            </div>
                            <div class="col-md-4">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" class="form-select" required>
                                    <option selected>SUV</option>
                                    <option>Pick-up</option>
                                    <option>Sedan</option>
                                    <option>Mini Van</option>
                                    <option>Van</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="fuelType" class="form-label">Fuel Type</label>
                                <select name="fuelType" class="form-select" required>
                                    <option selected>Petrol</option>
                                    <option>Diesel</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="inputState" class="form-label">Transmision</label>
                                <select name="transmision" class="form-select" required>
                                    <option selected>Automatic</option>
                                    <option>Manual</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="mileage" class="form-label">Mileage</label>
                                <input type="text" class="form-control" name="mileage" required>
                            </div>
                            <div class="col-md-6">
                                <label for="rate" class="form-label">Price per day (in PHP)</label>
                                <input type="text" class="form-control" name="rate" required>
                            </div>
                            <div class="col-md-3">
                                <label for="seat" class="form-label">Seating Capacity</label>
                                <select name="seat" class="form-select" required>
                                    <option selected>4</option>
                                    <option>6</option>
                                    <option>8</option>
                                    <option>10</option>
                                    <option>16</option>
                                </select>
                            </div>
                            <h2>Upload Images</h2>
                            <div class="col-md-3">
                                <label for="type" class="form-label">Image 1</label>
                                <input type="file" class="form-control" accept=".jpg, .jpeg, .png" name="image1"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="type" class="form-label">Image 2</label>
                                <input type="file" class="form-control" accept=".jpg, .jpeg, .png" name="image2"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="type" class="form-label">Image 3</label>
                                <input type="file" class="form-control" accept=".jpg, .jpeg, .png" name="image3"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="type" class="form-label">Image 4</label>
                                <input type="file" class="form-control" accept=".jpg, .jpeg, .png" name="image4">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Add Vehicle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- CDN FOR PAGINATION -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
            </script>
        <script>
            $(".sidebar ul li").on('click', function () {
                $(".sidebar ul li.active").removeClass('active');
                $(this).addClass('active');
            });
            $(".open-btn").on('click', function () {
                $('.sidebar').addClass('active');
            });
            $(".close-btn").on('click', function () {
                $('.sidebar').removeClass('active');
            });
            new DataTable('#pagination');
        </script>
</body>

</html>