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
        <title>Rythm</title>
        <!--reset css-->
        <link rel="stylesheet" href="css/contact.css"/>
        <link rel="stylesheet" href="css/flex_user.css" />
        <?php if($_SESSION["user_level"] == "User") {?>
            <meta http-equiv="refresh" content="3;url=user_index.php"/>
        <?php }?>
        <?php if($_SESSION["user_level"] == "Artist") {?>
            <meta http-equiv="refresh" content="3;url=artist_index.php"/>
        <?php }?>

    </head>
    <body>
        <!--Navigation bar-->
        <div class="menu">
        <nav class="flex-container">
            <ul>
                <li><a href="index.php"><img src="./img/rythm.png" width=250px; height=90px; /></a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Product</a>
                    <ul class="dropdown-1">
                        <li><a href="index.php">Asus</a></li>
                        <li><a href="index.php">Lenovo</a></li>
                    </ul>
                </li>
                <li>
                <form action="searchsong.php" id="search_song" method="post">
                    <input type="text" class="search__input" type="text" name="song_name" placeholder="Search a product">
                </form>
                </li>
                <li><i style='font-size:17px' class='fas'>&#xf406;</i></li>
                <li><a href="#"><?php echo $_SESSION['name']; ?></a></li>
                <li><a href="logout.php" class="btn blue"><span>Logout</span></a></li>
            </ul>
        </nav>
    </div>
        <!--Body-->

        <section id="contact-container">
            <div class="login-text">
                <h1>Welcome <?php echo $_SESSION['name']; ?>!</h1>
                <br>
                <p>You have successfully logged in!</p>
                <p>Redirecting to home page . . .</h1>
            </div>

        </section>

        <!--Footer-->
        <div class="footer">
            <p>Rythm</p>
        </div>

        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        
    </body>
    </html>
