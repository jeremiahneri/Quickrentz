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
// echo $userID;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Include Owl Carousel CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Fonts -->
    <!-- 1 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">
    <!-- 2 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">

    <!-- Css -->
    <link rel="stylesheet" href="css/style.css">


    <style>
        @media screen and (max-width: 500px) {
            .card-subTitle {
                display: none;
            }
        }

        @media screen and (max-width: 500px) {
            .owl-dots {
                display: none;
            }
        }
    </style>

    <title>Quickrentz</title>
</head>

<body>

    <!--START OF NAVBAR -->
    <nav class="navbar navbarMain navbar-expand-lg navbar-light p-4">
        <div class="container">
            <a class="navbar-brand text-light" href="main.php">QuickRentz</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar1 navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link ml-5 nav1 text-light" href="main.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-5 nav1 text-light" href="#cars"
                            style="color: grey; text-decoration: none; text-underline-offset: 1rem; text-decoration-color: rgba(181, 181, 181);"
                            onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='rgba(181, 181, 181)';"
                            onmouseout="this.style.textDecoration='none';">Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-5 nav1 text-light" href="#blog"
                            style="color: grey; text-decoration: none; text-underline-offset: 1rem; text-decoration-color: rgba(181, 181, 181);"
                            onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='rgba(181, 181, 181)';"
                            onmouseout="this.style.textDecoration='none';">Blog</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link ml-5 nav1 text-light" href="#" style="color: grey; text-decoration: none; text-underline-offset: 1rem; text-decoration-color: rgba(181, 181, 181);" onmouseover="this.style.textDecoration='underline'; this.style.textDecorationColor='rgba(181, 181, 181)';" onmouseout="this.style.textDecoration='none';">Pages</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link ml-5 nav1 text-light" href="contactUs.php"
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
                            <li class="px-2 mb-3"><a href="manage-account.php"
                                    class="text-white text-decoration-none">Manage Account</a>
                            </li>
                            <li class="px-2 mb-3">
                                <a href="mybookings.php" class="text-white text-decoration-none">My Booking</a>
                            </li>
                            <li class="px-2">
                                <form method="POST" action="">
                                    <a class="text-white text-decoration-none" href="log-out.php"
                                        type="button">Log-out</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--END OF NAVBAR -->

    <!--START SECTION 1 (CAROUSEL) -->

    <div class="container" style="min-height: 80vh;">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="head1 text-light" style="font-size: 3.5rem;font-family: 'Kalam', cursive;">THE EASY WAY TO
                    TAKEOVER A LEASE</h2>
                <h6 class="head1 text-light">Find the perfect car for you today!</h6>
                <br>
                <div class="head-title2"
                    style="color: white; margin-top: 50px; display: grid; grid-template-columns: repeat(2, 1fr); grid-gap: 10px;">
                    <div>
                        <h6 style="margin-right:50px"><img src="img/check.png" alt="" width="30" height="30"> Flexible
                            Rentals</h6>
                    </div>
                    <div>
                        <h6 style="margin-right:48px"><img src="img/check.png" alt="" width="30" height="30"> No Hidden
                            Fees</h6>
                    </div>
                    <div>
                        <h6><img src="img/check.png" alt="" width="30" height="30"> Best Price Guarantee</h6>
                    </div>
                    <div>
                        <h6><img src="img/check.png" alt="" width="30" height="30"> 24/7 Road Assistance</h6>
                    </div>
                </div>


            </div>
            <div class="col-md-6">
                <img src="img/city.jpg" alt="" width="100%" style="border: 0.5px solid black; border-radius: 20px;">
            </div>
        </div>
    </div>


    <!--END SECTION 1 (CAROUSEL) -->

    <!-- START SECTION 2 -->
    <!-- <section>
        <div class="container container2 mt-5 text-light">
            <h1 class="text-center">Welcome to Quickrentz</h1>
            <div class="row">
                <div class="col-md-6 mt-5 about">
                    <p>
                        Quickrentz is your trusted partner for all your car rental needs.
                        With a wide range of cars to choose from and competitive prices, we make
                        it easy for you to find the perfect vehicle for your journey.
                    </p>
                    <p>
                        Our mission is to provide you with a seamless and hassle-free car rental
                        experience. Whether you're traveling for business or pleasure, our
                        dedicated team is here to ensure your satisfaction.
                    </p>
                    <div class="button-container btnAbout">
                        <button class="button">Book Now</button>
                        <button class="button">View More</button>
                    </div>
                </div>
                <div class="col-md-6 aboutPic">
                    <img src="img/image-removebg-preview.png" alt="" class="aboutPicImg">
                </div>
            </div>
        </div>
    </section> -->

    <!-- END SECTION 2 -->

    <!-- START SECTION 3 -->
    <div class="container-fluid" id="cars">
        <div class="title_main">
            <h2 style="font-family: 'Poppins', sans-serif;;font-size:3rem;margin-top:50px">CHOOSE YOUR CAR</h2>
        </div>
        <div class="row">
            <?php
            $selectVehicle = "SELECT vehicle.*, brand.brandName FROM vehicle
                LEFT JOIN brand ON vehicle.BrandID = brand.BrandID";
            $initiateSelectVehicle = mysqli_query($conn, $selectVehicle);
            while ($results = mysqli_fetch_assoc($initiateSelectVehicle)) {
                echo "<div class='col-md-3 mb-4'>
                        <div class='card text-light'>
                            <div id='$results[Model]' class='carousel slide'>
                            <div class='carousel-indicators'>
                                <button type='button' data-bs-target='#$results[Model]' data-bs-slide-to='0' class='active'
                                    aria-current='true' aria-label='Slide 1'></button>
                                <button type='button' data-bs-target='#$results[Model]' data-bs-slide-to='1'
                                    aria-label='Slide 2'></button>
                                <button type='button' data-bs-target='#$results[Model]' data-bs-slide-to='2'
                                    aria-label='Slide 3'></button>
                            </div>
                            <div class='carousel-inner'>
                                <div class='carousel-item active'>
                                    <img src='admin/img/vehicleuploads/$results[Image1]' class='d-block w-100' alt='...'>
                                </div>
                                <div class='carousel-item'>
                                    <img src='admin/img/vehicleuploads/$results[Image2]' class='d-block w-100' alt='...'>
                                </div>
                                <div class='carousel-item'>
                                    <img src='admin/img/vehicleuploads/$results[Image3]' class='d-block w-100' alt='...'>
                                </div>
                                <div class='carousel-item'>
                                    <img src='admin/img/vehicleuploads/$results[Image4]' class='d-block w-100' alt='...'>
                                </div>
                            </div>
                
                        </div>
                        <div class='card-body'>
                        <div class='card-header' style='display: flex; flex-direction: row; justify-content: space-between; align-items: center;'>
                                <h5 class='card-title' style='text-align: left; font-size: 25px;'>$results[Model]</h5>
                                <h6 class='card-subTitle' style='text-align: right; border: 1px dashed white; padding: 7px; border-radius: 10px; border-color: #d1b3c4; max-width: 100px;'>$results[Year]</h6>
                        </div>
                            <div class='grid-container' style='display: flex; flex-direction: row;'>
                            <div style='text-align: left; flex: 1;'>
                                <p class='card-text'><i class='fa-regular fa-user' style='color: #d1b3c4;'></i> $results[SeatingCapacity] people</p>
                                <p class='card-text'><i class='fa-solid fa-gauge' style='color: #d1b3c4;'></i> 6.1 km/ 1-liter</p>
                            </div>
                            <div style='text-align: right; flex: 1;'>
                                <p class='card-text'><i class='fa-solid fa-gas-pump' style='color: #d1b3c4;'></i> $results[FuelType]</p>
                                <p class='card-text'><i class='fa-solid fa-car' style='color: #d1b3c4;'></i> $results[Transmision]</p>
                            </div>
                        </div>
                        <hr style='width: 100%;'>  
                            <div class='grid-item2'>
                                <h5 class='card-title amountText'>₱$results[Rate] / day</h5>
                                <form method='GET' action='booknow.php'>
                                            <input type='hidden' name='VehicleID' value='$results[VehicleID]'>
                                            <button class='btn' style='color: white; background-color: #806393;'>Rent Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>

    <!-- END SECTION 3 -->

    <!-- START SECTION 5 (OWL CAROUSEL) -->
    <?php include "includes/blogs.php"; ?>
    
    <!-- END SECTION 5 (OWL CAROUSEL) -->

    <?php include "includes/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 20,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true,
                    },
                    600: {
                        items: 3,
                        nav: false,
                    },
                    1000: {
                        items: 5,
                        nav: true,
                        loop: false,
                    },
                },
            });
        });
    </script>
</body>

</html>