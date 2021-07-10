<?php
include('partials/header.php');
?>

<div class="dashboard">
    <div class="wrapper">
        <h1><strong>Manage Teachers</strong></h1>
        <br>
        <a href="<?php echo SITEURL ?>admin/add-teacher.php" class="btn-primary">Add Teacher</a>
        <br>
        <br>
        <br>
        <h3>
            <?php
            // checking if the teacher is added or not and showig approprate message.
            if (isset($_SESSION['add-teacher'])) {
                echo $_SESSION['add-teacher'];
                unset($_SESSION['add-teacher']);
            }
            // checking if the image is uoloaded or not and showig approprate message.
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            // checking if the old image is removed  or not and showig approprate message.
            if (isset($_SESSION['fail-image-remove'])) {
                echo $_SESSION['fail-image-remove'];
                unset($_SESSION['fail-image-remove']);
            }
            // checking if the teacher is updated or not and showig approprate message.
            if (isset($_SESSION['teacher-updated'])) {
                echo $_SESSION['teacher-updated'];
                unset($_SESSION['teacher-updated']);
            }

            ?>
        </h3>
        <br>
        <table class="tbl-full">
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>

            <!-- getting values from the database -->
            <?php
            $sql = "select * from teacher";
            $res = mysqli_query($con, $sql);
            $sn = 1;
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $teacher_name = $row['teacher_name'];
                    $teacher_desc = $row['teacher_desc'];
                    $teacher_gender = $row['teacher_gender'];
                    $image_name = $row['image_name'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $teacher_name; ?></td>
                        <td>
                            <?php
                            if ($image_name != "") {
                            ?>
                                <img src="<?php echo SITEURL; ?>admin/images/teacher/<?php echo $image_name; ?>" width="100px" height="100px">
                            <?php
                            } else {
                                echo "<div class='error'>No Image is added</div>"; // displaying error message
                            }
                            ?>
                        </td>
                        <td width="50%"><?php echo $teacher_desc; ?></td>
                        <td><?php echo $teacher_gender; ?></td>
                        <td>
                            <a href=" <?php echo SITEURL; ?>/admin/update-teacher.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL; ?>/admin/delete-teacher.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?> " class="btn-danger">Delete</a>

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