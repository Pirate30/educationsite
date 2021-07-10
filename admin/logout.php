<?php

// including connection
include('config/connection.php');
// destroying session
session_destroy();
// redirecting to login page
header('location:' . SITEURL . 'admin/login.php');
