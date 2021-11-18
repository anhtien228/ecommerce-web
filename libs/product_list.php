<div class="bg-light px-lg-5 py-5">
    <div class="container">
        <!--Form-->
        <div>
            <form action="/user_index.php" method="get">
                <!--Select brand-->
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Brand Name:</label>
                    <select class="form-select" aria-label="Default select example" name="brand">
                        <option value="all">All</option>
                        <option value="asus">Asus</option>
                        <option value="acer">Acer</option>
                        <option value="lenovo">Lenovo</option>
                        <option value="dell">Dell</option>
                        <option value="apple">Apple</option>
                        <option value="hp">HP</option>
                    </select>
                </div>

                <!--Select OS (This function does not work at now)-->
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">OS:(This function does not work at now)</label>
                    <select class="form-select" aria-label="Default select example" name="os">
                        <option selected>All</option>
                        <option value="windows">Windows</option>
                        <option value="mac">Mac OS</option>
                    </select>
                </div>

                <!--Select price (This function does not work at now)-->
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Price:(This function does not work at now)</label>
                    <select class="form-select" aria-label="Default select example" name="os">
                        <option selected>All</option>
                        <option value="windows">Windows</option>
                        <option value="mac">Mac OS</option>
                    </select>
                </div>

                <!--Submit button-->
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Select</button>
                </div>
            </form>
        </div>

        <!--Product list-->
        <div class="row mt-5">
            <!--Get product data-->
            <?php
            include "db_conn.php"; // Using database connection file here

            $sql = "CALL getLaptopProducts";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $records = $stmt->get_result(); // fetch data from database

            $product_data = []; // Store product information lists in this variable

            if (!isset($_GET['brand'])){
                while ($data = mysqli_fetch_assoc($records)) {
                    $product_data[] = $data;
                }
            } else if ($_GET["brand"] == 'asus') {
                $product_data = $asus;
            } else if ($_GET["brand"] == 'acer') {
                $product_data = $acer;
            } else if ($_GET["brand"] == 'lenovo') {
                $product_data = $lenovo;
            } else if ($_GET["brand"] == 'dell') {
                $product_data = $dell;
            } else if ($_GET["brand"] == 'apple') {
                $product_data = $apple;
            } else if ($_GET["brand"] == 'hp') {
                $product_data = $hp;
            } else if ($_GET["brand"] == 'all') {
                while ($data = mysqli_fetch_assoc($records)) {
                    $product_data[] = $data;
                }
            } else {
                while ($data = mysqli_fetch_assoc($records)) {
                    $product_data[] = $data;
                }
            }

            // Show product cards
            foreach ($product_data as $row) { ?>
                <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                    <div class="card shadow-sm bg-white rounded">
                        <div class="p-3">
                            <!--Product information (Image, SKU, CPU, RAM, GPU, Storage, Price-->
                            <img src='<?php echo $row['productPhoto']; ?>' class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="card-title"><?php echo $row['productName']; ?></h2>
                                <p>SKU: <?php echo $row['productSKU']; ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">CPU: <?php echo $row['productCPU']; ?></li>
                                <li class="list-group-item">RAM: <?php echo $row['productRAM']; ?></li>
                                <li class="list-group-item">GPU: <?php echo $row['productGPU']; ?></li>
                                <li class="list-group-item">Storage: <?php echo $row['productSto']; ?></li>
                            </ul>
                            <div class="card-body">
                                <h3><label id="product-price">$<?php echo $row['productPrice']; ?></label></h3>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>