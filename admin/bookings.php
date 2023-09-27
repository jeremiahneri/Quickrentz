<?php
include "includes/database.php";
session_start();

if (isset($_SESSION['AdminUsername']) && isset($_SESSION['profilePhoto'])) {

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
    <title>Admin | Manage Booking</title>
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
                <li class="p-3 active"><a href="bookings.php" class="text-decoration-none fs-4"><i
                            class="fa-regular fa-pen-to-square"></i> Manage Booking</a></li>
                <li class="p-3"><a href="manageUsers.php" class="text-decoration-none fs-4"><i
                            class="fa-solid fa-users-gear"></i> Manage Users</a></li>
                <li class="p-3"><a href="users.php" class="text-decoration-none fs-4"><i class="fa-solid fa-users"></i>
                        Users Credential</a></li>
                <li class="p-3"><a href="vehicles.php" class="text-decoration-none fs-4"><i class="fa-solid fa-car"></i>
                        Manage Vehicle</a></li>
                <li class="p-3"> <a class="text-decoration-none fs-4" data-bs-toggle="collapse" href="#collapseAdd"
                        role="button" aria-expanded="false" aria-controls="collapseAdd"><i class="fa-solid fa-plus"></i>
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
                <h1 class="col-md-12 px-3">Manage Booking</h1>
                <hr>
            </div>
            <div class="container">
                <div class="container-fluid"
                    style="border: 2px solid #000; border-radius: 10px;background-color: rgba(8, 103, 136, 0.7);">
                    <table id="pagination" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Vehicle</th>
                                <th scope="col">Pick-up</th>
                                <th scope="col">Return</th>
                                <th scope="col">Message</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $sqlReservation = "SELECT * FROM `reservation`";
                            $sqlReservation = "SELECT user.FirstName, user.LastName, brand.brandName, vehicle.Model, reservation.* FROM reservation INNER JOIN user ON reservation.UserID = user.UserID INNER JOIN vehicle ON reservation.VehicleID = vehicle.VehicleID
                        INNER JOIN brand ON vehicle.BrandID = brand.BrandID";
                            $initiateReservation = mysqli_query($conn, $sqlReservation);
                            while ($results = mysqli_fetch_assoc($initiateReservation)) {
                                if ($results['Status'] == 'Booking Confirmed') {
                                    $status = "<td class='text-success'>$results[Status]</td>";
                                } elseif ($results['Status'] == 'Booking Cancelled') {
                                    $status = "<td class='text-danger'>$results[Status]</td>";
                                } else {
                                    $status = "<td class='text-warning'>$results[Status]</td>";
                                }
                                echo "
                                <tr>
                                    <th scope='row'>$results[ReservationID]</th>
                                    <td>$results[FirstName] $results[LastName]</td>
                                    <td>$results[brandName] $results[Model]</td>
                                    <td>$results[Pickup]</td>
                                    <td>$results[Return]</td>
                                    <td>$results[Message]</td>
                                    $status
                                    <td class='d-flex'>
                                        <form method='GET' action='confirm.php' class='px-2'>
                                            <input type='hidden' name='ReservationID' value='$results[ReservationID]'>
                                            <button type='submit' class='btn-delete text-success' style='border:none;background:none;'>Confirm</button>
                                        </form>
                                        <form method='GET' action='cancel.php' class='px-2'>
                                            <input type='hidden' name='ReservationID' value='$results[ReservationID]'>
                                            <button type='submit' class='btn-delete text-danger' style='border:none;background:none;'>Cancel</button>
                                        </form>
                                        <form method='GET' action='deletebooking.php' class='px-2'>
                                            <input type='hidden' name='ReservationID' value='$results[ReservationID]'>
                                            <button type='submit' class='btn-delete text-danger' style='border:none;background:none;'>Delete</button>
                                        </form>
                                       
                                    </td>
                                </tr>";
                            }

                            ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Vehicle</th>
                                <th scope="col">Pick-up</th>
                                <th scope="col">Return</th>
                                <th scope="col">Message</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </tfoot>
                    </table>
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