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

    .scrollable-menu {
    max-height: 280px;
    overflow-y: auto;
    }

    
</style>

<?php
include "db_conn.php"; // Using database connection file here

        $not_empty = False;
        $cart_items = [];
        $sum_cart_items = [];
        $user_id = $_SESSION['id'];
        $session_id = $_SESSION['shop_session'];

        $sql = "CALL getCartItems(?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $session_id);
        $stmt->execute();
        $records = $stmt->get_result(); // fetch data from database

        if (mysqli_num_rows($records) > 0) {
            $not_empty = True;
            while ($data = mysqli_fetch_assoc($records)) {
                // Store product information lists in this variable
                $cart_items[] = $data;
            }
        }

        $conn->next_result();
        $sql = "CALL calCartQuantity(?)";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $sum_records = $stmt->get_result();
        $sum_cart_items = mysqli_fetch_assoc($sum_records);
        $_SESSION['cart_quantity'] = $sum_cart_items['cart_quantity'];
        $_SESSION['total_amount'] = $sum_cart_items['total'];
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
    <div class="container-fluid">
        <!--Logo-->
        <a class="navbar-brand" href="user_index?id=<?php echo $_SESSION['id'] ?>"><img class="d-inline-block align-top" src="./img/electro.png" alt="electro_shop_laptop" width="180"></a>
        <!--Toggle button for responsive design-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!--Menu (Home, Product, About)-->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="user_index?id=<?php echo $_SESSION['id'] ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_index?id=<?php echo $_SESSION['id'] ?>">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php?id=<?php echo $_SESSION['id'] ?>">About</a>
                </li>
            </ul>
            <div class="mx-auto">
                <form action="libs/search_product.php" method="post">
                    <input style="width: 20vw;" type="text" class="search__input" type="text" name="product_name" placeholder="Search a product">
                </form>
            </div>
            <ul class="navbar-nav ms-auto">
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
                        <div class="dropdown-menu dropdown-menu-lg-end animate slideIn shopping-cart" role="menu" aria-labelledby="dropdownMenuButton">
                            <div class="shopping-cart-header">
                                <span class="your-cart">Your cart</span>
                                <div class="shopping-cart-total">
                                    <span class="lighter-text">Total</span>
                                    <span class="main-color-text">$<?php echo $_SESSION['total_amount']; ?></span>
                                </div>
                            </div>
                            <div class="scrollable-menu">
                            <?php
                            if($not_empty) {
                                foreach ($cart_items as $item) { ?>
                                    <ul class="shopping-cart-items">
                                        <li class="clearfix">
                                            <img src="<?php echo $item['productPhoto'];?>" alt="<?php echo $row['productName'];?>" />
                                            <span class="item-name"><?php echo $item['productName'];?></span>
                                            <span class="item-price">$<?php echo $item['productPrice'];?></span>
                                            <span class="item-quantity">Qty: 01</span>
                                            <form method='POST' style="display: none;" action="libs/product/remove_cart.php">
                                            <input type="hidden" name='pprice' class="pprice" value="<?php echo $item['productPrice']; ?>">
                                            <input type="hidden" name='psku' class="psku" value="<?php echo $item['productSKU']; ?>">
                                            <input type="hidden" name='pid' class="pid" value="<?php echo $item['pid']; ?>">
                                            <input type="submit" id="remove-cart" class="hidden"></button>
                                            </form>
                                            <label for="remove-cart" class="remove-item"><span>Remove</span></label>
                                        </li>
                                    </ul>
                            <?php }
                            }
                            else {?>
                                    <ul class="shopping-cart-items">
                                    <li class="clearfix">
                                        <span class="item-name">No items in cart</span>
                                    </li>
                                </ul>
                            <?php }?>
                            </div>
                            <a href="#" class="checkout-button">Checkout</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a id="logout-button" href="libs/auth/logout_processing.php" style="margin-left: 1rem;" class="btn-custom bordered" onclick="return confirm('Are you sure you want to logout?')"><span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>