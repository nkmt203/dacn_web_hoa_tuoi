<?php 
function pdo_connect(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "flower_shop_db";
    $dbname1 = "test1_flower_shop_db";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}