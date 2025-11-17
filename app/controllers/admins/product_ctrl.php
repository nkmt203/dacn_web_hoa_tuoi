<?php
require_once __DIR__ . '/../../models/product_model.php';
require_once __DIR__ . '/../../models/category_model.php';
require_once __DIR__ . '/../../../helpers/image_helper.php';

class ProductController
{
    private $model;
    public function __construct()
    {
        $this->model = new ProductModel();
    }

    public function loadListProduct()
    {
        $listProduct = $this->model->getAllProduct();
        $viewFile = "../../views/admins/products/list_product.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function addProduct()
    {
        if (isset($_POST['AddProduct']) && $_POST['AddProduct']) {
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $image_url = uploadImage($_FILES['image_url']);
            $stock_quantity = $_POST['stock_quantity'];
            $status = $_POST['status'];
            $category_id = $_POST['category_id'];

            $addProduct = $this->model->addProduct($product_name, $price, $description, $image_url, $stock_quantity, $status, $category_id);
            if ($addProduct) {
                header('Location: index.php?controller=product&action=loadListProduct');
                exit;
            } else {
                $error = "Thêm thất bại";
            }
        }
        $viewFile = "../../views/admins/products/add_product.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }
    public function deleteProduct()
    {
        if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $deleteProduct = $this->model->deleteProduct($product_id);
            if ($deleteProduct) {
                header("Location: index.php?controller=product&action=loadListProduct");
                exit;
            } else {
                echo "Xóa thất bại";
            }
        } else {
            echo "<h2>Không có ID nào để xóa!!</h2>";
        }
    }
}
