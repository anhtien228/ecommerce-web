<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="format-detection" content="telephone=no">
    <title>Electro</title>
    <!--reset css-->
    <link rel="stylesheet" href="css/product.css" />
    <link rel="stylesheet" href="css/flex_user.css" />
    <link rel="stylesheet" href="css/about_us.css" />

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLuMe7gnKGLap0Srsk0JPfClS9fsIxxYU"></script>
    <script src="js/cart.js"></script>
    <script src="js/main.js"></script> <!-- Resource jQuery -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->

</head>

<body>
    <!--Navigation bar-->
    <div class="menu">
        <nav class="flex-container">
            <ul>
                <!--Logo-->
                <li>
                    <a href="index.php"><img src="./img/rythm.png" width=250px; height=90px; /></a>
                </li>
                <!--Menu-->
                <li>
                    <a href="index.php">Home</a>
                    <a href="login.php">Product</a>
                    <!-- <li><form action="searchsong.php" id="search_song" method="post">
                        <input type="text" class="search__input" type="text" name="song_name" placeholder="Search a product"></form>
                    </li> -->
                    <a href="about2.php">About</a>
                </li>
                <!--User action-->
                <li>
                    <a href="login.php" class="btn blue"><span>Login</span></a>
                    <a href="register.php" class="btn green"><span>Register</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <!--Body-->
    <section id="main-page">
        <div class="content-bg">
            <div class="content-text">
                <h2>About us</h2>
            </div>
        </div>
    </section>
    <section id="about-us">
        <div class="about-text" style="margin-top: 4rem;">
            <h1>Introduction</h1>
            <p>Welcome to Electro, your number one source for laptop products. We're dedicated to giving you the very best of laptop, with a focus on dependability, customer service and uniqueness. Founded in 2021 as a group project, Electro thrive to become a better version of itself everyday with the upgrades in functionalities, services and well-looking appearence.</p>
            <p>We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us!</p>
        </div>
        <div class="about-text">
            <h1>Location</h1>
            <h3>Showroom</h3>
            <p>268 Ly Thuong Kiet, Ward 14, District 10, Ho Chi Minh City</p>
        </div>
    </section>
    <section id="cd-google-map">
        <div id="google-container"></div>
        <div id="cd-zoom-in"></div>
        <div id="cd-zoom-out"></div>
        <address>268 Ly Thuong Kiet, Ward 14, District 10, Ho Chi Minh City</address> 
    </section>
    <!--Footer-->
    <div class="footer">
        <p>Electro</p>
    </div>

</html>