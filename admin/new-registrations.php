<?php
include('partials/header.php');
?>
<div class="dashboard">
    <div class="wrapper">
        <h1>New Registrations</h1>
        <br>
        <h3>
            <?php
            if (isset($_SESSION['remove'])) {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            ?>
        </h3>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Current std</th>
                <th>Act</th>
            </tr>

            <!-- getting values from the database -->
            <?php
            $sql = "select * from student_register";
            $res = mysqli_query($con, $sql);
            $sn = 1;
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $f_name = $row['first_name'];
                    $m_name = $row['middle_name'];
                    $l_name = $row['last_name'];
                    $mobile = $row['mobile'];
                    $address = $row['address'];
                    $current_std = $row['current_std'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $f_name . " " . $m_name . " " . $l_name; ?></td>
                        <td><?php echo $address; ?></td>
                        <td><?php echo $mobile; ?></td>
                        <td><?php echo $current_std; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>/admin/remove-registers.php?id=<?php echo $id; ?>" class="btn-danger">Remove</a>
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