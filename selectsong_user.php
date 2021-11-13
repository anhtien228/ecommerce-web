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
        <link rel="stylesheet" href="css/login.css" />
        <link rel="stylesheet" href="css/contact.css" />
        <link rel="stylesheet" href="css/flex_user.css" />

        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

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
                    <input class="search__input" type="text" placeholder="Search a song"></li>
                    </form>
                </li>
                <li><i style='font-size:17px' class='fas'>&#xf406;</i></li>
                <li><a href="#"><?php echo $_SESSION['name']; ?></a></li>
                <li><a href="logout.php" class="btn blue" onclick="return confirm('Are you sure you want to logout?')" ><span>Logout</span></a></li>
            </ul>
        </nav>
    </div>
        <!--Body-->
        <?php
        include "db_conn.php"; // Using database connection file here
        $id = $_GET['id'];

        $sql = "CALL getSongInfo(?)";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $records = $stmt->get_result(); // fetch data from database
        ?>
        <section id="login-container">
        <div class="login-text">
            <h1 style="font-size: 36px;">Results found</h1>
            <br>
            <!-- <p>To keep on going, you have to keep up the rythm.</p> -->
        </div>
        <div class="wrapper">
            <div class="form" style="width: 500px;">
                <form>
                <?php         
                while($row = mysqli_fetch_assoc($records)) { ?>
                    <div class="flex-mode" style="width: 700px;">
                        <div style="flex-basis: 200px;">
                        <img src="<?php echo $row['picture']?>" width ="150px"; height="150px" style="border: 1px solid black">
                        </div>
                        <div style="flex-basis: 500px;">
                            <a style="text-decoration: none;" href="playsong_user.php?<?php echo 'id='.$id?>">
                            <p style="font-size:20px; font-weight: bold; color: #4285f4"><?php echo $row['songName']; ?>
                            </p></a>

                            <p style="font-size:16px; color: #1d1d1d"><?php echo $row['artistName']; ?></p>
                        </div>
                        <!-- <div>
                            <label class="switch switch-light">
                                <input class="switch-input" type="checkbox" name='user_level'/>
                                <span class="switch-label" data-on="Added" data-off="Add"></span> 
                                <span class="switch-handle"></span> 
                            </label>
                        </div> -->
                    </div>
                <?php } 
                ?> 
                </form>     
            </div>
        </div>
    </section>
        <!--Footer-->
        <div class="footer">
            <p>Copyright &copy;Anh Tien</p>
        </div>

    </html>
