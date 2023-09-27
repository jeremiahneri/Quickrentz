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
$selectUser = "SELECT * FROM `user` WHERE `UserID` = $userID";
$initiateUser = mysqli_query($conn, $selectUser);
$user = mysqli_fetch_assoc($initiateUser);

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $updateUser = "UPDATE `user` SET `Username`='$username',`FirstName`='$fname',`LastName`='$lname',`PhoneNumber`='$phone',`Address`='$address',`Email`='$email' WHERE `UserID` = $userID";
    mysqli_query($conn, $updateUser);

    header('location: manage-account.php');
    // echo "Account Updated Successfully"; 
}

if (isset($_POST['changepassword'])) {

    $oldPassword = $_POST['oldpassword'];
    $newPassword = $_POST['newpassword'];
    $confirmNewPassword = $_POST['confrimnewpassword'];

    if ($oldPassword == $user['Password']) {
        if ($newPassword == $confirmNewPassword) {
            $updatePassword = "UPDATE `user` SET `Password`='$confirmNewPassword' WHERE `UserID` = $userID";
            mysqli_query($conn, $updatePassword);
            echo "<script>alert('Password Updated Successfully!')</script>";

        } else {
            echo "<script>alert('New password and confirm password mismatched!')</script>";
        }
    } else {
        echo "<script>alert('Incorrect Old Password!')</script>";
    }
}

if (isset($_POST['uploadProfile'])) {

    $profilephoto = generateUniqueFileName($_FILES["profilephoto"]["name"]);

    // echo $profilephoto;
    move_uploaded_file($_FILES["profilephoto"]["tmp_name"], "admin/img/profileuloads/" . $profilephoto);

    $update = "UPDATE `user` SET `Photo`='$profilephoto' WHERE `UserID` = $userID";
    $initiateUpdate = mysqli_query($conn, $update);

    header('location: manage-account.php');
}


if(isset($_POST['verifyNow'])){

    $frontID = generateUniqueFileName($_FILES["frontpic"]["name"]);
    $backID = generateUniqueFileName($_FILES["backpic"]["name"]);
    $status = "Pending for Verification";

    move_uploaded_file($_FILES["frontpic"]["tmp_name"], "admin/img/liscense/" . $frontID);
    move_uploaded_file($_FILES["backpic"]["tmp_name"], "admin/img/liscense/" . $backID);

    $uploadLicense = "UPDATE `user` SET `Status`='$status',`FrontID`='$frontID',`BackID`='$backID' WHERE `UserID` = $userID";
    mysqli_query($conn, $uploadLicense);
}

if($user['Status'] == 'Not Yet Verified'){
    $verify = "<a href='#account-info'>Verify now</a>";
}else{
    $verify = "";
}

