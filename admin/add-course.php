<?php
include('partials/header.php');
?>


<div class="dashboard">
    <div class="wrapper">
        <h1><strong>Add Course</strong></h1>
        <br>
        <h3>
            <?php
            // checking if the course is added or not and showig approprate message.
            if (isset($_SESSION['add-course'])) {
                echo $_SESSION['add-course'];
                unset($_SESSION['add-course']);
            }
            ?>
        </h3>

        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-50">
                <tr>
                    <td>Course Name:</td>
                    <td><input type="text" name="course_name" placeholder="enter the course name" required></td>
                </tr>
                <tr>
                    <td>Descreption:</td>
                    <td>
                        <textarea name="course_description" id="" cols="30" rows="10" placeholder="enter the description" required></textarea>
                        <!-- <input type="text" name="" placeholder="" required></td> -->
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Daily Hours:</td>
                    <td><input type="number" name="daily_hours" placeholder="enter daily hours"></td>
                </tr>
                <tr>
                    <td>Course Duration (months)</td>
                    <td><input type="number" name="course_duration" placeholder="The total duration of course"></td>
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
                                    $id = $row['id'];
                                    $teacher_name = $row['teacher_name'];
                            ?>
                                    <option value="<?php echo $id ?>"><?php echo $teacher_name ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="">Not Added</option>
                            <?php
                            }
                            ?>



                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Course" class="btn-primary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php

// getting data from the form and adding it to the database
if (isset($_POST['submit'])) {
    // fetching subitted values
    $course_name = strip_tags(mysqli_real_escape_string($con, $_POST['course_name']));
    $course_description = strip_tags(mysqli_real_escape_string($con, $_POST['course_description']));
    $daily_hours = strip_tags(mysqli_real_escape_string($con, $_POST['daily_hours']));
    $course_duration = strip_tags(mysqli_real_escape_string($con, $_POST['course_duration']));
    $course_teacher = strip_tags(mysqli_real_escape_string($con, $_POST['course_teacher']));


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
            $image_name = "course-name" . rand(000, 999) . "." . $ext;

            $source_loc = $_FILES['image']['tmp_name'];
            $destination_loc = "images/course/" . $image_name;

            // now uploading that image
            $upload = move_uploaded_file($source_loc, $destination_loc);

            // checking if image is uploaded
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
                // redirecting
                header("location:" . SITEURL . 'admin/manage-courses.php');
                die();
            }
        }
    } else {
        // image is not slected so leave the name blank
        $image_name = "";
    }

    // sql query to add data to db
    $sql = "insert into course set course_name='$course_name' , course_description = '$course_description' , daily_hours='$daily_hours' , course_duration='$course_duration' , course_teacher_id='$course_teacher', image_name='$image_name'";
    $res = mysqli_query($con, $sql); //executing
    if ($res == true) {
        $_SESSION['add-course'] = "<div class='success'>Course is added, Successfully.</div>";
        header("location:" . SITEURL . "admin/manage-courses.php");
    } else {
        $_SESSION['add-course'] = "<div class='succes'>Course is not added, try again.</div>";
    }
}



include('partials/footer.php');
?>