<style>
    .p-3 {
        transition: box-shadow 0.5s;
    }

    .p-3:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .btn:hover {
        color: #1d1d1d;
    }

    .card {
        font-family: 'Gilroy Regular';
    }

    .card .card-title {
        font-family: 'Gilroy Bold';
    }

    #product-price {
        font-family: 'Gilroy Bold';
        font-size: 32px;
    }

    #footer-price {
        vertical-align: center;
    }

    .card-img-top {
        width: 100%;
        object-fit: scale-down;
    }

    .alert {
        font-family: 'Gilroy Regular';
        margin: auto;
        text-align: center;
    }
</style>
<div class="bg-light px-3 px-lg-5 py-4 py-lg-5">
    <div class="container">
        <?php
        include "libs/form_categorize_product.php";
        ?>

        <!--Product list-->
        <div class="row mt-5">
            <!--Get product data-->
            <?php

            $product_data = [];

            if (isset($_GET['submit_filter'])) {
                if ($_GET['brand'] == 'all' & $_GET['os'] == 'all' & $_GET['cpu'] == 'all' & $_GET['ram'] == 'all'
                & $_GET['storage'] == 'all' & $_GET['min-price'] == '' & $_GET['max-price'] == '') {
                    $records = $db->getAllProducts(); // fetch all products
                } else {
                    $product_name = '';
                    $brand = ($_GET['brand'] == 'all') ? '' : $_GET['brand'];
                    $os = ($_GET['os'] == 'all') ? '' : $_GET['os'];
                    $cpu = ($_GET['cpu'] == 'all') ? '' : $_GET['cpu'];
                    $ram = ($_GET['ram'] == 'all') ? '' : $_GET['ram'];
                    $storage = ($_GET['storage'] == 'all') ? '' : $_GET['storage'];
                    $min_price = ($_GET['min-price'] == '') ? '' : (int)$_GET['min-price'];
                    $max_price = ($_GET['max-price'] == '') ? '' : (int)$_GET['max-price'];

                    $records = $db->getFilteredProducts($product_name, $brand, $os, $cpu, $ram, $storage, $min_price, $max_price); // fetch filtered products
                }
            }

            else {
                $records = $db->getAllProducts(); // fetch all products
            }

            if (mysqli_num_rows($records) > 0) {
                while ($data = mysqli_fetch_assoc($records)) {
                    // Store product information lists in this variable
                    $product_data[] = $data;
                }
                foreach ($product_data as $row) { ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4 animate slideIn">
                        <div class="card shadow-sm bg-white rounded">
                            <div class="p-3">
                                <!--Product information (Image, SKU, CPU, RAM, GPU, Storage, Price-->
                                <?php $word = "https://encrypted-tbn0.gstatic.com";
                                    if(strpos($row['productPhoto'], $word) !== false) {?>
                                <img src='<?php echo $row['productPhoto']; ?>' class="card-img-top" alt="<?php echo $row['productName']; ?>">
                                <?php }
                                    else { ?>
                                <img src='<?php echo $row['productPhoto']; ?>' class="card-img-top" alt="<?php echo $row['productName']; ?>">
                                <?php }?>
                                <div class="card-body">
                                    <h3 id="pname" class="card-title"><?php echo $row['productName']; ?></h3>
                                    <p>SKU: <?php echo $row['productSKU']; ?></p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">CPU: <?php echo $row['productCPU']; ?></li>
                                    <li class="list-group-item">RAM: <?php echo $row['productRAM']; ?></li>
                                    <li class="list-group-item">GPU: <?php echo $row['productGPU']; ?></li>
                                    <li class="list-group-item">Storage: <?php echo $row['productSto']; ?></li>
                                </ul>
                                <div class="card-body" id="footer-price">
                                    <h3><label id="product-price"
                                               style="float:left;">$<?php echo $row['productPrice']; ?></label></h3>
                                    <form method='POST' action="libs/product/add_cart.php">
                                        <input type="hidden" name='pprice' class="pprice"
                                               value="<?php echo $row['productPrice']; ?>">
                                        <input type="hidden" name='psku' class="psku"
                                               value="<?php echo $row['productSKU']; ?>">
                                        <input type="hidden" name='pid' class="pid" value="<?php echo $row['pid']; ?>">
                                        <button type='submit' class="btn-custom" style="float:right;">
                                            <span>Add to cart</span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="alert alert-dark col-md-2" role="alert">
                    No products found!
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>