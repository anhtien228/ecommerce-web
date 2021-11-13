<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="format-detection" content="telephone=no">
    <title>Electro</title>
    <!--reset css-->
    <link rel="stylesheet" href="css/product.css"/>
    <link rel="stylesheet" href="css/flex.css" />


  </head>
  <body>
    <!--Navigation bar-->
    <div class="menu">
        <nav class="flex-container">
            <ul>
            <li><a href="http://localhost/index.php?page=index"><img src="./img/rythm.png" width=250px; height=90px; /></a></li>
                <li><a href="http://localhost/index.php?page=index">Home</a></li>
                <li><a href="#">Travel</a>
                    <ul>
                        <li><a href="http://localhost/domestic.php?page=domestic">Trong nước</a></li>
                        <li><a href="http://localhost/domestic.php?page=domestic">Ngoài nước</a></li> <!--Foreignal travel services TBU-->
                    </ul>
                </li>
                <li><a href="#">Accommodations</a></li>
                <li><a href="#">Things to Do</a></li>
                <li><a href="http://localhost/contact.php?page=contact">Contacts</a></li>
                <li><a href="http://localhost/login.php?page=login" class="btn blue"><span>Login</span></a></li>
                <li style ="flex-basis: 60px"><a href="https://www.facebook.com/biztechtalk.oisp" target="_blank"><img src="./img/facebook.png" width = 15px; height = 15px;></a></li>
                <li style ="flex-basis: 60px"><a href="https://www.instagram.com/meomaykurooo" target="_blank"><img src="./img/instagram.png" width = 15px; height = 15px;></a></li>
                <li style ="flex-basis: 60px"><a href="https://twitter.com/binto123" target="_blank"><img src="./img/twitter.png" width = 15px; height = 15px;></a></li>

            </ul>
        </nav>
     </div>
     <!--Body-->
     <section id="main-page">
         <div class="content-bg">
             <div class="content-text">
                    <h1>Du lịch nội địa</h1>
                    <br>
                    <br>
                    <p>Thưởng thức những khung cảnh đầy mộng mơ đến từ các địa điểm du lịch Việt Nam</p>
             </div>
         </div>
     </section>
     <?php
    include "db_conn.php"; // Using database connection file here
    $products = array();
    $sql = "SELECT * FROM products";
    $records = mysqli_query($conn, $sql); // fetch data from database
    while($row = mysqli_fetch_assoc($records))
        $products[] = $row;;
    ?>
     <section id="tour-content">
        <div class="tour-domestic">
            <div class="tour1">
                <img src="./img/dalat.jpg" width ="500px"; height="300px" style="border: 1px solid white">
                <h2><?php echo $products[0]['product_name']; ?></h2>
                <h3><?php echo number_format($products[0]['price'], 0, '.', '.'); ?></h3>
                <h4>(3 ngày 2 đêm)</h4>
                <br>
                <p>Chuyến du lịch "chill" xuyên Đà Lạt với những địa điểm như: Đồi chè, Mê Linh Garden, Quảng trường Lâm Viên, ...</p>
                <br>
                <p>Nơi khởi hành: Thành Phố Hồ Chí Minh</p>
            </div>
            <div class="tour2">
                <img src="./img/nhatrang.jpg" width ="500px"; height="300px" style="border: 1px solid white">
                <h2><?php echo $products[1]['product_name']; ?></h2>
                <h3><?php echo number_format($products[1]['price'], 0, '.', '.'); ?></h3>
                <h4>(4 ngày 3 đêm)</h4>
                <br>
                <p>Trải nghiệm khách sạn 5 sao với đầy đủ tiện nghi và hứa hẹn sẽ là kỳ nghỉ thư giãn nhất mà bạn từng có</p>
                <br>
                <p>Nơi khởi hành: Thành Phố Hồ Chí Minh</p>
            </div>

            <div class="tour-break">
                <img src="./img/rythm.png"/>
            </div>
            
            <div class="tour3">
                <img src="./img/halong.jpg" width ="500px"; height="300px" style="border: 1px solid white">
                <h2><?php echo $products[2]['product_name']; ?></h2>
                <h3><?php echo number_format($products[2]['price'], 0, '.', '.'); ?></h3>
                <h4>(3 ngày 2 đêm)</h4>
                <br>
                <p>Kỳ nghỉ đẳng cấp tại vịnh Hạ Long - một trong những kỳ quan của thế giới và là hòn ngọc quý của Việt Nam</p>
                <br>
                <p>Nơi khởi hành: Thành Phố Hồ Chí Minh</p>
            </div>
            <div class="tour4">
                <img src="./img/hoian.jpg" width ="500px"; height="300px" style="border: 1px solid white">
                <h2><?php echo $products[3]['product_name']; ?></h2>
                <h3><?php echo number_format($products[3]['price'], 0, '.', '.'); ?></h3>
                <h4>(4 ngày 3 đêm)</h4>
                <br>
                <p>Chìm đắm vào sự nhộn nhịp về đêm và vẻ đẹp hoài cổ của khu phố Hội An</p>
                <br>
                <p>Nơi khởi hành: Thành Phố Hồ Chí Minh</p>
            </div>
        </div>
     </section>

     <!--Footer-->
     <div class="footer">
        <p>Copyright &copy;Anh Tien</p>
    </div>

    </body>
</html>

