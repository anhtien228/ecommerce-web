<?php
session_start();
if(!isset($_SESSION["user_name"]))
	header("Location: login.php"); 
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="format-detection" content="telephone=no">
        <title>Electro</title>
        <!--reset css-->
        <link rel="stylesheet" href="css/util.css"/>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
            
        <script src="https://kit.fontawesome.com/57448d1974.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <!-- <script src="js/cart.js"></script> -->


        <?php if($_SESSION["user_level"] == "User") {?>
            <meta http-equiv="refresh" content="3;url=user_index.php?id=<?php echo $_SESSION['id']?>"/>
        <?php }?>
        <?php if($_SESSION["user_level"] == "Staff") {?>
            <meta http-equiv="refresh" content="3;url=staff_index.php?id=<?php echo $_SESSION['id']?>"/>
        <?php }?>

    </head>
    <body>
        <!--Navigation bar-->
        <!--Navbar-->
        <?php if($_SESSION["user_level"] == "User") {
            include "libs/nav_user.php";?>
        <?php }?>
        <?php if($_SESSION["user_level"] == "Staff") {
            include "libs/nav_staff.php";?>
        <?php }?>
        <!--Body-->

        <section id="contact-container">
            <div class="login-text">
                <br>
                <br>
                <h1>Welcome <?php echo $_SESSION['name']; ?>!</h1>
                <br>
                <p>You have successfully logged in!</p>
                <p>Redirecting to home page . . .</p>
            </div>

        </section>

        <!--Footer-->
        <footer class="text-muted">
        <div id="copyright" class="text-center p-2 fixed-bottom" style ="font-size: 14px;
                                                                        background-color: #3F4C5C;
                                                                        margin-top: 1rem;
                                                                        color: white;">
        © 2020 Copyright: <b>Electro., Corp</b>
        </div>
        </footer>

        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        
    </body>
    </html>
