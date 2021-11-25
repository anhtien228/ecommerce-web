<?php

class DatabaseClass
{
    private $conn = null;

    // this function is called everytime this class is instantiated
    public function __construct($servername = "localhost", $db_name = "electro", $user_name = "root", $password = ""){
        $this->conn = mysqli_connect($servername, $user_name, $password, $db_name);
        mysqli_set_charset($this->conn, 'UTF8');

        if (!$this->conn) {
            echo "Connection Failed.";
        }
    }

    // Get all products
    public function getAllProducts(){
        $sql = "CALL getLaptopProducts";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getFilteredProducts($product_name, $brand, $os, $cpu, $ram, $storage){
        $sql = "CALL filterProducts(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $product_name, $brand, $os, $cpu, $ram, $storage);
        $stmt->execute();
        return $stmt->get_result();
    }
}