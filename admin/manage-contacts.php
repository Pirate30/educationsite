<?php
include('partials/header.php');
?>

<div class="dashboard">
    <div class="wrapper">
        <h1><strong>Manage Contacts</strong></h1>
        <br>
        <br>
        <h2>
            <?php
            // checking if the contact is deleted or not and showig approprate message.
            if (isset($_SESSION['contact-delete'])) {
                echo $_SESSION['contact-delete'];
                unset($_SESSION['contact-delete']);
            }
            ?>
        </h2>


        <table class="tbl-full">
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Number</th>
                <th>Address</th>
                <th>Reason</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            <!-- getting values from db -->
            <?php
            $sql = "select * from `contact`";
            $res = mysqli_query($con, $sql);
            $sn = 0;
            // check if query fired correctly
            if ($res == true) {
                // check if the data exists
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $name = $row['contact_name'];
                        $number = $row['contact_number'];
                        $address = $row['contact_address'];
                        $reason = $row['contact_detail'];
                        $date = $row['contact_date'];
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $number; ?></td>
                            <td><?php echo $address ?></td>
                            <td><?php echo $reason; ?></td>
                            <td><?php echo $date; ?></td>
                            <td>
                                <a href=" <?php echo SITEURL; ?>/admin/view-contact.php?id=<?php echo $id; ?>" class="btn-secondary">View</a>
                                <a href="<?php echo SITEURL; ?>/admin/delete-contact.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>

                            </td>
                        </tr>
            <?php
                    }
                } else {
                    echo "<td class='error' span='6' >Not Available</td>";
                }
            }
            ?>
        </table>

    </div>
</div>

<?php
include('partials/footer.php');
?>