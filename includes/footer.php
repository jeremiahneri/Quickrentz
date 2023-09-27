<?php
include "./admin/includes/database.php";

if(isset($_POST['subscribe'])){
   
    $email = $_POST['email'];

    $insertSubs = "INSERT INTO `subscription`(`email`) VALUES ('$email')";
    mysqli_query($conn, $insertSubs);

}
?>
<div>
    <footer class="text-white" style="background-color: #06010C;">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-md-3" id="div1">
                    <h1></i> QUICKRENTZ</h1>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim, laudantium.</p> -->
                    <!-- <button style="background-color: #806393; color: white; border-radius: 10px;">Submit Ad</button> -->
                </div>
                <div class="col-md-3" id="div2">
                    <h3 style="margin-bottom: 20px;">More to Explore </h3>
                    <ul style="list-style: none;">
                        <li class="m-2"><a class="text-decoration-none text-white" href="contactUs.php">Contact Us</a>
                        </li>
                        <li class="m-2"><a class="text-decoration-none text-white" href="manage-account.php">My
                                Account</a></li>
                        <li class="m-2"><a class="text-decoration-none text-white" href="#">How it works</a></li>
                        <li class="m-2"><a class="text-decoration-none text-white" href="mybookings.php">My Booking</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3" id="div3" style="display: flex; flex-direction: column; align-items: center;">
                    <h3 style="margin-bottom: 20px;">Contacts</h3>
                    <span class="contact-item" style="display: flex; align-items: center;">
                        <i class="fa-solid fa-location-dot" style="color: #806393; margin-right: 25px;"></i>
                        <span>12 Main Street Metro Manila</span>
                    </span>
                    <span class="contact-item" style="display: flex; align-items: center;">
                        <i class="fa-solid fa-clock" style="color: #806393; margin-right: 22px;"></i>
                        <span>Mon-Sat 8:00am to 11:00pm</span>
                    </span>
                    <span class="contact-item" style="display: flex; align-items: center;">
                        <i class="fa-solid fa-envelope" style="color: #806393; margin-right: 15px;"></i>
                        <span>quickrentz.main@gmail.com</span>
                    </span>
                    <span class="contact-item" style="display: flex; align-items: center;">
                        <i class="fa-solid fa-phone" style="color: #806393; margin-right: 10px;"></i>
                        <span>+63 9693568001 / 939-54-72</span>
                    </span>
                </div>

                <form class="col-md-3" method="POST" id="div4">
                    <h3 style="margin-bottom: 20px;">Newsletter</h3>
                    <!-- <p>Subscribe for the new articles</p> -->
                    <input type="text" placeholder="Email Address"
                        style="border-radius: 10px; text-align: center;width:90%" name="email">
                    <button type="submit" name="subscribe" style="border-radius: 10px; text-align: center; margin-top: 10px;width:90%; color:white; background-color:#806393 ;">Subscribe Now </button>
                </form>

                <div class="col-md-12" id="div5">
                    <hr>
                    <div class="social-icon" style="background-color: #06010C;">
                        <i class="fa-brands fa-facebook"></i>
                    </div>
                    <div class="social-icon" style="background-color: #06010C;">
                        <i class="fa-brands fa-twitter"></i>
                    </div>
                    <div class="social-icon" style="background-color: #06010C;">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                    <p style="margin-top: 20px;">&copy; 2023 QuickRentz. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</div>