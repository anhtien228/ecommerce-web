
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
        <!-- Bootstrap CSS -->
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
			integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
			crossorigin="anonymous"
		/>
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
			integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		/>

        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    </head>
    <body>
        <!--Navigation bar-->
        <div class="menu">
        <nav class="flex-container">
            <ul>
                <li><a href="index.php"><img src="./img/rythm.png" width=250px; height=90px; /></a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Playlist</a></li>
                <li>
                <form action="searchsong.php" id="search_song" method="post">
                    <input type="text" class="search__input" type="text" name="song_name" placeholder="Search a song">
                </form>
                </li>
                <li><a href="login.php" class="btn blue"><span>Login</span></a></li>
                <li><a href="register.php" class="btn green"><span>Register</span></a></li>
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
        $row = mysqli_fetch_assoc($records)
        ?>
        <section id="login-container">
        <!-- <div class="login-text">
            <h1 style="font-size: 36px;">Results found</h1>
            <br>
            <p>To keep on going, you have to keep up the rythm.</p>
        </div> -->
        <div class="wrapper" style="margin-top: 140px;"> 
        <div class="container">
			<div class="">
				<div class="row justify-content-between">
					<h3 class="" id="song_title"><b><?php echo $row['songName']?></b></h3>
					<p class=""><i class="fa fa-headphones" aria-hidden="true"></i> View: <span id="view">999</span></p>
				</div><br>
				<div class="row">
                    <?php if($id == 1) {?>
					<audio class="col-12" src="./Audio/Gotye - Somebody That I Used To Know.mp3" controls id="song_audio"></audio>
                    <?php }
                    else if($id == 2) {?>
					<audio class="col-12" src="./Audio/Yesterday Once More - The Carpenters.mp3" controls id="song_audio"></audio>
                    <?php }
                    else if($id == 3) {?>
					<audio class="col-12" src="./Audio/Mascara - Chillies x BLAZE.mp3" controls id="song_audio"></audio>
                    <?php }?>
                </div><br>
				<div class="row">
					<p class="col-12">Artist: <span><b><?php echo $row['artistName']?><b></span></p>
                    <img src="<?php echo $row['picture']?>" width ="150px"; height="150px" style="border: 1px solid black; margin-left: 10px;">
				</div><br>
				<div>
					<p><b>Lyric of <span class="song"><?php echo $row['songName']?></span> </b></p>
					<div style="height: 300px; overflow-y: scroll; border: #e3e3e3 solid 1px" class="p-2" id="lyric">
                        <p style="font-weight: normal;"><?php echo $row['lyric']?></p>
					</div>
				</div>
			</div>
		</div>
        </div>
        		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script
			src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
			integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
			crossorigin="anonymous"
		></script>
		<script
			src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
			integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
			crossorigin="anonymous"
		></script>
    </section>
        <!--Footer-->
        <div class="footer">
            <p>Rythm</p>
        </div>

    </html>
