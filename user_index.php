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

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <!--reset css-->
        <link rel="stylesheet" href="css/product.css"/>
        <link rel="stylesheet" href="css/flex_user.css"/>
        <link rel="stylesheet" href="css/items.css"/>

        <script src="https://kit.fontawesome.com/57448d1974.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/cart.js"></script> <!-- Modernizr -->
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
                    <!--Logo-->
                    <li>
                        <a href="user_index.php?id=<?php echo $_SESSION['id']?>"><img src="./img/rythm.png" width=250px; height=90px; /></a>
                    </li>
                    <!--Menu-->
                    <li>
                        <a href="user_index.php?id=<?php echo $_SESSION['id']?>">Home</a>
                        <a href="user_index.php?id=<?php echo $_SESSION['id']?>">Product</a>
                        <!-- <li><form action="searchsong.php" id="search_song" method="post">
                            <input type="text" class="search__input" type="text" name="song_name" placeholder="Search a product"></form>
                        </li> -->
                        <a href="about.php?id=<?php echo $_SESSION['id']?>">About</a>
                    </li>
                    <!--User action-->
                    <li>
                    <a style='font-size: 1rem; align-self:center;'><i class="fas fa-user"></i></a>
                    <a href="#"><?php echo $_SESSION['name']; ?></a>
                    <a id="cart-span" style='font-size: 1.2rem; align-self:center; margin-left: 1.5rem;'>
                        <div>
                        <i class="fas fa-shopping-bag"></i>
                        <i style='font-size: 1rem; align-self:center; font-style: normal;'><?php echo $_SESSION['cart_quantity']; ?></i>
                        </div>
                    </a>
                    <a href="logout.php" style="margin-left: 2.5rem;" class="btn bordered" onclick="return confirm('Are you sure you want to logout?')" ><span>Logout</span></a>
                    </li>
                </ul>
            </nav>
            <div class="container">
                <div class="shopping-cart">
                    <div class="shopping-cart-header">
                        <span class="your-cart">Your cart</span>
                        <div class="shopping-cart-total">
                            <span class="lighter-text">Total</span>
                            <span class="main-color-text">$<?php echo $_SESSION['total_amount']; ?></span>
                        </div>
                    </div> <!--end shopping-cart-header -->

                    <ul class="shopping-cart-items">
                    <li class="clearfix">
                        <img src="img/product/asus_rog.jpg" alt="item1" />
                        <span class="item-name">Asus ROG Strix 15</span>
                        <span class="item-price">$896</span>
                        <span class="item-quantity">Quantity: 01</span>
                    </li>

                    <a href="#" class="checkout-button">Checkout</a>
                </div> <!--end shopping-cart -->
            </div> <!--end container -->
        </div>
        <!--Body-->
        <section id="main-page">
         <div class="content-bg">
             <div class="content-text">
                    <h2>Product List</h2>
                    <p>Latest models of laptop by different brands</p>
             </div>
         </div>
        </section>
        <section>
        <div class="product-section">
            <input class="radio" id="one" name="group" type="radio" checked>
            <input class="radio" id="two" name="group" type="radio">
            <input class="radio" id="three" name="group" type="radio">
            <input class="radio" id="four" name="group" type="radio">
            <input class="radio" id="five" name="group" type="radio">
            <input class="radio" id="six" name="group" type="radio">

            <div class="tabs">
                <label class="tab" id="one-tab" for="one">Asus</label>
                <label class="tab" id="two-tab" for="two">Acer</label>
                <label class="tab" id="three-tab" for="three">Lenovo</label>
                <label class="tab" id="four-tab" for="four">Dell</label>
                <label class="tab" id="five-tab" for="five">HP</label>
                <label class="tab" id="six-tab" for="six">Apple</label>
                <div id="search-bar"><form action="searchsong.php" method="post">
                    <input type="text" class="search__input" type="text" name="song_name" placeholder="Search a product">
                </form>
                </div>
            </div>
        <div class="grid-brand">
            <div class="grid-container" id="asus">
                <?php   
                foreach($asus as $row) { ?>
                <div class="grid-item">
                    <div id="img-wrapper"><img src='<?php echo $row['productPhoto'];?>'/></div>
                    <h1 id="product-name"><?php echo $row['productName'];?></h1>
                    <p style="font-size: 12px;">SKU: <?php echo $row['productSKU'];?></p>
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
                    <p style="font-size: 12px;">SKU: <?php echo $row['productSKU'];?></p>
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
                    <p style="font-size: 12px;">SKU: <?php echo $row['productSKU'];?></p>
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
            <div class="grid-container" id="dell">
                <?php   
                foreach($dell as $row) { ?>
                <div class="grid-item">
                    <div id="img-wrapper"><img src='<?php echo $row['productPhoto'];?>'/></div>
                    <h1 id="product-name"><?php echo $row['productName'];?></h1>
                    <p style="font-size: 12px;">SKU: <?php echo $row['productSKU'];?></p>
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
            <div class="grid-container" id="hp">
                <?php   
                foreach($hp as $row) { ?>
                <div class="grid-item">
                    <div id="img-wrapper"><img src='<?php echo $row['productPhoto'];?>'/></div>
                    <h1 id="product-name"><?php echo $row['productName'];?></h1>
                    <p style="font-size: 12px;">SKU: <?php echo $row['productSKU'];?></p>
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
            <div class="grid-container" id="apple">
                <?php   
                foreach($apple as $row) { ?>
                <div class="grid-item">
                    <div id="img-wrapper"><img src='<?php echo $row['productPhoto'];?>'/></div>
                    <h1 id="product-name"><?php echo $row['productName'];?></h1>
                    <p style="font-size: 12px;">SKU: <?php echo $row['productSKU'];?></p>
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

        <?php
        include "libs/footer.php"; // Using footer file here
        ?>
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
    </html>
