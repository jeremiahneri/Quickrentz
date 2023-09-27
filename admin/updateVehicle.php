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
    <title>Admin | Update Vehicle</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main-container d-flex h-100">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pd-4 d-flex justify-content-between">
                <h2 class="text-white px-2">QuickRentz</h2>
                <button class="btn d-md-none d-block close-btn px-1 py-0"><i class="fa-solid fa-bars-staggered"
                        style="color: #ffffff;"></i></button>
            </div>
            <ul class="list-unstyled px-2 pt-3">
                <li class="p-3"><a href="main.php" class="text-decoration-none fs-4">Dashboard</a></li>
                <li class="p-3"><a href="#" class="text-decoration-none fs-4">Manage Booking</a></li>
                <li class="p-3"><a href="users.php" class="text-decoration-none fs-4">Customer Credential</a></li>
                <li class="p-3"><a href="vehicles.php" class="text-decoration-none fs-4">Manage Vehicle</a></li>
                <li class="p-3 active"> <a class="text-decoration-none fs-4" data-bs-toggle="collapse"
                        href="#collapseAdd" role="button" aria-expanded="false" aria-controls="collapseAdd">Add <i
                            class="fa-solid fa-caret-down"></i>
                    </a>
                    <ul class="collapse list-unstyled" id="collapseAdd">
                        <li><a class="text-decoration-none fs-5 p-3" href="addVehicles.php">Car</a></li>
                        <li><a class="text-decoration-none fs-5 p-3" href="addAdmins.php">Admin</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="list-unstyled signout px-4">
                <li>
                    <form method="POST" action="">
                        <a class="text-decoration-none fs-4" href="log-out.php" type="button">Log-out</a>
                    </form>
                </li>
            </ul>
        </div>
        <div class="content">
            <nav class="navbar navbar-expand-lg bg-dark">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <a class="navbar-brand text-white" href="#">QuickRentz</a>
                        <button class="btn d-md-none d-block open-btn px-1 py-0"><i class="fa-solid fa-bars-staggered"
                                style="color: #000000;"></i></button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="profile collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <h5 class="text-white my-auto p-4">
                                <img src='img/adminprofilephoto/<?php echo $profilePic ?>' alt='' style='border:2px solid #000;border-radius: 50px;' height='50'>
                                    <?php
                                    echo $username;
                                    ?>
                                </h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <h1 class="col-md-12 px-3">Update Vehicle</h1>
            <hr>
            <?php
            $id = $_GET['UpdateVehicleID'];

            $sqlSelect = "SELECT * FROM `vehicle` WHERE `VehicleID` = '$id'";

            $initiateVehicle = mysqli_query($conn, $sqlSelect);
            $results = mysqli_fetch_assoc($initiateVehicle);

            if (isset($_POST['update'])) {
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $newvehicleModel = $_POST['VehicleModel'];
                    $newvehicleBrand = $_POST['VehicleBrand'];
                    $newvehicleYear = $_POST['year'];
                    $newvehicleType = $_POST['type'];
                    $newvehicleFuelType = $_POST['fuelType'];
                    $newvehicleTransmision = $_POST['transmision'];
                    $newvehicleMileage = $_POST['mileage'];
                    $newvehicleRate = $_POST['rate'];
                    $newvehicleSeatingCap = $_POST['seat'];

                    $updateVehicle = "UPDATE `vehicle` SET `BrandID`='$newvehicleBrand',`Model`='$newvehicleModel',`Year`='$newvehicleYear',`Type`='$newvehicleType',`FuelType`='$newvehicleFuelType',`Transmision`='$newvehicleTransmision',`Mileage`='$newvehicleMileage',`SeatingCapacity`='$newvehicleSeatingCap',`Rate`='$newvehicleRate' WHERE `VehicleID` = '$id'";
                    mysqli_query($conn, $updateVehicle);
                    // if (mysqli_query($conn, $updateVehicle)) {
                    //     header("location: vehicles.php");
                    // } else {
                    //     echo "Error updating record: " . mysqli_error($conn);
                    // }
                }
            }
            ?>
            <div class="container p-2">
                <div style="border: 2px solid #000; border-radius: 8px;height: 100%;">
                    <div class="container p-4">
                        <form class="row g-3" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="VehicleModel" class="form-label">Vehicle Model</label>
                                <input type="text" class="form-control" name="VehicleModel"
                                    value="<?php echo htmlentities($results['Model']) ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="VehicleBrand" class="form-label">Vehicle Brand</label>
                                <select class="form-select" name="VehicleBrand"
                                    value="<?php echo htmlentities($results['BrandID']) ?>">
                                    <?php 
                                        $selectBrand = "SELECT `brandName` FROM `brand` WHERE `BrandID` = $results[BrandID]";
                                        $initiateselectBrand = mysqli_query($conn,$selectBrand);
                                        $result = mysqli_fetch_assoc($initiateselectBrand);
                                    ?>
                                    <option value="<?php echo htmlentities($results['BrandID']) ?>" selected><?php echo htmlentities($result['brandName']) ?></option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="year" class="form-label">Year</label>
                                <input type="text" class="form-control" name="year"
                                    value="<?php echo htmlentities($results['Year']) ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" class="form-select"
                                    value="<?php echo htmlentities($results['Type']) ?>">
                                    <option <?php if ($results['Type'] === 'SUV')
                                        echo 'selected'; ?>>SUV</option>
                                    <option <?php if ($results['Type'] === 'Pick-up')
                                        echo 'selected'; ?>>Pick-up</option>
                                    <option <?php if ($results['Type'] === 'Sedan')
                                        echo 'selected'; ?>>Sedan</option>
                                    <option <?php if ($results['Type'] === 'Mini Van')
                                        echo 'selected'; ?>>Mini Van
                                    </option>
                                    <option <?php if ($results['Type'] === 'Van')
                                        echo 'selected'; ?>>Van</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="fuelType" class="form-label">Fuel Type</label>
                                <select name="fuelType" class="form-select"
                                    value="<?php echo htmlentities($results['FuelType']) ?>">
                                    <option <?php if ($results['FuelType'] === 'Petrol')
                                        echo 'selected'; ?>>Petrol
                                    </option>
                                    <option <?php if ($results['FuelType'] === 'Diesel')
                                        echo 'selected'; ?>>Diesel
                                    </option>>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="inputState" class="form-label"
                                    value="<?php echo htmlentities($results['Transmision']) ?>">Transmision</label>
                                <select name="transmision" class="form-select">
                                    <option <?php if ($results['Transmision'] === 'Automatic')
                                        echo 'selected'; ?>>
                                        Automatic</option>
                                    <option <?php if ($results['Transmision'] === 'Manual')
                                        echo 'selected'; ?>>Manual
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="mileage" class="form-label">Mileage</label>
                                <input type="text" class="form-control" name="mileage"
                                    value="<?php echo htmlentities($results['Mileage']) ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="rate" class="form-label">Price per day (in PHP)</label>
                                <input type="text" class="form-control" name="rate"
                                    value="<?php echo htmlentities($results['Rate']) ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="seat" class="form-label">Seating Capacity</label>
                                <select name="seat" class="form-select"
                                    value="<?php echo htmlentities($results['SeatingCapacity']) ?>">
                                    <option <?php if ($results['SeatingCapacity'] === '4')
                                        echo 'selected'; ?>>4</option>
                                    <option <?php if ($results['SeatingCapacity'] === '6')
                                        echo 'selected'; ?>>6</option>
                                    <option <?php if ($results['SeatingCapacity'] === '8')
                                        echo 'selected'; ?>>8</option>
                                    <option <?php if ($results['SeatingCapacity'] === '10')
                                        echo 'selected'; ?>>10
                                    </option>
                                    <option <?php if ($results['SeatingCapacity'] === '16')
                                        echo 'selected'; ?>>16
                                    </option>
                                </select>
                            </div>
                            <h2>Update Images</h2>

                            <div class="col-md-3 text-center" id="update-img">
                                <img src="img/vehicleuploads/<?php echo htmlentities($results['Image1']) ?>"
                                    style="border: 1px solid #000;" alt="" height="150">
                                <br>
                                <a href="changeimage1.php?updateid=<?php echo $id ?>"
                                    class="text-decoration-none">Change Image 1</a>
                            </div>
                            <div class="col-md-3 text-center" id="update-img">
                                <img src="img/vehicleuploads/<?php echo htmlentities($results['Image2']) ?>"
                                    style="border: 1px solid #000;" alt="" height="150">
                                <br>
                                <a href="changeimage2.php?updateid=<?php echo $id ?>"
                                    class="text-decoration-none">Change Image 2</a>
                            </div>
                            <div class="col-md-3 text-center" id="update-img">
                                <img src="img/vehicleuploads/<?php echo htmlentities($results['Image3']) ?>"
                                    style="border: 1px solid #000;" alt="" height="150">
                                <br>
                                <a href="changeimage3.php?updateid=<?php echo $id ?>"
                                    class="text-decoration-none">Change Image 3</a>
                            </div>
                            <div class="col-md-3 text-center" id="update-img">
                                <img src="img/vehicleuploads/<?php echo htmlentities($results['Image4']) ?>"
                                    style="border: 1px solid #000;" alt="" height="150">
                                <br>
                                <a href="changeimage4.php?updateid=<?php echo $id ?>"
                                    class="text-decoration-none">Change Image 4</a>
                            </div>

                            <div class="col-12 text-center" id="update-img">
                                <button type="submit" class="btn btn-primary" name="update">Update Vehicle</button>
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