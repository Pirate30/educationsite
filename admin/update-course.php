<?php
include('partials/header.php');

if (isset($_GET['id'])) {
    // getting current data using the id which is getting  passed
    $id = $_GET['id'];
    $sql = "select * from course where id='$id'";
    $res = mysqli_query($con, $sql);
    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $course_id = $row['id'];
            $current_course_name  = $row['course_name'];
            $current_course_description = $row['course_description'];
            $current_daily_hours = $row['daily_hours'];
            $current_course_duration = $row['course_duration'];
            $current_course_teacher_id = $row['course_teacher_id'];
            $current_image = $row['image_name'];
        } else {
            $_SESSION['no-data'] = "<div class='error'>Data Not Available</div>";
            header("location:" . SITEURL . 'admin/manage-courses.php');
            die();
        }
    } else {
        $_SESSION['no-data'] = "<div class='error'>Data Not Available</div>";
        header("location:" . SITEURL . 'admin/manage-courses.php');
        die();
    }
} else {
    header("location:" . SITEURL . "admin/manage-courses.php");
}

?>

<div class="dashboard">
    <div class="wrapper">
        <h1><strong>Update Course</strong></h1>
        <br>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-50">
                <tr>
                    <td>Course Name:</td>
                    <td>
                        <input type="text" name="course_name" value="<?php echo $current_course_name; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Desciprtion:</td>
                    <td>
                        <input type="text" name="course_description" value="<?php echo $current_course_description; ?>" required>
                    </td>
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
                            <img src="<?php echo SITEURL; ?>admin/images/course/<?php echo $current_image; ?>" alt="<?php echo $title ?>" height="100px" width="100px">
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Daily Hours:</td>
                    <td>
                        <input type="number" name="daily_hours" value="<?php echo $current_daily_hours; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Course Duration:</td>
                    <td>
                        <input type="number" name="course_duration" value="<?php echo $current_course_duration; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Course Teacher</td>
                    <td><select name="course_teacher" id="">
                            <?php
                            // sql to fetch teachers id and names form the db to show in selection
                            $sql2 = "select * from teacher ";
                            $res2 = mysqli_query($con, $sql2);
                            $count = mysqli_num_rows($res2);
                            // check if teachers are available
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res2)) {
                                    $teacher_id = $row['id'];
                                    $teacher_name = $row['teacher_name'];
                            ?>
                                    <option <?php if ($teacher_id == $current_course_teacher_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $teacher_id; ?>"><?php echo $teacher_name ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="">Not Added</option>
                            <?php
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <td colspan="2"><input type="submit" name="submit" value="Update course" class="btn-primary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {
    // fetching details from the form
    $id = strip_tags(mysqli_real_escape_string($con, $_POST['course_id']));
    $course_name = strip_tags(mysqli_real_escape_string($con, $_POST['course_name']));
    $course_description = strip_tags(mysqli_real_escape_string($con, $_POST['course_description']));
    $daily_hours = strip_tags(mysqli_real_escape_string($con, $_POST['daily_hours']));
    $course_duration = strip_tags(mysqli_real_escape_string($con, $_POST['course_duration']));
    $course_teacher_id = strip_tags(mysqli_real_escape_string($con, $_POST['course_teacher']));
    $current_image = strip_tags(mysqli_real_escape_string($con, $_POST['current_image']));


    // working on image part
    if ($_FILES['image']['name'] != "") {
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {
            // auto-rename
            $ext = end(explode('.', $image_name));
            $image_name = "course-name" . rand(0000, 9999) . '.' . $ext;

            // upload
            $source_loc = $_FILES['image']['tmp_name'];
            $destination_loc = "images/course/" . $image_name;
            // now uploading that image
            $upload = move_uploaded_file($source_loc, $destination_loc);

            // rremoving old image from the course folder
            if ($current_image != "") {
                // proceed to delete
                $remove_path = "images/course/" . $current_image; //getting  path for the image to be deleted
                $remove = unlink($remove_path); //removing image from that path

                // checking if it is deleted
                if ($remove == false) {
                    // session message
                    $_SESSION['fail-image-remove'] = "<div class='error'>failed to remove previous course image</div>";
                    // redirecting to course manager page
                    header("location:" . SITEURL . 'admin/manage-courses.php');
                    // stop the process
                    die();
                }
            }
        }
    } else {
        $image_name = $current_image;
    }

    // now updating data from the databse
    $sql3 = "update `course` set
    course_name ='$course_name',
    course_description = '$course_description',
    daily_hours = '$daily_hours',
    course_duration ='$course_duration',
    course_teacher_id = '$course_teacher_id',
    image_name = '$image_name'
    where id=$id
    ";

    $res3 = mysqli_query($con, $sql3);
    if ($res3 == true) {
        // updated successfully
        $_SESSION['updated-course'] = "<div class='success'>Course Is Updated Successfully!</div>";
        // header("location:" . SITEURL . "admin/manage-courses.php");
?>
        <script>
            window.location.href = "<?php SITEURL; ?>manage-courses.php ";
        </script>
<?php
    } else {
        //fialed to update
        $_SESSION['updated-course'] = "<div class='error'>Something Went Wrong, Try Again!</div>";
        header("location:" . SITEURL . "admin/manage-courses.php");
    }
}

include('partials/footer.php');
?>