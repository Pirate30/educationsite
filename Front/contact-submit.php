<?php
include("config/connection.php");

if (isset($_POST['submit'])) {
    // echo "hello";
    // die();
    $contact_name = strip_tags($_POST['contact_name']);
    $contact_number = strip_tags($_POST['contact_number']);
    $contact_detail = strip_tags($_POST['contact_detail']);
    $contacting_date = date("h-i-sa");

    // cheking if the same fon number is exist or not
    $sql2 = "select * from `contact`";
    $res2 = mysqli_query($con, $sql2);
    $count = mysqli_num_rows($res2);
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res2)) {
            if ($row['contact_number'] == $contact_number) {
                $_SESSION['contact-exist'] = "<div style='color:red;font-size:3rem;'>You have already responded before!(try with diffrent contact number or wait for few hours)</div>";
                header("location:" . SITEURL . "Front/index.php");
                die();
            }
        }
    }

    //    adding data to the db
    $sql = "insert into `contact` set contact_name='$contact_name' , contact_number ='$contact_number' , contact_address = '$contact_address' ,  contact_detail = '$contact_detail'";
    $res = mysqli_query($con, $sql);

    // checking if the data got submitted
    if ($res == true) {
        // data submitted

        $_SESSION['contact-sent'] = "<div style='color:green;font-size:3rem;'>Thank you for responding , Our team will be in your contact soon!!</div>";
        header("location:" . SITEURL . "Front/index.php");
    } else {
        // failed to submit
        $_SESSION['contact-sent'] = "<div style='color:red;font-size:3rem;'>Failed to respond! Try Later</div>";
        header("location:" . SITEURL . "Front/index.php");
    }
}
