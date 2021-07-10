<?php
include('partials/header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // getting current data from the table
    $sql = "select * from teacher where id='$id'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    $teacher_id = $row['id'];
    $name = $row['teacher_name'];
    $description = $row['teacher_desc'];
    $gender = $row['teacher_gender'];
    $current_image = $row['image_name'];
} else {
    header("location:" . SITEURL . "admin/manage-teachers.php");
}

?>
<div class="dashboard">
    <div class="wrapper">
        <h1><strong>Update Teacher</strong></h1>
        <br>


        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-50">
                <tr>
                    <td>Teacher Name:</td>
                    <td><input type="text" name="teacher_name" value="<?php echo $name ?>" required></td>
                </tr>
                <tr>
                    <td>Descreption:</td>
                    <td><textarea name="teacher_desc" id="" cols="30" rows="6"><?php echo $description ?></textarea></td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            echo " <div class='error'>image not available</div>"; //no available
                        } else {
                            // image available
                        ?>
                            <img src="<?php echo SITEURL; ?>admin/images/teacher/<?php echo $current_image; ?>" alt="<?php echo $name ?>" height="100px" width="100px">
                        <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Teacher Gender:</td>
                    <td><select name="teacher_gender" id="">

                            <option <?php if ($gender == "m") {
                                        echo "selected";
                                    } ?> value="m">Male</option>
                            <option <?php if ($gender == "f") {
                                        echo "selected";
                                    } ?> value="f">Female</option>
                            <option <?php if ($gender == "o") {
                                        echo "selected";
                                    } ?> value="o">Others</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <td colspan="2"><input type="submit" name="submit" value="Update Teacher" class="btn-primary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php
if (isset($_POST['submit'])) {
    // fetching new datas
    $id = $_POST['teacher_id'];
    $teacher_name = strip_tags(mysqli_real_escape_string($con, $_POST['teacher_name']));
    $teacher_desc = strip_tags(mysqli_real_escape_string($con, $_POST['teacher_desc']));
    $teacher_gender = strip_tags(mysqli_real_escape_string($con, $_POST['teacher_gender']));
    $current_image = strip_tags(mysqli_real_escape_string($con, $_POST['current_image']));

    // cheking if new image is added
    // if yes then adding it to the db & removing current from the teacher folder
    if ($_FILES['image']['name'] != "") {
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {
            // renaming
            $ext = end(explode('.', $image_name));
            $image_name = "teacher-name" . rand(0000, 9999) . '.' . $ext;

            // uploading
            $source_loc = $_FILES['image']['tmp_name'];
            $destination_loc = "images/teacher/" . $image_name;
            $upload = move_uploaded_file($source_loc, $destination_loc);

            // cheking if it is uploaded or not
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>failed to upload new image</div>";
                // redirecting
                header("location:" . SITEURL . 'admin/manage-teachers.php');
                die();
            }

            // removing old image from the teacher folder
            if ($current_image != "") {
                // deleting image
                $remove_path = "images/teacher/" . $current_image; //getting  path for the image to be deleted
                $remove = unlink($remove_path); //removing image from that path

                // checking if image is removed
                if ($remove == false) {
                    // session message
                    $_SESSION['fail-image-remove'] = "<div class='error'>failed to remove techer image</div>";
                    // redirecting to food page
                    header("location:" . SITEURL . 'admin/manage-teachers.php');
                    // stop the process
                    die();
                }
            }
        }
    } else {
        $image_name = $current_image;
    }


    // updating data in the db
    $sql2 = "update `teacher` set teacher_name='$teacher_name', teacher_desc='$teacher_desc', image_name='$image_name', teacher_gender='$teacher_gender' where id='$id'";
    $res2 = mysqli_query($con, $sql2);

    // chevcking if the data is updated
    if ($res2 == true) {
        // data is updated
        $_SESSION['teacher-updated'] = "<div class='success'>Teacher is updated successfully</div>";
        header("location:" . SITEURL . "admin/manage-teachers.php");
    } else {
        // failed to update
        $_SESSION['teacher-updated'] = "<div class='error'>Failed to update</div>";
        header("location:" . SITEURL . "admin/manage-teachers.php");
    }
}

include('partials/footer.php');
?>