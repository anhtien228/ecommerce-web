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
        <a class="navbar-brand" href="index.php"><img class="d-inline-block align-top" src="./img/electro.png" alt="electro_shop_laptop" width="180"></a>
        <!--Toggle button for responsive design-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!--Menu (Home, Product, About)-->
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
            </ul>
            <div class="navbar-nav mx-auto">
                <form action="libs/search_product.php" method="post">
                    <input style="width: 20vw;" type="text" class="search__input" type="text" name="product_name" placeholder="Search a product">
                </form>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a id="logout-button" href="login.php" style="margin-left: 1rem;" class="btn-custom blue"><span>Login</span></a>
                </li>
                <li class="nav-item">
                    <a id="logout-button" href="register.php" style="margin-left: 1rem;" class="btn-custom yellow"><span>Register</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>