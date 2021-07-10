<?php
include('config/connection.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <!-- Login Form -->
            <h1>Log In</h1>
            <h3>
                <!-- checking for the login action and showing appriprwate message -->
                <?php
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>
                <?php
                if (isset($_SESSION['logged-out-msg'])) {
                    echo $_SESSION['logged-out-msg'];
                    unset($_SESSION['logged-out-msg']);
                }
                ?>
            </h3>


            <form method="post">
                Email: <input type="text" name="email" placeholder="enter email" required>
                Password:<input type="password" name="password" placeholder="Enter password" required><br>
                <input type="submit" name="submit" class="btn" value="Login">
                <br>
                <a href="#">Forgot Password?</a>
            </form>

        </div>
    </div>
</body>

</html>
<?php
// check if button pressed

if (isset($_POST['submit'])) {

    // getting the credentials
    $email = strip_tags(mysqli_real_escape_string($con, $_POST['email']));
    $password = strip_tags(mysqli_real_escape_string($con, $_POST['password']));

    // sql to check the credentials
    $sql = "select * from admin where email='$email' and password='$password'";
    $res = mysqli_query($con, $sql); //executiion of the query
    // counting rows of the result
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = "<div class='success'>login successful</div>";
        $_SESSION['user'] = $email;
        header("location:index.php");
    } else {
        $_SESSION['login'] = "<div class='error'>User Not Exists try again.</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}


?>