<?php
session_start();
require("DatabaseClass.php");

# Validate inputs
if(isset($_POST['product_name']))  {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $product_name = validate($_POST['product_name']);

    if(empty($product_name)) {
        header("Location: user_index.php?id=".$_SESSION['id']."?error=Product name is empty!");
        exit();
    }

    else {
        $result = $db->getProductsByName($product_name);
        
        if (mysqli_num_rows($result) > 0) {
            while ($records = mysqli_fetch_assoc($result)) {
                $queue[] = $records;
            }
            $_SESSION['query_temp_data'] = $queue;
            header("Location: ../product.php?query=".$product_name);
            exit();
        }
        else {
            header("Location: ../product.php?query=" . urlencode($product_name) . "&error=" . urlencode("none"));
            exit();
        }
    }
}

else {
    header("Location: ../user_index.php?id=".$_SESSION['id']);
    exit();
}
?>