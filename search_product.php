<?php
session_start();
include "db_conn.php";

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
        # Database Query (SQL)
        $sql = "CALL getProductsByName(?)";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (mysqli_num_rows($result) > 0) {
            while ($records = mysqli_fetch_assoc($result)) {
                $queue[] = $records;
            }
            $_SESSION['records'] = $queue;
            header("Location: list_product.php?query=".$product_name);
            exit();
        }
        else {
            header("Location: user_index.php?id=".$_SESSION['id']."?error=Product does not exist!");
            exit();
        }
    }
}

else {
    header("Location: user_index.php?id=".$_SESSION['id']);
    exit();
}
?>