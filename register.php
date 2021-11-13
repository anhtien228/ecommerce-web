<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="format-detection" content="telephone=no">
    <title>Electro</title>
    <!--reset css-->
    <link rel="stylesheet" href="css/register.css" />
    <link rel="stylesheet" href="css/contact.css" />
    <link rel="stylesheet" href="css/flex.css" />

</head>

<script src="js/input_validate.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
                    <a href="login.php" class="btn blue"><span>Login</span></a>
                    <a href="register.php" class="btn green" style="color: #fff;"><span>Register</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <!--Body-->
    <section id="login-container">
        <div class="login-text">
            <h1 style="font-size: 48px;">Be a member</h1>
            <br>
            <p>Get tons of deals and benefits from Electro membership.</p>
        </div>
        <div class="wrapper">
            <div class="form">
                    <br>
                    <br>
                    <!-- USER REGISTER -->
                    <div id="user_register">
                    <form method="post" action="register_processing.php" id="user" onsubmit="return register_validation();">
                        <div class="input_wrap">
                            <label for="input_firstname">First name</label>
                            <div class="input_field">
                                <input type="text" class="input" id="input_firstname" name="first_name" placeholder="Enter your first name" pattern="[a-zA-Z]+"/>
                                <!-- <input type="text" class="input" id="input_username" name="user_name"/> -->
                            </div>
                        </div>
                        <div class="input_wrap">
                            <label for="input_lastname">Last name</label>
                            <div class="input_field">
                                <input type="text" class="input" id="input_lastname" name="last_name" placeholder="Enter your last name" pattern="[a-zA-Z]+"/>
                                <!-- <input type="text" class="input" id="input_username" name="user_name"/> -->
                            </div>
                        </div>

                        <div class="input_wrap">
                            <label for="input_dob">Date of Birth</label>
                            <div class="input_field">
                                <input autocomplete="off" class="dob" id="input_dob" name="dob" placeholder="DD-MM-YYYY" type="date" min="1950-01-01" max="2016-01-01" spellcheck="false" value="2003-01-01">
                            </div>
                        </div>

                        <div class="input_wrap">
                            <label for="input_username">Username</label>
                            <div class="input_field">
                                <input type="text" class="input" id="input_username_user" name="user_name_user" placeholder="Enter a username" pattern="[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*"/>
                                <!-- <input type="text" class="input" id="input_username" name="user_name"/> -->
                            </div>
                        </div>
                        <div class="input_wrap">
                            <label for="input_password">Password</label>
                            <div class="input_field">
                                <input type="password" class="input" id="input_password_user" name="password_user" placeholder="Enter a password"/>
                                <!-- <input type="password" class="input" id="input_password" name="password"/> -->
                            </div>
                        </div>
                        <div class="input_wrap">
                            <span class="error_name">Full name is invalid!</span>
                            <span class="error_username">Username must has at least 5 characters</span>
                            <span class="error_password">Password must has a least 8 characters!</span>
                            <input type="submit" id="login_btn" name="User" class="btn enabled" value="Register" form="user">
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

</body>

</html>