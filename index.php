<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="format-detection" content="telephone=no">
    <title>Rythm</title>
    <!--reset css-->
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="css/flex.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <!--Navigation bar-->
    <div class="popup-message">
        <?php if (isset($_GET['error'])) { ?>
        <span style="display:table; margin-left: auto; margin-right: auto;" class="error"><?php echo $_GET['error']; ?></span>
        <?php }?>
        <?php if (isset($_GET['success'])) { ?>
        <span style="display:table; margin-left: auto; margin-right: auto;" class="success"><?php echo $_GET['success']; ?></span>
        <?php }?>
    </div>
    
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
                <li><a href="login.php" class="btn blue"><span>Login</span></a></li>
                <li><a href="register.php" class="btn green"><span>Register</span></a></li>
            </ul>
        </nav>
    </div>
    <!--Body-->
    <section id="login-container">
    <div class="login-text" style="width: 100vw;
                                        height: auto;
                                        position: fixed;
                                        top: 40%;
                                        left: 50%;
                                        transform: translate(-50%, -50%);
                                        z-index: 999;
                                        margin-left: auto;
                                        margin-right: auto;">
            <h1 style="font-size: 40px;">Join Electro to get deals of next-gen Laptop!</h1>
            <br>
            <p>We will take you to the shopping section after logging in.</p>
            <br>
            <br>
            <br>
            <a href="login.php" class="btn bordered" style="width: 200px; height: 60px; font-size: 16px; text-align:center; position: relative;"><span style="position: relative; top: 10px; padding: 0 10px;">JOIN ELECTRO</span></a>
        </div>
    </section>

    <!--Footer-->
    <div class="footer">
        <p>Rythm</p>
    </div>

    <script src="js/input_validate.js"></script>
</body>

</html>