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

    public function getByIdProduct($product_id)
    {
        $pdo = pdo_connect();
        $sql = "SELECT *FROM products WHERE product_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($product_name, $price, $description, $image_url, $stock_quantity, $status, $category_id, $product_id)
    {
        $pdo = pdo_connect();
        // Trường hợp:
        //1. update nhưng không update ảnh
        if ($image_url === null) {
            $sql = "UPDATE products 
            SET product_name=?,price=?,description=?,stock_quantity=?,status=?, category_id=? 
            WHERE product_id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$product_name, $price, $description, $stock_quantity, $status, $category_id, $product_id]);
            return $stmt;
        }
        //2. update nhưng có update cả ảnh thì xóa ảnh của product hiện tại thay = ảnh mới
        else {
            $current_image_url = $this->getByIdProduct($product_id);
            if (!empty($current_image_url['image_url']) && $current_image_url) {
                deleteImage($current_image_url['image_url']);
            }
            $sql = "UPDATE products 
                SET product_name=?,price=?,description=?,image_url=?,stock_quantity=?,status=?, category_id=? 
                WHERE product_id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$product_name, $price, $description, $image_url, $stock_quantity, $status, $category_id, $product_id]);
            return $stmt;
        }
    }

    // Hàm phân trang 
    public function getProductPagination($limit, $offset)
    {
        $pdo = pdo_connect();
        $limit = (int)$limit;
        $offset = (int)$offset;

        $sql = "SELECT p.product_id ,p.product_name AS product_name, p.price, p.description,p.image_url,
                   p.stock_quantity, p.status, c.category_name, p.created_at,p.updated_at
            FROM products p 
            JOIN categories c ON p.category_id = c.category_id 
            ORDER BY p.product_id ASC
            LIMIT $limit OFFSET $offset";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalProduct()
    {
        $pdo = pdo_connect();
        $sql = "SELECT COUNT(*) FROM products";
        $stmt = $pdo->query($sql);
        return $stmt->fetchColumn();
    }
    // END Hàm phân trang 
}
