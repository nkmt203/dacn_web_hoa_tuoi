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
        ORDER BY o.customer_id DESC 
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

    public function updateOrderStatus($order_id, $order_status)
    {
        $sql = "UPDATE orders SET order_status=? WHERE order_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$order_status, $order_id]);
        return $stmt;
    }

    public function deleteOrder($order_id)
    {
        $sql = "DELETE FROM order_details WHERE order_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$order_id]);

        $sql = "DELETE FROM orders WHERE order_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$order_id]);
        return $stmt->rowCount() > 0;
    }

    public function getByOrderStatus($order_status)
    {
        $sql = "SELECT o.*, cus.full_name AS customer_name
            FROM orders o
            JOIN customers cus ON o.customer_id = cus.customer_id
            WHERE o.order_status = ?
            ORDER BY o.order_id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$order_status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createOrder($customer_id, $total_amount, $receiver_name, $receiver_phone, $delivery_address, $note, $payment_method)
    {
        $order_code = 'ORD-' . strtoupper(substr(uniqid(), 7));
        $sql = "INSERT INTO orders (order_code, customer_id, total_amount, receiver_name, receiver_phone, delivery_address, note, payment_method, order_status, payment_status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending', 'unpaid')";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute([$order_code, $customer_id, $total_amount, $receiver_name, $receiver_phone, $delivery_address, $note, $payment_method])) {
            return $this->pdo->lastInsertId();
        }
        return false;
    }

    public function createOrderDetail($order_id, $product_id, $quantity, $unit_price, $subtotal)
    {
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, unit_price, subtotal) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$order_id, $product_id, $quantity, $unit_price, $subtotal]);
    }

    public function getOrdersByCustomer($customer_id)
    {
        $sql = "SELECT o.*, 
                (SELECT p.image_url FROM order_details od JOIN products p ON od.product_id = p.product_id WHERE od.order_id = o.order_id LIMIT 1) as first_product_image,
                (SELECT p.product_name FROM order_details od JOIN products p ON od.product_id = p.product_id WHERE od.order_id = o.order_id LIMIT 1) as first_product_name,
                (SELECT COUNT(*) FROM order_details WHERE order_id = o.order_id) as total_products
                FROM orders o 
                WHERE o.customer_id = ? 
                ORDER BY o.order_date DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$customer_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
