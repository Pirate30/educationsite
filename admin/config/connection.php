<?php

// starting the session
session_start();

// defining site path url
define('SITEURL', 'http://localhost/Educationsite/');

$con = mysqli_connect('localhost', 'root', '', 'educationsite') or die;
