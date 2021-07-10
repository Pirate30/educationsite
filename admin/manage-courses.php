<?php
include('partials/header.php');
?>

<div class="dashboard">
    <div class="wrapper">
        <h1><strong>Manage Courses</strong></h1>
        <br>
        <a href="<?php echo SITEURL ?>admin/add-course.php" class="btn-primary">Add Course</a>
        <br>
        <br>
        <br>
        <h3>
            <?php
            // checking if the course is added or not and showig approprate message.
            if (isset($_SESSION['add-course'])) {
                echo $_SESSION['add-course'];
                unset($_SESSION['add-course']);
            }
            // checking if the course is deleted or not and showig approprate message.
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            // checking if the image is uploaded or not and showig approprate message.
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            // checking if the data which user wants to edit is available or not and showig approprate message.
            if (isset($_SESSION['no-data'])) {
                echo $_SESSION['no-data'];
                unset($_SESSION['no-data']);
            }
            // checking if the image is removed or not and showig approprate message.
            if (isset($_SESSION['remove'])) {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            // checking if the old image is removed or not and showig approprate message.
            if (isset($_SESSION['fail-image-remove'])) {
                echo $_SESSION['fail-image-remove'];
                unset($_SESSION['fail-image-remove']);
            }
            // checking if the couse is updated or not and showig approprate message.
            if (isset($_SESSION['updated-course'])) {
                echo $_SESSION['updated-course'];
                unset($_SESSION['updated-course']);
            }
            ?>
        </h3>
        <br>
        <table class="tbl-full">
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Image</th>
                <th>Daily Hours</th>
                <th>Total Duration</th>
                <th>Course Teacher</th>
                <th>Actions</th>
            </tr>

            <!-- getting values from the database -->
            <?php
            $sql = "select * from course";
            $res = mysqli_query($con, $sql);
            $sn = 1;
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $course_name = $row['course_name'];
                    $daily_hours = $row['daily_hours'];
                    $course_duration = $row['course_duration'];
                    $course_teacher_id = $row['course_teacher_id'];
                    $image_name = $row['image_name'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $course_name; ?></td>
                        <td>
                            <?php
                            if ($image_name != "") {
                            ?>
                                <img src="<?php echo SITEURL; ?>admin/images/course/<?php echo $image_name; ?>" width="100px" height="100px">
                            <?php
                            } else {
                                echo "<div class='error'>No Image is added</div>"; // displaying error message
                            }
                            ?>
                        </td>
                        <td><?php echo $daily_hours; ?></td>
                        <td><?php echo $course_duration; ?></td>
                        <!-- getting name of teacher from the dn using $course_teacher_id -->
                        <?php
                        $sql2 = "select * from teacher where id = '$course_teacher_id'";
                        $res2 = mysqli_query($con, $sql2);
                        $count = mysqli_num_rows($res2);
                        if ($count > 0) {
                            while ($row2 = mysqli_fetch_assoc($res2)) {
                                $teacher_name = $row2['teacher_name'];
                        ?>
                                <td><?php echo $teacher_name; ?></td>
                        <?php
                            }
                        } else {
                            echo "<td class='error'>Not Available</td>";
                        }
                        ?>

                        <td>
                            <a href=" <?php echo SITEURL; ?>/admin/update-course.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL; ?>/admin/delete-course.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?> " class="btn-danger">Delete</a>

                        </td>
                    </tr>
            <?php
                }
            }

            ?>


            <tr>

            </tr>
        </table>
    </div>
</div>

<?php
include('partials/footer.php');
?>