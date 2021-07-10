<?php
include('partials/header.php');
?>


<div class="dashboard">
    <div class="wrapper">
        <h1><strong>Add Teacher</strong></h1>
        <br>
        <h3>
            <?php
            // checking if the course is added or not and showig approprate message.
            if (isset($_SESSION['add-teacher'])) {
                echo $_SESSION['add-teacher'];
                unset($_SESSION['add-teacher']);
            }
            ?>
        </h3>

        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-50">
                <tr>
                    <td>Teacher Name:</td>
                    <td><input type="text" name="teacher_name" placeholder="enter the teacher name" required></td>
                </tr>
                <tr>
                    <td>Descreption:</td>
                    <td><input type="text" name="teacher_desc" placeholder="enter the description" required></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Teacher Gender:</td>
                    <td><select name="teacher_gender" id="">
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                            <option value="o">Others</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Teacher" class="btn-primary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php

// getting data from the form and adding it to the database
if (isset($_POST['submit'])) {
    // fetching subitted values
    $teacher_name = strip_tags(mysqli_real_escape_string($con, $_POST['teacher_name']));
    $teacher_desc = strip_tags(mysqli_real_escape_string($con, $_POST['teacher_desc']));
    $teacher_gender = strip_tags(mysqli_real_escape_string($con, $_POST['teacher_gender']));


    // handeling image
    // checking if image is selected and naming that image
    // print_r($_FILES['image']);
    // die();
    if (isset($_FILES['image']['name'])) {
        // imaage is selected so proceed to upload
        $image_name = $_FILES['image']['name']; // getting image name
        if ($image_name != "") {
            //auto remaning the image name
            $ext = end(explode('.', $image_name));
            $image_name = "teacher-name" . rand(000, 999) . "." . $ext;

            $source_loc = $_FILES['image']['tmp_name'];
            $destination_loc = "images/teacher/" . $image_name;

            // now uploading that image
            $upload = move_uploaded_file($source_loc, $destination_loc);

            // checking if image is uploaded
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
                // redirecting
                header("location:" . SITEURL . 'admin/manage-teachers.php');
                die();
            }
        }
    } else {
        // image is not slected so leave the name blank
        $image_name = "";
    }

    // sql query to add data to db
    $sql = "insert into teacher set teacher_name='$teacher_name' , teacher_desc = '$teacher_desc' , image_name='$image_name' , teacher_gender='$teacher_gender' ";
    $res = mysqli_query($con, $sql); //executing
    if ($res == true) {
        $_SESSION['add-teacher'] = "<div class='success'>teacher is added, Successfully.</div>";
        header("location:" . SITEURL . "admin/manage-teachers.php");
    } else {
        $_SESSION['add-teacher'] = "<div class='succes'>teacher is not added, try again.</div>";
    }
}



include('partials/footer.php');
?>