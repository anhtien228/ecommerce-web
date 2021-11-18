<!--Navigation bar-->
<style>
    .nav-link {
        font-family: 'Gilroy Medium';
        color: #1d1d1d !important;
    }

    .nav-link:hover {
        color: #4285f4 !important;
    }

    #logout-button {
        font-family: 'Gilroy Medium';
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
    <div class="container-fluid">
        <!--Logo-->
        <a class="navbar-brand" href="user_index.php?id=<?php echo $_SESSION['id'] ?>"><img class="d-inline-block align-top" src="./img/rythm.png" alt="" width="180"></a>
        <!--Toggle button for responsive design-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!--Menu (Home, Product, About)-->
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="user_index.php?id=<?php echo $_SESSION['id'] ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_index.php?id=<?php echo $_SESSION['id'] ?>">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php?id=<?php echo $_SESSION['id'] ?>">About</a>
                </li>
            </ul>
            <div class="navbar-nav mx-auto">
                <form action="search_product.php" method="post">
                    <input style="width: 20vw;" type="text" class="search__input" type="text" name="product_name" placeholder="Search a product">
                </form>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user"></i>
                        <?php echo $_SESSION['name']; ?>
                    </a>
                </li>
                <li class="nav-item" style="margin-right: 2rem;">
                    <div class="dropdown show">
                        <a class="nav-link dropdown-toggle" role="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-shopping-bag"></i>
                            <i style='font-size: 1rem; align-self:center; font-style: normal;'><?php echo $_SESSION['cart_quantity']; ?></i>
                        </a>
                        <div class="dropdown-menu shopping-cart" role="menu" aria-labelledby="dropdownMenuButton">
                                <div class="shopping-cart-header">
                                    <span class="your-cart">Your cart</span>
                                    <div class="shopping-cart-total">
                                        <span class="lighter-text">Total</span>
                                        <span class="main-color-text">$<?php echo $_SESSION['total_amount']; ?></span>
                                    </div>
                                </div>

                                <ul class="shopping-cart-items">
                                    <li class="clearfix">
                                        <img src="img/product/asus_rog.jpg" alt="item1" />
                                        <span class="item-name">Asus ROG Strix 15</span>
                                        <span class="item-price">$896</span>
                                        <span class="item-quantity">Quantity: 01</span>
                                    </li>
                                </ul>

                                <a href="#" class="checkout-button">Checkout</a>
                            </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a id="logout-button" href="logout.php" style="margin-left: 1rem;" class="btn bordered" onclick="return confirm('Are you sure you want to logout?')"><span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>