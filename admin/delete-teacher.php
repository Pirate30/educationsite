<?php
include('config/connection.php'); //including connection file

// getting id of the course which the user wants to delete
if (isset($_GET['id']) and isset($_GET['image_name'])) {

    // proceed to delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    // remove image from the food folder
    if ($image_name != "") {
        // deleting image
        $path = "images/teacher/" . $image_name; //getting  path for the image to be deleted
        $remove = unlink($path); //removing image from that path

        // checking if image is removed
        if ($remove == false) {
            // session message
            $_SESSION['remove'] = "<div class='error'>failed to remove teacher image</div>";
            // redirecting to course page
            header("location:" . SITEURL . 'admin/manage-teachers.php');
            // stop the process
            die();
        }
    }
    // executing te sql to delete the course
    $sql = "delete from teacher where id='$id'";
    $res = mysqli_query($con, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>teacher is deleted successfully</div>"; // creating delete session with appropreate msg
        // redirecting  back to manage course page
        header("location:" . SITEURL . 'admin/manage-teachers.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>try again , something went wrong </div>"; //creating delete session with appropreate msg
        // redirecting  back to manage course page
        header("location:" . SITEURL . 'admin/manage-teachers.php');
    }
} else {
    // redirecting to manage food page
    header("location:" . SITEURL . 'admin/manage-teachers.php');
}
