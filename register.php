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
    <link rel="stylesheet" href="css/util.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/57448d1974.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/input_validate.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
            <h1 style="font-size: 30px;">Register</h1>
            <p>Be a member to get good recommendations!</p>
        </div>
        <div class="wrapper">
            <div class="form">
                    <!-- USER REGISTER -->
                    <div id="user_register">
                    <form method="post" action="libs/auth/register_processing.php" id="user" onsubmit="return register_validation();">
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
    <footer class="text-muted">
    <div id="copyright" class="text-center p-2 fixed-bottom" style ="font-size: 14px;
                                                                    background-color: #3F4C5C;
                                                                    margin-top: 1rem;
                                                                    color: white;">
    © 2020 Copyright: <b>Electro., Corp</b>
    </div>
    </footer>
</body>

</html>