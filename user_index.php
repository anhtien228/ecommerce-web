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
        <title>Rythm</title>
        <!--reset css-->
        <link rel="stylesheet" href="css/product.css"/>
        <link rel="stylesheet" href="css/flex_user.css"/>
        <link rel="stylesheet" href="css/items.css"/>

        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <!-- <script src="js/vendor/modernizr-3.11.2.min.js"></script> -->

    </head>
    <body>
        <?php
        include "db_conn.php"; // Using database connection file here

        $sql = "CALL getLaptopProducts";
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        $records = $stmt->get_result(); // fetch data from database
        while($data = mysqli_fetch_assoc($records)) {
            if ($data['productBrand'] == 'Asus') {
                $asus[] = $data;
            }
            else if ($data['productBrand'] == 'Acer') {
                $acer[] = $data;
            }
            else if ($data['productBrand'] == 'Lenovo') {
                $lenovo[] = $data;
            }
            else if ($data['productBrand'] == 'Dell') {
                $dell[] = $data;
            }
            else if ($data['productBrand'] == 'Apple') {
                $apple[] = $data;
            }
            else if ($data['productBrand'] == 'HP') {
                $hp[] = $data;
            }
        }
        ?>
        <!--Navigation bar-->
        <div class="menu">
        <nav class="flex-container">
            <ul>
                <li><a href="index.php"><h1 style="font-size: 46px; margin-left: 5rem;">Electro</h1></a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Product</a>
                    <ul>
                        <li><a href="index.php">Asus</a></li>
                        <li><a href="index.php">Lenovo</a></li>
                    </ul>
                </li>
                <li>
                <form action="searchsong.php" id="search_song" method="post">
                    <input type="text" class="search__input" type="text" name="song_name" placeholder="Search a product">
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
                    <h2>Product List</h2>
                    <br>
                    <br>
                    <p>Latest models of laptop by different brands</p>
             </div>
         </div>
        </section>
        <section>
        <div class="product-section">
            <input class="radio" id="one" name="group" type="radio" checked>
            <input class="radio" id="two" name="group" type="radio">
            <input class="radio" id="three" name="group" type="radio">

            <div class="tabs">
                <label class="tab" id="one-tab" for="one">Asus</label>
                <label class="tab" id="two-tab" for="two">Acer</label>
                <label class="tab" id="three-tab" for="three">Lenovo</label>
                <label class="tab" id="four-tab" for="three">Dell</label>
                <label class="tab" id="five-tab" for="three">HP</label>
                <label class="tab" id="six-tab" for="three">Apple</label>
            </div>
        <div class="grid-brand">
            <div class="grid-container" id="asus">
                <?php   
                foreach($asus as $row) { ?>
                <div class="grid-item">
                    <div id="img-wrapper"><img src='<?php echo $row['productPhoto'];?>'/></div>
                    <h1 id="product-name"><?php echo $row['productName'];?></h1>
                    <p id="product-specs">
                        CPU: <?php echo $row['productCPU'];?><br>
                        RAM: <?php echo $row['productRAM'];?><br>
                        GPU: <?php echo $row['productGPU'];?><br>
                        Storage: <?php echo $row['productSto'];?>
                    </p>
                    <div class="product-action">
                        <div><label id="product-price">$<?php echo $row['productPrice'];?></label></div>
                        <div><button>Add to cart</button></div>
                    </div>
                </div>
                <?php } 
                ?> 
            </div>
            <div class="grid-container" id="acer">
                <?php   
                foreach($acer as $row) { ?>
                <div class="grid-item">
                    <div id="img-wrapper"><img src='<?php echo $row['productPhoto'];?>'/></div>
                    <h1 id="product-name"><?php echo $row['productName'];?></h1>
                    <p id="product-specs">
                        CPU: <?php echo $row['productCPU'];?><br>
                        RAM: <?php echo $row['productRAM'];?><br>
                        GPU: <?php echo $row['productGPU'];?><br>
                        Storage: <?php echo $row['productSto'];?>
                    </p>
                    <div class="product-action">
                        <div><label id="product-price">$<?php echo $row['productPrice'];?></label></div>
                        <div><button>Add to cart</button></div>
                    </div>
                </div>
                <?php } 
                ?> 
            </div>
            <div class="grid-container" id="lenovo">
                <?php   
                foreach($lenovo as $row) { ?>
                <div class="grid-item">
                    <div id="img-wrapper"><img src='<?php echo $row['productPhoto'];?>'/></div>
                    <h1 id="product-name"><?php echo $row['productName'];?></h1>
                    <p id="product-specs">
                        CPU: <?php echo $row['productCPU'];?><br>
                        RAM: <?php echo $row['productRAM'];?><br>
                        GPU: <?php echo $row['productGPU'];?><br>
                        Storage: <?php echo $row['productSto'];?>
                    </p>
                    <div class="product-action">
                        <div><label id="product-price">$<?php echo $row['productPrice'];?></label></div>
                        <div><button>Add to cart</button></div>
                    </div>
                </div>
                <?php } 
                ?> 
            </div>
        </div>
        </div>
        </section>

        <!--Footer-->
        <div class="footer">
            <p>Electro</p>
        </div>

    </html>
