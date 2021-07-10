<?php
include('config/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Website</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;1,300&display=swap" rel="stylesheet">

    <!-- font osm cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custome css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <!-- header section -->
    <header>
        <div id="menu" class="fas fa-bars"></div>
        <a href="#" class="logo"> <i class="fas fa-user-graduate"></i>LOGO </a>

        <nav class="navbar">
            <ul>
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#about">about</a></li>
                <li><a href="#course">courses</a></li>
                <li><a href="#teachers">teachers</a></li>
                <li><a href="#contact">contact us</a></li>
            </ul>
        </nav>
        <div id="login" class="fas fa-user-circle"></div>
    </header>
    <!-- finished header section -->

    <!-- login form -->
    <div class="login-form">
        <form action="" method="post">
            <h3>Register:</h3>
            <h4><?php
                if (isset($_SESSION['register'])) {
                    echo $_SESSION['register'];
                    unset($_SESSION['register']);
                }
                ?></h4>
            <input type="text" name="f_name" placeholder="firstname" class="box" required>
            <input type="text" name="m_name" placeholder="middlename" class="box" required>
            <input type="text" name="l_name" placeholder="lastname" class="box">
            <input type="number" name="std" placeholder="your current standerd" class="box" required>
            <input type="number" name="phone" placeholder="enter your contact number" class="box" required>
            <textarea name="address" id="" cols="30" rows="3" placeholder="enter your current address" class="box"></textarea>
            <!-- <p>forget password? <a href="">Cick Here</a> </p> -->
            <!-- <p>New User?<a href="">Register</a> </p> -->
            <input type="submit" name="submit" class="btn" value="Register">
            <i class="fas fa-times"></i>
        </form>
    </div>
    <!-- finoshed header section -->

    <?php

    if (isset($_POST['submit'])) {

        $first_name = strip_tags(mysqli_real_escape_string($con, $_POST['f_name']));
        $middle_name = strip_tags(mysqli_real_escape_string($con, $_POST['m_name']));
        $last_name = strip_tags(mysqli_real_escape_string($con, $_POST['l_name']));
        $mobile = strip_tags(mysqli_real_escape_string($con, $_POST['phone']));
        $address = strip_tags(mysqli_real_escape_string($con, $_POST['address']));
        $current_std = strip_tags(mysqli_real_escape_string($con, $_POST['std']));


        // adding those data into db
        $sql = "insert into `student_register` set 
        first_name = '$first_name' , 
        middle_name ='$middle_name' , 
        last_name ='$last_name' ,
        mobile = '$mobile',
        address='$address' ,
        current_std='$current_std' ";
        $res = mysqli_query($con, $sql);



        if ($res == true) {
    ?><script>
                alert("Registered successfully! Our Team will be in your Contact soon");
            </script>
        <?php
            $_SESSION['register'] = "<div class='success'>Registered successfully! Our Team will be in your Contact soon.</div>";
        } else {
        ?><script>
                alert("Failed to register! Try Again.");
            </script>
    <?php
            $_SESSION['register'] = "<div class='error'>Failed! Try Again.</div>";
        }
    }

    ?>