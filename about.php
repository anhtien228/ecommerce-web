<?php
session_start();
if (!isset($_SESSION["user_name"]))
    header("Location: login.php");
?>

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
    <script src="js/main.js"></script> <!-- Resource jQuery -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->

</head>

<body>
    <?php
    include "db_conn.php"; // Using database connection file here

    $sql = "CALL getLaptopProducts";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result(); // fetch data from database
    while ($data = mysqli_fetch_assoc($records)) {
        if ($data['productBrand'] == 'Asus') {
            $asus[] = $data;
        } else if ($data['productBrand'] == 'Acer') {
            $acer[] = $data;
        } else if ($data['productBrand'] == 'Lenovo') {
            $lenovo[] = $data;
        } else if ($data['productBrand'] == 'Dell') {
            $dell[] = $data;
        } else if ($data['productBrand'] == 'Apple') {
            $apple[] = $data;
        } else if ($data['productBrand'] == 'HP') {
            $hp[] = $data;
        }
    }
    ?>
    <!--Navigation bar-->
    <div class="menu">
        <nav class="flex-container">
            <ul>
                <!--Logo-->
                <li>
                    <a href="user_index.php?id=<?php echo $_SESSION["id"] ?>"><img src="./img/rythm.png" width=250px; height=90px; /></a>
                </li>
                <!--Menu-->
                <li>
                    <a href="user_index.php?id=c<?php echo $_SESSION["id"] ?>">Home</a>
                    <a href="user_index.php?id=c<?php echo $_SESSION["id"] ?>">Product</a>
                    <!-- <li><form action="searchsong.php" id="search_song" method="post">
                            <input type="text" class="search__input" type="text" name="song_name" placeholder="Search a product"></form>
                        </li> -->
                    <a href="about.php?id=c<?php echo $_SESSION["id"] ?>">About</a>
                </li>
                <!--User action-->
                <li>
                    <a style='font-size:17px; align-self:center;' class='fas'>&#xf406;</a>
                    <a href="#"><?php echo $_SESSION['name']; ?></a>
                    <a href="logout.php" style="margin-left: 2rem;" class="btn blue" onclick="return confirm('Are you sure you want to logout?')"><span>Logout</span></a>
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
    <section>
        <div class="about-text">
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