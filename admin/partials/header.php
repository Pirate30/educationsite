<?php
include('config/connection.php');
include('partials/login-check.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edducation Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" referrerpolicy="no-referrer" />
</head>

<body>

    <!-- header section -->
    <header>
        <div id="menu" class="fas fa-bars"></div>
        <a href="#" class="logo"> <i class="fas fa-user-graduate"></i>Logo </a>

        <nav class="navbar">
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="manage-courses.php">Courses</a></li>
                <li><a href="manage-teachers.php">Teachers</a></li>
                <li><a href="manage-contacts.php">Contacts</a></li>
                <li><a href="new-registrations.php">New Regi.</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt 3X"></i></a></li>
            </ul>
        </nav>
    </header>
    <!-- finished header section -->