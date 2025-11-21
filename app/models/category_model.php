<?php
class CategoryModel
{
    private $pdo;
    function __construct()
    {
        $this->pdo = pdo_connect();
    }

    public function getAllCategory()
    {
        $pdo = pdo_connect();
        $sql = "SELECT * FROM categories";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($category_name, $description)
    {
        $pdo = pdo_connect();
        $sql = "INSERT INTO categories (category_name, description) VALUES (?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category_name, $description]);
        return $stmt;
    }

    public function deleteCategory($category_id)
    {
        $pdo = pdo_connect();
        $sql = "DELETE FROM categories WHERE category_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category_id]);
        return $stmt->rowCount() > 0;
    }

    public function getByIdCategory($category_id)
    {
        $pdo = pdo_connect();
        $sql = "SELECT * FROM categories WHERE category_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCategory($category_id, $category_name, $description)
    {
        $pdo = pdo_connect();
        $sql = "UPDATE categories SET category_name=?, description=? WHERE category_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$category_id, $category_name, $description]);
        return $stmt;
    }
}
