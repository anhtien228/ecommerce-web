<?php
session_start();
include "db_conn.php";

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
        header("Location: login.php?error=Username is required!");
        exit();
    }

    else if(empty($password)) {
        header("Location: login.php?error=Password is required!");
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
                $_SESSION['user_level'] = $user_level;
                $_SESSION['user_name'] = $row['username'];
                if ($user_level == 'User') {
                    $_SESSION['name'] = $row['firstname'] . " " . $row['lastname'];
                }
                if ($user_level == 'Staff') {
                    $_SESSION['name'] = $row['name'];
                }
                $_SESSION['id'] = $row['id'];

                session_start();

                if(isset($_SESSION['user_name'])) {
                    header("Location: user.php");
                    exit();
                }
                else {
                    header("Location: login.php");
                    exit;
                }
            }
            else {
                header("Location: login.php?error=Incorrect Username or Password");
                exit();
            }
        }
        else {
            header("Location: login.php?error=Incorrect Username or Password");
            exit();
        }
    }
}

else {
    header("Location: index.php");
    exit();
}

?>