function generateUniqueFileName($originalFileName)
{
    $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $timestamp = time();
    $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);
    return $timestamp . "_" . $randomString . "." . $extension;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Manage</title>
    <link rel="stylesheet" href="css/manage-account.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4 ml-4" style="font-size: 3rem; color: #7b59a3;">
            Account settings
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-change-password">Change password</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-info">Verification</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="admin/img/profileuloads/<?php echo $user['Photo'] ?>" alt
                                    class="d-block ui-w-80">
                                <div class="media-body ml-4">
                                    <div class="row">
                                        <form class="col-md-7" method="POST" enctype="multipart/form-data">
                                            <label class="btn custom-outline">
                                                Upload new photo
                                                <input type="file" class="account-settings-fileinput"
                                                    name="profilephoto">
                                            </label> &nbsp;
                                            <button type="submit" class="btn btn-default md-btn-flat"
                                                name="uploadProfile">Reset</button>
                                        </form>
                                        <div class="col-md-5" style="border: 1px solid #7b59a3;border-radius:8px;">
                                            <label class="p-2">
                                                Status:
                                                <?php echo $user['Status'] ?> <span><?php echo $verify ?></span>
                                            </label> &nbsp;
                                        </div>
                                    </div>
                                    <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <form class="row" method="POST">
                                    <div class="form-group form-group col-md-12">
                                        <label class="form-label" for="username"><b>Username</b></label>
                                        <input type="text" class="form-control mb-1  custom-outline"
                                            value="<?php echo $user['Username'] ?>" name="username">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label"><b>First Name</b></label>
                                        <input type="text" class="form-control  custom-outline"
                                            value="<?php echo $user['FirstName'] ?>" name="fname">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label"><b>Last Name</b></label>
                                        <input type="text" class="form-control  custom-outline"
                                            value="<?php echo $user['LastName'] ?>" name="lname">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label"><b>E-mail</b></label>
                                        <input type="text" class="form-control mb-1  custom-outline"
                                            value="<?php echo $user['Email'] ?>" name="email">
                                        <!-- <div class="alert alert-warning mt-3">
                                            Your email is not confirmed. Please check your inbox.<br>
                                            <a href="javascript:void(0)">Resend confirmation</a>
                                        </div> -->
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label"><b>Phone Number</b></label>
                                        <input type="text" class="form-control mb-1  custom-outline"
                                            value="<?php echo $user['PhoneNumber'] ?>" name="phone">
                                        <!-- <div class="alert alert-warning mt-3">
                                            Your email is not confirmed. Please check your inbox.<br>
                                            <a href="javascript:void(0)">Resend confirmation</a>
                                        </div> -->
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label"><b>Full Address</b></label>
                                        <input type="text" class="form-control  custom-outline"
                                            value="<?php echo $user['Address'] ?>" name="address">
                                    </div>
                                    <div class="col-md-12 text-end mt-3 text-right">
                                        <button type="submit" class="btn"
                                            style="background-color: #7b59a3; color: white;" name="update">Save
                                            changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <form class="card-body pb-2" method="POST">
                                <div class="form-group">
                                    <label class="form-label"><b>Current Password</b></label>
                                    <input type="password" class="form-control custom-outline" name="oldpassword">
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><b>New Password</b></label>
                                    <input type="password" class="form-control  custom-outline" name="newpassword">
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><b>Repeat New Password</b></label>
                                    <input type="password" class="form-control  custom-outline"
                                        name="confrimnewpassword">
                                </div>
                                <div class="text-end mt-3 text-right">
                                    <button type="submit" class="btn" style="background-color: #7b59a3; color: white;"
                                        name="changepassword">Save
                                        changes</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="account-info">
                            <form class="card-body pb-2" method="POST" enctype="multipart/form-data">
                                <div class="form-group row container-fluid">
                                    <h2 class="col-md-8">Verification</h2>
                                    <div class="col-md-4" style="border: 1px solid #7b59a3;border-radius:8px;">
                                            <label class="p-2">
                                                Status:
                                                <?php echo $user['Status'] ?>   
                                            </label> &nbsp;
                                        </div>
                                </div>
                                <div class="p-5 form-group row container-fluid">
                                    <label class="btn custom-outline col-md-5">
                                        Click to Upload the Front of your License
                                        <input type="file" name="frontpic" required>
                                        <img src="admin/img/liscense/<?php echo $frontID; ?>" alt="Front License" width="120">
                                    </label>
                                    <div class="col-md-2"></div>
                                    <label class="btn custom-outline col-md-5">
                                        Click to Upload the Back of your License
                                        <input type="file" name="backpic" required>
                                        <img src="admin/img/liscense/<?php echo $backID; ?>" alt="Back License" width="120">
                                    </label>
                                </div>
                                <h4>Take Note!</h4>
                                <ul>
                                    <li>Ensure that the image of your driver's license is clear and legible. Use a
                                        scanner or a high-quality camera to capture the image.</li>
                                    <li>Make sure the image is oriented correctly, and all details on the license are
                                        visible. Avoid cropping or cutting off any part of the license.</li>
                                    <li>Only provide the information that is explicitly required. If there is an option
                                        to redact or cover sensitive information that is not necessary for the website's
                                        purpose, consider doing so.</li>
                                    <li> If you encounter any issues, have questions, or are concerned about the
                                        security of your uploaded document, don't hesitate to contact the website's
                                        customer support or help center for assistance.</li>
                                </ul>
                                <div class="text-end mt-3 text-right">
                                    <label class="form-check-label">
                                        <input type="checkbox" required>
                                        <span style="color: black;">I accept the <a href="#"
                                                style="color:#806393;">Terms of Use</a> & <a href="#"
                                                style="color:#806393;">Privacy Policy</a></span>
                                    </label>
                                    <button type="submit" class="btn" style="background-color: #7b59a3; color: white;"
                                        name="verifyNow">Verify Now</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="account-social-links">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" class="form-control" value="https://twitter.com/user">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" class="form-control" value="https://www.facebook.com/user">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Google+</label>
                                    <input type="text" class="form-control" value>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">LinkedIn</label>
                                    <input type="text" class="form-control" value>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" class="form-control" value="https://www.instagram.com/user">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-connections">
                            <div class="card-body">
                                <button type="button" class="btn btn-twitter">Connect to
                                    <strong>Twitter</strong></button>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <h5 class="mb-2">
                                    <a href="javascript:void(0)" class="float-right text-muted text-tiny"><i
                                            class="ion ion-md-close"></i> Remove</a>
                                    <i class="ion ion-logo-google text-google"></i>
                                    You are connected to Google:
                                </h5>
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                    data-cfemail="f9979498818e9c9595b994989095d79a9694">[email&#160;protected]</a>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <button type="button" class="btn btn-facebook">Connect to
                                    <strong>Facebook</strong></button>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <button type="button" class="btn btn-instagram">Connect to
                                    <strong>Instagram</strong></button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-notifications">
                            <div class="card-body pb-2">
                                <h6 class="mb-4">Activity</h6>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Email me when someone comments on my article</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Email me when someone answers on my forum
                                            thread</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input">
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Email me when someone follows me</span>
                                    </label>
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body pb-2">
                                <h6 class="mb-4">Application</h6>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">News and announcements</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input">
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Weekly product updates</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Weekly blog digest</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form class="text-right mt-2 mr-3">
            <a href="main.php" style="color:#7b59a3;">Back to Mainpage</a>
        </form>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>