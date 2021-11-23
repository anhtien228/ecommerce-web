<?php
    $servername ="localhost";
    $user_name = "root";
    $password = "";

    // Check connection
    $dbname = "electro";
    $conn = mysqli_connect($servername, $user_name, $password);
    mysqli_set_charset($conn, 'utf8');
    
    // Check connection
    $conn = mysqli_connect($servername, $user_name, $password, $dbname);

    if (!$conn)
        die("Connection failed: " . mysqli_connect_error());

    
    $user_1_pass = password_hash("jasonFlash", PASSWORD_BCRYPT);
    $user_2_pass = password_hash("itsduy@123", PASSWORD_BCRYPT);  
    $user_3_pass = password_hash("nat18021998", PASSWORD_BCRYPT);  

    // Insert data SQL
    $sql_insert = "INSERT INTO user (username, password, firstname, lastname, address, telephone, dob, created_at)
                    VALUES ('jason123@gmail.com', '$user_1_pass', 'Jason', 'Nguyen', '5 Ham Nghi, District 1', '0931251260', '2000-03-09','2021-01-25'),
                            ('duycse2k@gmail.com', '$user_2_pass', 'Duy', 'Nguyen Vinh', '106 Lexington, New York City', '0903591012', '1998-07-23', '2021-05-03'),
                            ('nataliedang@gmail.com', '$user_3_pass', 'Natalie', 'Dang', '206 Ly Thuong Kiet, District 10', '0938120677', '1999-01-31', '2021-07-04');";

    // Staff data
    // Username: electrostaff1@gmail.com
    // Password: staffpassword123
    $staff_pass = password_hash("staffpassword123", PASSWORD_BCRYPT);  

    // Insert data SQL
    $sql_insert .= "INSERT INTO staff (username, password, firstname, lastname)
    VALUES ('electrostaff1@gmail.com', '$staff_pass', 'Vu', 'Thai');";

    // Operation
    if (mysqli_multi_query($conn, $sql_insert))
        echo "\nNew default records created successfully";
    else
        echo "\nError: " . $sql_insert . "<br>" . mysqli_error($conn);

    mysqli_close($conn);

?>