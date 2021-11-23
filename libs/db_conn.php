<?php
    $servername ="localhost";
    $user_name = "root";
    $password = "";

    $db_name = "electro";
    // Check connection
    $conn = mysqli_connect($servername, $user_name, $password, $db_name);
    mysqli_set_charset($conn, 'UTF8');

    if (!$conn) {
        echo "Connection Failed.";
    }
    ?>