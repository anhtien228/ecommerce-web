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
    public function getAllProducts() {
        $sql = "CALL getLaptopProducts";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Get filtered products
    public function getFilteredProducts($product_name, $brand, $os, $cpu, $ram, $storage, $min_price, $max_price) {
        $sql = "CALL filterProducts(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssii", $product_name, $brand, $os, $cpu, $ram, $storage, $min_price, $max_price);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getProductsByName($product_name) {
        $sql = "CALL getProductsByName(?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getCartItems($session_id) {
        $sql = "CALL getCartItems(?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $session_id);
        $stmt->execute();
        return $stmt->get_result(); // fetch data from database
    }

    public function calCartQuantity($user_id) {
        $sql = "CALL calCartQuantity(?)";
        $stmt = $this->conn->prepare($sql); 
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function conn_next() {
        $this->conn->next_result();
    }
}

$db = new DatabaseClass();
// If you have password, use the line below
// $db = new DatabaseClass(password: "");