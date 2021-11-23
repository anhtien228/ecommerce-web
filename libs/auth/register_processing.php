<?php
session_start();
include "../db_conn.php";

# Validate inputs
    if(isset($_POST['user_name_user']) && isset($_POST['password_user'])) {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $first_name = validate($_POST['first_name']);
        $last_name = validate($_POST['last_name']);
        $user_name = validate($_POST['user_name_user']);
        $password = validate($_POST['password_user']);
        $dob = validate($_POST['dob']);

        if(empty($user_name)) {
            header("Location: ../../register.php?error=Username is required!");
            exit();
        }
    
        else if(empty($password)) {
            header("Location: ../../register.php?error=Password is required!");
            exit();
        }

        else {
            $user_level = (isset($_POST['user_level']) && $_POST['user_level'] == 'on') ? "Artist" : "User";
            $sql = "SELECT * FROM user WHERE username='$user_name' LIMIT 1";

            $result = mysqli_query($conn, $sql);
    
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if($row['username'] === $user_name) {
                    header("Location: ../../register.php?error=The username is already registered!");
                    exit();
                }
            }

            if (mysqli_num_rows($result) == 0){
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
    
                $sql_insert = "INSERT INTO user (username, password, firstname, lastname, dob, created_at)
                VALUES ('$user_name', '$password_hash', '$first_name', '$last_name', '$dob', date('Y-m-d H:i:s'))";
    
                if (mysqli_query($conn, $sql_insert)) {
                    header("Location: ../../login.php?success=Your registration was successful.<br>You can now log in!");
                    exit();
                }
                else {
                    header("Location: ../../register.php?error=Something when wrong during registration!");
                    exit();
                }
            }

            else {
                header("Location: ../../register.php?success=Incorrect username of password");
                exit();
            }
        }
    }


else {
    header("Location: ../../register.php");
    exit();
}
