<?php
include('partials/header.php');

?>

<section class="dashboard">

    <div class="wrapper">
        <h1><strong>DASHBOARD</strong></h1>
        <h3>hello , <?php echo $_SESSION['user']; ?></h3>
        <h3>
            <!-- checking if the user is logged in and showin appropriate message -->
            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>

        </h3>

        <!-- courses -->
        <div class="col-4 text-center">
            <h1>4</h1>
            <br>
            Courses
        </div>

        <!-- Teachers -->
        <div class="col-4 text-center">
            <h1>4</h1>
            <br>
            Teachers
        </div>

        <!-- Students -->
        <div class="col-4 text-center">
            <h1>4</h1>
            <br>
            Students
        </div>

        <!-- Contacts -->
        <div class="col-4 text-center">
            <h1>4</h1>
            <br>
            Contacts
        </div>
        <div class="clearfix"></div>
    </div>

</section>
<?php
include('partials/footer.php')
?>