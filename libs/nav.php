<!--Navigation bar-->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
    <div class="container-fluid">
        <!--Logo-->
        <a class="navbar-brand" href="user_index.php?id=<?php echo $_SESSION['id'] ?>"><img src="./img/rythm.png"
                                                                                            alt="" width="200"
            ></a>
        <!--Toggle button for responsive design-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!--Menu (Home, Product, About)-->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
            <!--User action-->
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
        </div>
    </div>
</nav>