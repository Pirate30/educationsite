<?php
// for authorization
// whether the user is logged out or logged in??
if (!isset($_SESSION['user'])) {

    // redirection to login page with an erro message
    $_SESSION['logged-out-msg'] = " <div class='error'> login to access the admin panel </div>";
    header("location:" . SITEURL . "admin/login.php");
}
