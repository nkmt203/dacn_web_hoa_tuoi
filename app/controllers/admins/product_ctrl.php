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

    public function listProduct()
    {
        $limit = 5; // số sản phẩm / trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $listProduct = $this->model->getProductPagination($limit, $offset);

        // tính tổng số trang nếu muốn hiển thị pagination
        $totalProducts = $this->model->getTotalProduct();
        $totalPages = ceil($totalProducts / $limit);

        $viewFile = "../../views/admins/products/list_product.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }


    public function addProduct()
    {
        if (isset($_POST['btnAddProduct']) && $_POST['btnAddProduct']) {
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $image_url = uploadImage($_FILES['image_url']);
            $stock_quantity = $_POST['stock_quantity'];
            $status = $_POST['status'];
            $category_id = $_POST['category_id'];

            $addProduct = $this->model->addProduct($product_name, $price, $description, $image_url, $stock_quantity, $status, $category_id);
            if ($addProduct) {
                header('Location: index.php?controller=product&action=listProduct');
                exit;
            } else {
                $error = "Thêm thất bại";
                echo $error;
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
                header("Location: index.php?controller=product&action=listProduct");
                exit;
            } else {
                echo "Xóa thất bại";
            }
        } else {
            echo "<h2>Không có ID nào để xóa!!</h2>";
        }
    }

    public function updateProduct()
    {
        $product_id = $_GET['product_id'];
        if (isset($_POST['btnUpdateProduct']) && $_POST['btnUpdateProduct'] && $product_id) {
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $image_url = uploadImage($_FILES['image_url']);
            $stock_quantity = $_POST['stock_quantity'];
            $status = $_POST['status'];
            $category_id = $_POST['category_id'];
            $updateProduct = $this->model->updateProduct($product_name, $price, $description, $image_url, $stock_quantity, $status, $category_id, $product_id);
            if ($updateProduct) {
                header("Location: index.php?controller=product&action=listProduct");
                exit;
            } else {
                echo "Cập nhật thất bại";
            }
        } else {
            echo "Không tìm thấy ID cập nhật";
        }
        $viewFile = "../../views/admins/products/update_product.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }
}
