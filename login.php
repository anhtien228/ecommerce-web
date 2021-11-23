<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="format-detection" content="telephone=no">
    <title>Electro</title>
    <!--reset css-->
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/util.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/57448d1974.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

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
    <!--Navbar-->
    <?php
    if (!isset($_SESSION["user_name"]))
        include "libs/nav_guest.php"; // Using navbar file here
    ?>

    <!--Body-->
    <section id="login-container">
        <div class="login-text">
            <h1 style="font-size: 30px;">Login</h1>
            <p>Join Electro to buy the latest products!</p>
        </div>
        <div class="wrapper">
            <div class="form">
                <form method="post" action="libs/auth/login_processing.php" onsubmit="return login_validation();">
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
    <footer class="text-muted">
    <div id="copyright" class="text-center p-2 fixed-bottom" style ="font-size: 14px;
                                                                    background-color: #3F4C5C;
                                                                    margin-top: 1rem;
                                                                    color: white;">
    © 2020 Copyright: <b>Electro., Corp</b>
    </div>
    </footer>

    <script src="js/input_validate.js"></script>
</body>

</html>