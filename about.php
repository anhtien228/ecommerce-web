<?php
require("libs/DatabaseClass.php");
session_start();
if(!isset($_SESSION["user_name"]))
    header("Location: about2.php");
?>

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="format-detection" content="telephone=no">
    <title>Electro</title>

    <!-- Local CSS -->
    <link rel="stylesheet" href="css/util.css" />
    <link rel="stylesheet" href="css/about_us.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/57448d1974.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Google APIs and Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLuMe7gnKGLap0Srsk0JPfClS9fsIxxYU"></script>
    <script src="js/map.js"></script> <!-- Resource jQuery -->

</head>

<body>
<!--Navbar-->
    <?php
    include "libs/nav_user.php"; // Using navbar file here
    ?>
    <!--Body-->
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container-fluid" style="background-color: #4285f4; padding: 3rem; margin-top: auto;">
            <h2 style= "font-family: Gilroy Bold;
                        font-size: 40px;
                        text-decoration: none;
                        color: white;">
                        About us
            </h2>
            <p style= "font-family: Gilroy Medium;
                text-decoration: none;
                color: white;">
                Find out how to reach us!
            </p>
        </div>
    </div>

    <section id="about-us">
        <div class="about-text" style="margin-top: 4rem;">
            <h2>Introduction</h2>
            <p>Welcome to Electro, your number one source for laptop products. We're dedicated to giving you the very best of laptop, with a focus on dependability, customer service and uniqueness. Founded in 2021 as a group project, Electro thrive to become a better version of itself everyday with the upgrades in functionalities, services and well-looking appearence.</p>
            <p>We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us!</p>
        </div>
        <div class="about-text">
            <h2>Location</h2>
            <p><b>Showroom</b><br>
            268 Ly Thuong Kiet, Ward 14, District 10, Ho Chi Minh City
            <p>
            <p><b>Branch</b><br>
            102, Ham Nghi, Ward 2, District 1, Ho Chi Minh City
            <p>
        </div>
    </section>
    <section id="cd-google-map" style="margin-bottom: 4rem;">
        <div id="google-container"></div>
        <div id="cd-zoom-in"></div>
        <div id="cd-zoom-out"></div>
        <address>268 Ly Thuong Kiet, Ward 14, District 10, Ho Chi Minh City</address> 
    </section>
    <!--Footer-->
    <?php
    include "libs/footer.php"; // Using footer file here
    ?>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
</body>
</html>