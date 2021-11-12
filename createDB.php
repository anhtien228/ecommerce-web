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

    $artist_1_pass = password_hash("goyte123", PASSWORD_BCRYPT);
    $artist_2_pass = password_hash("carpenters456", PASSWORD_BCRYPT);  
    $artist_3_pass = password_hash("chilliesindie", PASSWORD_BCRYPT);  

    // Insert data SQL
    $sql_insert = "INSERT INTO user (username, password, firstname, lastname, address, telephone, dob, created_at)
                    VALUES ('jason123@gmail.com', '$user_1_pass', 'Jason', 'Nguyen', '5 Ham Nghi, District 1', '0931251260', '2000-03-09','2021-01-25'),
                            ('duycse2k@gmail.com', '$user_2_pass', 'Duy', 'Nguyen Vinh', '106 Lexington, New York City', '0903591012', '1998-07-23', '2021-05-03'),
                            ('nataliedang@gmail.com', '$user_3_pass', 'Natalie', 'Dang', '206 Ly Thuong Kiet, District 10', '0938120677', '1999-01-31', '2021-07-04');";

    // $sql_insert .=  "INSERT INTO artist (Name, DOB, Bio, Photo, Follower, Email, password)      
    //                 VALUES ('Gotye', '1992-04-05', 'Wouter Wally De Backer, better known by his stage name Gotye is a Belgian-Australian multi-instrumentalist and singer-songwriter.',
    //                         'https://kenh14cdn.com/thumb_w/660/203336854389633024/2021/7/22/3000-1626965259057172502513.jpg',
    //                         0, 'goyte@gmail.com', '$artist_1_pass'),
    //                         ('The Carpenters', '1997-08-13', 'The Carpenters (officially known as Carpenters) were an American vocal and instrumental duo consisting of siblings Karen and Richard Carpenter.',
    //                         'https://i.guim.co.uk/img/media/f45d9a1b95d08f8648309b62bc8c87a3b6d55111/0_610_3672_2202/master/3672.jpg?width=1200&height=1200&quality=85&auto=format&fit=crop&s=77b0f8f250119e27894022196107b7c8',
    //                         0, 'thecarpenters@outlook.com', '$artist_2_pass'),
    //                         ('Chillies', '1999-01-25', 'A Vietnamese alternative-rock and indie band that is very popular for their Mascara song..',
    //                         'https://avatar-ex-swe.nixcdn.com/singer/avatar/2020/07/22/f/1/f/9/1595414808364_600.jpg',
    //                         0, 'chillies@gmail.com', '$artist_3_pass');";

    // Operation
    if (mysqli_multi_query($conn, $sql_insert))
        echo "\nNew default records created successfully";
    else
        echo "\nError: " . $sql_insert . "<br>" . mysqli_error($conn);

    mysqli_close($conn);

?>