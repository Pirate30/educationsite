<?php
include('config/connection.php'); //including connection file

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // proceeding to delete
    $sql = "delete from `contact` where id='$id'";
    $res = mysqli_query($con, $sql);
    if ($res == true) {
        // deleted successfully
        $_SESSION['contact-delete'] = "<div class='success'>Contact is deleted succesfully</div>";
        header("location:" . SITEURL . "admin/manage-contacts.php");
    } else {
        // not deleted
        $_SESSION['contact-delete'] = "<div class='error'>Failed to delete</div>";
        header("location:" . SITEURL . "admin/manage-contacts.php");
    }
}
