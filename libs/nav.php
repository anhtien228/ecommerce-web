<!--Navigation bar-->
<div class="menu">
    <nav class="flex-container">
        <ul>
            <!--Logo-->
            <li>
                <a href="user_index.php?id=<?php echo $_SESSION['id'] ?>"><img src="./img/rythm.png" width=250px;
                                                                               height=90px;/></a>
            </li>
            <!--Menu-->
            <li>
                <a href="user_index.php?id=<?php echo $_SESSION['id'] ?>">Home</a>
                <a href="user_index.php?id=<?php echo $_SESSION['id'] ?>">Product</a>
                <!-- <li><form action="searchsong.php" id="search_song" method="post">
                    <input type="text" class="search__input" type="text" name="song_name" placeholder="Search a product"></form>
                </li> -->
                <a href="about.php?id=<?php echo $_SESSION['id'] ?>">About</a>
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
                <a href="logout.php" style="margin-left: 2.5rem;" class="btn bordered"
                   onclick="return confirm('Are you sure you want to logout?')"><span>Logout</span></a>
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
                    <img src="img/product/asus_rog.jpg" alt="item1"/>
                    <span class="item-name">Asus ROG Strix 15</span>
                    <span class="item-price">$896</span>
                    <span class="item-quantity">Quantity: 01</span>
                </li>

                <a href="#" class="checkout-button">Checkout</a>
        </div> <!--end shopping-cart -->
    </div> <!--end container -->
</div>