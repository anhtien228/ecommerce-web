<?php
session_start();
include "../db_conn.php";

# Validate inputs
if(isset($_POST['user_name']) && isset($_POST['password']))  {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $user_name = validate($_POST['user_name']);
    $password = validate($_POST['password']);

    if(empty($user_name)) {
        header("Location: ../../login.php?error=Username is required!");
        exit();
    }

    else if(empty($password)) {
        header("Location: ../../login.php?error=Password is required!");
        exit();
    }

    else {
        $user_level = (isset($_POST['user_level']) && $_POST['user_level'] == 'on') ? "Staff" : "User";

        if ($user_level == 'User') {
            # Database Query (SQL)
            $sql = "SELECT * FROM user WHERE username='$user_name' LIMIT 1";
        }
        else if ($user_level == 'Staff') {
            # Database Query (SQL)
            $sql = "SELECT * FROM staff WHERE username='$user_name' LIMIT 1";
        }

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                if ($user_level =='User') {
                    $user_session_id = $row['id'];    
                    // $sql = "SELECT * FROM shopping_session WHERE user_id=$user_session_id LIMIT 1";
                    $sql = "CALL calCartQuantity(?)";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("s", $user_session_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (mysqli_num_rows($result) > 0) {
                        $row_session = mysqli_fetch_assoc($result);
                        $_SESSION['shop_session'] = $row_session['id'];
                        if ($row_session['cart_quantity'] == NULL) {
                            $_SESSION['cart_quantity'] = 0;
                            $_SESSION['total_amount'] = 0;
                        }
                        else {
                            $_SESSION['cart_quantity'] = $row_session['cart_quantity'];
                            $_SESSION['total_amount'] = $row_session['total'];
                        }
                    }

                    else {
                        $user_id = $row['id'];
                        $insert_session = "INSERT INTO shopping_session (user_id) VALUES ($user_id)";
                        $conn->next_result();
                        if (mysqli_query($conn, $insert_session)) {
                            $_SESSION['shop_session'] = mysqli_insert_id($conn);
                            $_SESSION['cart_quantity'] = 0;
                            $_SESSION['total_amount'] = 0;
                        }
                        else {
                            header("Location: ../../login.php?error=Something when wrong with the shopping session!".mysqli_error($conn));
                            exit();
                        }
                    }
                }

                $_SESSION['user_level'] = $user_level;
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['name'] = $row['firstname'] . " " . $row['lastname'];
                $_SESSION['id'] = $row['id'];

                if(isset($_SESSION['user_name'])) {
                    session_start();
                    header("Location: ../../user_redirect.php?id=".$_SESSION['id']);
                    exit();
                }
                else {
                    header("Location: ../../login.php");
                    exit;
                }
            }
            else {
                header("Location: ../../login.php?error=Incorrect Username or Password");
                exit();
            }
        }
        else {
            header("Location: ../../login.php?error=Incorrect Username or Password");
            exit();
        }
    }
}

else {
    header("Location: index.php");
    exit();
}

?>