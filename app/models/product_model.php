<?php
class ProductModel
{
    private $pdo;
    function __construct()
    {
        $this->pdo = pdo_connect();
    }

    public function getAllProduct()
    {
        $pdo = pdo_connect();
        $sql = "SELECT p.product_id ,p.product_name AS product_name, p.price, p.description,p.image_url,
                        p.stock_quantity, p.status, c.category_name, p.created_at,p.updated_at
        FROM products p JOIN categories c ON p.category_id = c.category_id ORDER BY p.product_id DESC
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProduct($product_name, $price, $description, $image_url, $stock_quantity, $status, $category_id)
    {
        $pdo = pdo_connect();
        $sql = "INSERT INTO products (product_name,price,description,image_url,stock_quantity,status,category_id) VALUES (?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$product_name, $price, $description, $image_url, $stock_quantity, $status, $category_id]);
        return $stmt;
    }

    public function getValueEnumStatus()
    {
        $pdo = pdo_connect();
        $sql = "SHOW COLUMNS FROM products LIKE 'status'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $listEnum = $row['Type'];
        preg_match("/^enum\('(.*)'\)$/", $listEnum, $matches);
        return explode("','", $matches[1]);
    }

    public function deleteProduct($product_id)
    {
        $pdo = pdo_connect();
        $sql_img = "SELECT image_url FROM products WHERE product_id=?";
        $stmt = $pdo->prepare($sql_img);
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($product) {
            deleteImage($product['image_url']);
            $sql = "DELETE FROM products WHERE product_id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$product_id]);
            return $stmt->rowCount() > 0;
        }
        return false;
    }
}
