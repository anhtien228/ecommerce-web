<?php
session_start();
include "db_conn.php";

# Validate inputs
if(isset($_POST['song_name']))  {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $song_name = validate($_POST['song_name']);

    if(empty($song_name)) {
        header("Location: index.php?error=Song name is empty!");
        exit();
    }

    else {
        # Database Query (SQL)
        $sql = "CALL getSongByName(?)";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("s", $song_name);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $song_id = $row['ID'];
            if(isset($_SESSION["user_name"])) {
                header("Location: selectsong_user.php?id=".$song_id);
                exit();
            }
            else {
                header("Location: selectsong.php?id=".$song_id);
                exit();
            }
        }
        else {
            header("Location: index.php?error=Song does not exist");
            exit();
        }
    }
}

else {
    header("Location: index.php");
    exit();
}
?>