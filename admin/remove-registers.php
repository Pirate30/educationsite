<?php
include('config/connection.php'); //including connection file

// getting id of the course which the user wants to delete
if (isset($_GET['id'])) {

    // proceed to delete
    $id = $_GET['id'];

    // executing te sql to delete the course
    $sql = "delete from student_register where id='$id'";
    $res = mysqli_query($con, $sql);

    if ($res == true) {
        $_SESSION['remove'] = "<div class='success'>Data is removed successfully</div>"; // creating remove session with appropreate msg
        // redirecting  back to manage new register page
        header("location:" . SITEURL . 'admin/new-registrations.php');
    } else {
        $_SESSION['remove'] = "<div class='error'>try again , something went wrong </div>"; //creating remove session with appropreate msg
        // redirecting  back to manage register page
        header("location:" . SITEURL . 'admin/new-registrations.php');
    }
} else {
    // redirecting to manage register page
    header("location:" . SITEURL . 'admin/new-registrations.php');
}
