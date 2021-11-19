<?php
session_start();
if (!isset($_SESSION["user_name"]))
    header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="format-detection" content="telephone=no">
    <title>Electro</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!--reset css-->
    <link rel="stylesheet" href="css/product.css"/>
    <link rel="stylesheet" href="css/flex_user.css"/>
    <link rel="stylesheet" href="css/items.css"/>

    <script src="https://kit.fontawesome.com/57448d1974.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- <script src="js/cart.js"></script> -->


</head>

<body>
<!--Fetch DB data-->
<?php
include "db_conn.php"; // Using database connection file here


$sql = "CALL getLaptopProducts";
$stmt = $conn->prepare($sql);
$stmt->execute();
$records = $stmt->get_result(); // fetch data from database
while ($data = mysqli_fetch_assoc($records)) {
    if ($data['productBrand'] == 'Asus') {
        $asus[] = $data;
    } else if ($data['productBrand'] == 'Acer') {
        $acer[] = $data;
    } else if ($data['productBrand'] == 'Lenovo') {
        $lenovo[] = $data;
    } else if ($data['productBrand'] == 'Dell') {
        $dell[] = $data;
    } else if ($data['productBrand'] == 'Apple') {
        $apple[] = $data;
    } else if ($data['productBrand'] == 'HP') {
        $hp[] = $data;
    }
}
?>

<!--Body section-->
<!--Navbar-->
<?php
include "libs/nav.php"; // Using navbar file here
?>

<!--Content text-->
<section id="main-page">
    <div class="content-bg">
        <div class="content-text">
            <h2>Product List</h2>
            <p>Latest models of laptop by different brands</p>
        </div>
    </div>
</section>

<!--Product list-->
<div>
    <?php
    include "libs/product_list.php";
    ?>
</div>

<!--footer-->
<?php
include "libs/footer.php"; // Using footer file here
?>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
</body>
</html>

