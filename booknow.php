<?php
include "admin/includes/database.php";
session_start();

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    $userID = $_SESSION['UserID'];
    // $profilePic = $_SESSION['profilePhoto'];
} else {

    header("Location: log-in.php");
    exit;
}
$id = $_GET['VehicleID'];


$selectVehicle = "SELECT vehicle.*, brand.brandName FROM vehicle LEFT JOIN brand ON vehicle.BrandID = brand.BrandID WHERE vehicle.VehicleID = $id;";
$initiateVehicle = mysqli_query($conn, $selectVehicle);
$result = mysqli_fetch_assoc($initiateVehicle);


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fromdate = $_POST['fromDate'];
    $todate = $_POST['toDate'];
    $message = $_POST['message'];
    $status = "Not yet Confirmed";

    $insert = "INSERT INTO `reservation`(`UserID`, `VehicleID`, `Pickup`, `Return`, `Message`, `Status`) VALUES ('$userID','$id','$fromdate','$todate','$message','$status')";
    mysqli_query($conn, $insert);

    echo "<script>alert('Booking Submitted')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Booking System</title>
    <!-- Include Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/renting.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,300&display=swap" rel="stylesheet">
</head>

<body>
    <!-- NABAR -->
    <nav class="navbar navbarMain navbar-expand-lg navbar-light p-4">
        <div class="container">
            <a class="navbar-brand text-light" href="main.php">QuickRentz</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar1 navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link ml-5 nav1 text-light" href="main.php"
                            style="color: grey; text-decoration: none; text-underline-offset: 1rem; text-decoration-color: rgba(181, 181, 181);"
                            onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='rgba(181, 181, 181)';"
                            onmouseout="this.style.textDecoration='none';">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-5 nav1 text-light" href="#"
                            style="color: grey; text-decoration: none; text-underline-offset: 1rem; text-decoration-color: rgba(181, 181, 181);"
                            onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='rgba(181, 181, 181)';"
                            onmouseout="this.style.textDecoration='none';">Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-5 nav1 text-light" href="#"
                            style="color: grey; text-decoration: none; text-underline-offset: 1rem; text-decoration-color: rgba(181, 181, 181);"
                            onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='rgba(181, 181, 181)';"
                            onmouseout="this.style.textDecoration='none';">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-5 nav1 text-light" href="#"
                            style="color: grey; text-decoration: none; text-underline-offset: 1rem; text-decoration-color: rgba(181, 181, 181);"
                            onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='rgba(181, 181, 181)';"
                            onmouseout="this.style.textDecoration='none';">Pages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-5 nav1 text-light" href="#"
                            style="color: grey; text-decoration: none; text-underline-offset: 1rem; text-decoration-color: rgba(181, 181, 181);"
                            onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='rgba(181, 181, 181)';"
                            onmouseout="this.style.textDecoration='none';">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item text-white mx-auto dropdown">
                        <button class="dropdown-toggle user" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-regular fa-user"></i>
                            <?php echo $username; ?>
                        </button>
                        <ul class="mt-2 dropdown-menu bg-dark">
                            <li class="px-2 mb-3"><a href="manage-account.php" class="text-white text-decoration-none">Manage Account</a>
                            </li>
                            <li class="px-2 mb-3"><a href="mybookings.php" class="text-white text-decoration-none">My Booking</a></li>
                            <li class="px-2">
                                <form method="POST" action="">
                                    <a class="text-white text-decoration-none" href="log-out.php"
                                        type="button">Log-out</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link text-light" href="sign-up.php"><i class="fa-solid fa-bag-shopping"></i> Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#"><i class="fa-solid fa-cart-shopping"></i></a> -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END OF NABAR -->

    <div class="container mt-5">
        <h1 class="text-center text-light">Rent Today, Explore Tomorrow.</h1>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card card1">
                    <div id="<?php echo $result['Model'] ?>" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#<?php echo $result['Model'] ?>" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#<?php echo $result['Model'] ?>" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#<?php echo $result['Model'] ?>" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#<?php echo $result['Model'] ?>" data-bs-slide-to="3"
                                aria-label="Slide 4"></button>
                        </div>
                        <div class="carousel-inner w-100 h-100">
                            <div class="carousel-item active">
                                <img src="admin/img/vehicleuploads/<?php echo $result['Image1'] ?>"
                                    class="d-block w-100 h-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="admin/img/vehicleuploads/<?php echo $result['Image2'] ?>"
                                    class="d-block w-100 h-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="admin/img/vehicleuploads/<?php echo $result['Image3'] ?>"
                                    class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#<?php echo $result['Model'] ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#<?php echo $result['Model'] ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body cardContainer">
                        <div class="cardheader">
                            <h5 class="card-title">
                                <?php echo "$result[brandName] $result[Model]" ?>
                            </h5>
                            <h5 class="price">Price: ₱
                                <?php echo $result['Rate']; ?>
                            </h5>
                        </div>
                        <p class="card-text">
                        <div class="card-details">
                            <div class="card-detail-item">
                                <strong class="mt-2 mb-3">
                                    <img src="admin/img/booknow/car.png" alt="Year"
                                        style="vertical-align: middle; margin-right: 5px;margin-bottom: 6px; width: 10%;">Year
                                    Model:
                                </strong>
                                <?php echo $result['Year']; ?>
                            </div>
                            <div class="card-detail-item">
                                <strong class="mt-2 mb-3">
                                    <img src="admin/img/booknow/fuel_type-removebg-preview (1).png" alt="Fuel Type Icon"
                                        style="vertical-align: middle; margin-right: 5px;margin-bottom: 6px; width: 10%;">Fuel
                                    Type:
                                </strong>
                                <?php echo $result['FuelType']; ?>
                            </div>
                            <div class="card-detail-item">
                                <strong class="mt-2 mb-3">
                                    <img src="admin/img/booknow/seat.png" alt="Seat"
                                        style="vertical-align: middle; margin-right: 5px;margin-bottom: 6px; width: 10%;">Seats:
                                </strong>
                                <?php echo $result['SeatingCapacity']; ?>
                            </div>
                            <div class="card-detail-item">
                                <strong class="mt-2 mb-3">
                                    <img src="admin/img/booknow/trans.png" alt="Trans"
                                        style="vertical-align: middle; margin-right: 5px;margin-bottom: 6px; width: 10%;">Transmission:
                                </strong>
                                <?php echo $result['Transmision']; ?>
                            </div>
                        </div>


                        <strong class="mt-2 mb-3" style="margin-bottom: 5px;">Vehicle Overview :</strong> Lorem ipsum
                        dolor sit amet, consectetur adipiscing elit.
                        </p>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card2">
                    <div class="card-body cardContainer2">
                        <h5 class="card-title">Booking Details</h5>
                        <form method="POST">
                            <div class="form-group">
                                <label for="fromDate">From Date:</label>
                                <input type="date" class="form-control" name="fromDate" required>
                            </div>
                            <div class="form-group">
                                <label for="toDate">To Date:</label>
                                <input type="date" class="form-control" name="toDate" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control" name="message" rows="4"></textarea>
                            </div>
                            <div class="text-end p-4">
                                <button type="submit" class="btn btnBook">Book Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>