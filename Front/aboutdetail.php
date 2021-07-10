<?php
// include("header.php");
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Educational Website</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;1,300&display=swap" rel="stylesheet">

    <!-- font osm cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- header section -->
    <header>
        <div id="menu" class="fas fa-bars"></div>
        <a href="index.php" class="logo"> <i class="fas fa-user-graduate"></i>LOGO </a>

        <nav class="navbar">
            <ul>
                <li><a href="index.php">Back </a></li>
            </ul>
        </nav>
        <div id="login" class="fas fa-user-circle"></div>
    </header>
    <!-- finished header section -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="https://source.unsplash.com/900x300/?students.teachers" class="d-cover w-100" alt="..." style="opacity: 0.5;">
                <div class="carousel-caption d-none d-md-block">
                    <h1 style="font-size: 4rem;">First slide label</h1>
                    <p>Your Success is our Future</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="https://source.unsplash.com/900x300/?science,mathematics" class="d-cover w-100" alt="..." style="opacity: 0.5;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Second slide label</h1>
                    <p>હું છું ને તારી સાથે..</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/900x300/?learning" class="d-cover w-100" alt="..." style="opacity: 0.5;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Third slide label</h1>
                    <p>Where "HOW" converts into "WOW"</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="content">
        <div class="aboutmore">
            <h3 style="
    width: 80%;
    text-align: center;
    /* display: flex; */
    /* align-items: center; */
    margin: auto;
    padding: 2rem;
"> Unique Group Tuition established in year 1999. Today it Consider as a one of the big institute of Ahmedabad with more than 1000 students. Every year student of our institute get rank in state board examination. Every year media covers, interview of our students after the result of standard 10th & 12th.
            </h3>
            <p>
            <ul>
                <li>It is centrally AC Institute.</li>
                <li>All Rooms are equiped with theaudio visual facility.</li>
                <li>Theoritical Subjects are taught by 2-D and 3-D software.</li>
                <li>All lectures are undertaken the observation of CCTV Camera.</li>
                <li>Once you entered the any class room you got sound proof and chilled atmosphere.It is favourable for students.</li>
                <li>Motto of Unique Academy is હું છું ને તારી સાથે Means We are with you. and We truely beleive in.</li>
                <li>Descipline and regularity are two basic fundamental features of our Institute.</li>
                <li>Regular Exams are conducted Continues follow up of students are taken.</li>
            </ul>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script src="js/script.js"></script>


</body>

</html>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
<?php
include("footer.php");
?>