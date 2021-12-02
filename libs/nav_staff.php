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
        <a class="navbar-brand" href="staff_index.php"><img class="d-inline-block align-top" src="./img/electro.png" alt="electro_shop_laptop" width="180"></a>
        <!--Toggle button for responsive design-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!--Menu (Home, Product, About)-->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user"></i>
                        <?php echo $_SESSION['name']; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="logout-button" href="libs/auth/logout_processing.php" style="margin-left: 1rem;" class="btn-custom bordered" onclick="return confirm('Are you sure you want to logout?')"><span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>