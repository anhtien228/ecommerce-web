<?php
session_start();
include "../db_conn.php";
# Validate inputs
if (isset($_POST['psku']) && isset($_POST['pid'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $product_sku = validate($_POST['psku']);
    $product_id = $_POST['pid'];
    $product_price = $_POST['pprice'];
    $session_id = $_SESSION['shop_session'];

    $sql = "CALL checkCart(?, ?)";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ii", $product_id, $session_id);
    $stmt->execute();
    $records = $stmt->get_result();
    $url = $_SERVER['HTTP_REFERER'];

    if (mysqli_num_rows($records) > 0) {
        $sql_remove = "DELETE FROM cart_item
        WHERE (session_id='$session_id') AND (product_id='$product_id');";

        $conn->next_result();
        if (mysqli_query($conn, $sql_remove)) {
            $conn->next_result();
            $sql_insert = "UPDATE shopping_session
            SET total = total - $product_price
            WHERE id = $session_id";
            
            mysqli_query($conn, $sql_insert);

            $_SESSION['add_cart'] = "removed";
            header("Location: $url");
            exit();
        }
        
        else {
            $_SESSION['add_cart'] = "sqlfailed";
            header("Location: $url");
            exit();
        }
    }

    else {
        $_SESSION['add_cart'] = "already";
        header("Location: $url");
        exit();
    }
}
