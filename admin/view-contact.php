<?php
include('partials/header.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // fetching data
    $sql = "select * from `contact` where id='$id'";
    $res = mysqli_query($con, $sql);
    // checking if query fired successfully or not
    if ($res == true) {
        $count = mysqli_num_rows($res);
        // /checking if the ccoreect data is available
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $name = $row['contact_name'];
            $number = $row['contact_number'];
            $address = $row['contact_address'];
            $reason = $row['contact_detail'];
            $date = $row['contact_date'];
        } else {
            header("location:" . SITEURL . "admin/manage-contacts.php");
        }
    }
} else {
    header("location:" . SITEURL . "admin/manage-contacts.php");
}

?>

<div class="dashboard">
    <div class="wrapper">
        <h1><strong>Contact Detail</strong></h1>
        <br>
        <table class="tbl-50">

            <tr>
                <td>Contact Name:</td>
                <td style=" border-bottom: 1px solid; "><?php echo $name; ?></td>
            </tr>

            <tr>
                <td>Contact Phone:</td>
                <td style="
    border-bottom: 1px solid;
"><?php echo $number; ?></td>
            </tr>

            <tr>
                <td>Contact Address:</td>
                <td style="
    border-bottom: 1px solid;
"><?php echo $address; ?></td>
            </tr>

            <tr>
                <td>Date:</td>
                <td style="
    border-bottom: 1px solid;
"><?php echo $date; ?></td>
            </tr>

            <tr>
                <td>reason To Contact:</td>
                <td style="
    border-bottom: 1px solid;
">
                    <?php echo $reason; ?>
                </td>
            </tr>
            <tr>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <td colspan="1"><input type="submit" name="back" value="&#8592; Back" class="btn-primary" style="background: blue;"></td>
                    <td colspan="2"><input type="submit" name="delete" value="Delete Contact" class="btn-primary"></td>

                </form>

            </tr>



        </table>
    </div>
</div>

<?php

if (isset($_POST['back'])) {
    header("location:" . SITEURL . "admin/manage-contacts.php");
}
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
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

include('partials/footer.php');
?>