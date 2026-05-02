<?php
class CartModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = pdo_connect();
    }

    public function getCartByCustomer($customer_id)
    {
        $sql = "SELECT c.cart_id, c.quantity, p.product_id, p.product_name, p.price, p.image_url, p.stock_quantity
                FROM cart c
                JOIN products p ON c.product_id = p.product_id
                WHERE c.customer_id = ?
                ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$customer_id]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($items)) {
            require_once __DIR__ . '/product_model.php';
            $productModel = new ProductModel();
            $productModel->applyPromotions($items);
        }

        return $items;
    }

    public function findCartItem($customer_id, $product_id)
    {
        $sql = "SELECT * FROM cart WHERE customer_id = ? AND product_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$customer_id, $product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addCart($customer_id, $product_id, $quantity)
    {
        $sql = "INSERT INTO cart (customer_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$customer_id, $product_id, $quantity]);
    }

    public function updateCartQuantity($cart_id, $quantity)
    {
        $sql = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$quantity, $cart_id]);
    }

    public function deleteCart($cart_id, $customer_id)
    {
        $sql = "DELETE FROM cart WHERE cart_id = ? AND customer_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$cart_id, $customer_id]);
    }

    public function clearCart($customer_id)
    {
        $sql = "DELETE FROM cart WHERE customer_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$customer_id]);
    }

    public function getProductById($product_id)
    {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCartCount($customer_id)
    {
        $sql = "SELECT SUM(quantity) as total_items FROM cart WHERE customer_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$customer_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_items'] ? (int)$result['total_items'] : 0;
    }
}
