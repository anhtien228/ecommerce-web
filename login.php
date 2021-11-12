<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="format-detection" content="telephone=no">
    <title>Rythm</title>
    <!--reset css-->
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/contact.css" />
    <link rel="stylesheet" href="css/flex.css" />

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
        <div class="login-text">
            <h1 style="font-size: 30px;">Join Electro to get deals of next-gen Laptop!</h1>
            <br>
            <p>We will take you to the shopping section after logging in.</p>
        </div>
        <div class="wrapper">
            <div class="form">
                <form method="post" action="login_processing.php" onsubmit="return login_validation();">
                    <div class="flex-mode">
                        <div><p style="font-size:14px;">Are you a staff or a user?</p></div>
                        <div>
                            <label class="switch switch-light">
                                <input class="switch-input" type="checkbox" name='user_level'/>
                                <span class="switch-label" data-on="Staff" data-off="User"></span> 
                                <span class="switch-handle"></span> 
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="input_wrap">
                        <label for="input_username">Username (email)</label>
                        <div class="input_field">
                            <input type="text" class="input" id="input_username" name="user_name" pattern="[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*"/>
                            <!-- <input type="text" class="input" id="input_username" name="user_name"/> -->
                        </div>
                    </div>
                    <div class="input_wrap">
                        <label for="input_password">Password</label>
                        <div class="input_field">
                            <!-- <input type="password" class="input" id="input_password" name="password" minlength="8" required /> -->
                            <input type="password" class="input" id="input_password" name="password"/>
                        </div>
                    </div>
                    <div class="input_wrap">
                        <span class="error_msg">Username must has at least 5 characters<br>Password must has a least 8 characters!</span>
                        <input type="submit" id="login_btn" class="btn disabled" value="Login" disabled="true">
                    </div>
                    <div class="input_wrap">
                        <div id="reg_btn" class="regbtn">
                            <p>Register</p>
                            <a href="register.php" class="link"></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!--Footer-->
    <div class="footer-login">
        <p>Rythm</p>
    </div>

    <script src="js/input_validate.js"></script>
</body>

</html>