<?php
session_start();
include "../db_conn.php";

# Validate inputs
if (isset($_POST['product_name'])) {

    $product_name = $_POST['product_name'];
    $product_sku = $_POST['product_sku'];
    $product_brand = $_POST['product_brand'];
    $product_cpu = $_POST['product_cpu'];
    $product_ram = $_POST['product_ram'];
    $product_storage = $_POST['product_storage'];
    $product_graphic = $_POST['product_graphic'];
    $product_price = $_POST['product_price'];
    $product_photo = $_POST['product_photo'];


    $sql = "SELECT * FROM product WHERE product.sku='$product_sku' LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        $conn->next_result();

        $sql_insert = "INSERT INTO product (name, sku, brand, cpu, ram, storage, graphic, price, photo)
        VALUES ('$product_name', '$product_sku', $product_brand, '$product_cpu', '$product_ram', '$product_storage', '$product_graphic', $product_price, '$product_photo')";

        if (mysqli_query($conn, $sql_insert)) {
            header("Location: ../../staff_index.php?success=Item added into system");
            exit();
        }
        else {
            header("Location: ../../staff_index.php?error=Something when wrong during insertion!");
            exit();
        }
    }

    else {
        header("Location: ../../staff_index.php?error=Item already exists!");
        exit();
    }
}
