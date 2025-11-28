<?php
class OrderModel
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = pdo_connect();
    }

    public function getAllOrder()
    {
        $sql = "SELECT o.*, cus.full_name AS customer_name
        FROM orders o JOIN customers cus ON o.customer_id= cus.customer_id 
        ORDER BY o.customer_id ASC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderPagination($limit, $offset)
    {
        $sql = "SELECT o.*, cus.full_name AS customer_name
        FROM orders o JOIN customers cus ON o.customer_id= cus.customer_id 
        ORDER BY o.customer_id DESC ASC
        LIMIT $limit OFFSET $offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByIdOrder($order_id)
    {
        $sql = "SELECT o.*, cus.full_name AS customer_name , cus.email, cus.phone, cus.address
        FROM orders o JOIN customers cus ON o.customer_id= cus.customer_id WHERE o.order_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$order_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getByIdOrderDetail($order_id)
    {
        $sql = "SELECT od.*, p.product_name, p.image_url
        FROM order_details od JOIN products p ON od.product_id= p.product_id WHERE od.order_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
