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
        <link rel="stylesheet" href="css/contact.css"/>
        <link rel="stylesheet" href="css/flex_user.css" />
        <?php if($_SESSION["user_level"] == "User") {?>
            <meta http-equiv="refresh" content="3;url=user_index.php?id=<?php echo $_SESSION['id']?>"/>
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
                        <a href="about.php">About</a>
                    </li>
                    <!--User action-->
                    <li>
                    <a style='font-size:17px; align-self:center;' class='fas'>&#xf406;</a>
                    <a href="#"><?php echo $_SESSION['name']; ?></a>
                    <a href="logout.php" style="margin-left: 2rem;" class="btn bordered" onclick="return confirm('Are you sure you want to logout?')" ><span>Logout</span></a>
                    </li>
                </ul>
            </nav>
        </div>
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
        <div class="footer">
            <p>Rythm</p>
        </div>

        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        
    </body>
    </html>
