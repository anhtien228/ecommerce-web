<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="format-detection" content="telephone=no">
    <title>Electro</title>
    <!--reset css-->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="css/flex.css" />

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
                    <a href="about2.php">About</a>
                </li>
                <!--User action-->
                <li>
                    <a href="login.php" class="btn blue"><span>Login</span></a>
                    <a href="register.php" class="btn green"><span>Register</span></a>
                </li>
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
    <script src="js/input_validate.js"></script>
</body>

</html>