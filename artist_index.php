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

    </head>
    <body>
        <!--Navigation bar-->
        <div class="menu">
        <nav class="flex-container">
            <ul>
                <li><a href="user_index.php"><img src="./img/rythm.png" width=250px; height=90px; /></a></li>
                <li><a href="user_index.php">Home</a></li>
                <li><a href="#">Playlist</a></li>
                <li>
                    <form action="searchsong.php" id="search_song" method="post">
                    <input class="search__input" type="text" placeholder="Search"></li>
                    </form>
                </li>
                <li><i style='font-size:17px' class='fas'>&#xf406;</i></li>
                <li><a href="#"><?php echo $_SESSION['name']; ?></a></li>
                <li><a href="logout.php" class="btn blue" onclick="return confirm('Are you sure you want to logout?')" ><span>Logout</span></a></li>
            </ul>
        </nav>
    </div>
        <!--Body-->
        <section id="main-page">
         <div class="content-bg">
             <div class="content-text">
                    <h2>Upload your song</h2>
                    <br>
                    <br>
                    <p>Your talent is a hidden gem, and it will shine through the melody!</p>
             </div>
         </div>
        </section>
        <!--Footer-->
        <div class="footer">
            <p>Rythm</p>
        </div>

        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    </body>
    </html>
