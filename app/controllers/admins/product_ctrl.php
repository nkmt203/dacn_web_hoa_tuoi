<?php
require_once __DIR__ . '/../../models/product_model.php';
require_once __DIR__ . '/../../models/category_model.php';
require_once __DIR__ . '/../../../helpers/image_helper.php';
require_once __DIR__ . '/../../../helpers/message_helper.php';

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
            // Validation
            if (empty($_POST['product_name']) || empty($_POST['price']) || empty($_POST['stock_quantity']) || empty($_POST['category_id'])) {
                MessageHelper::error("Vui lòng điền đầy đủ thông tin bắt buộc!");
                $viewFile = "../../views/admins/products/add_product.php";
                include __DIR__ . '/../../views/admins/dashboard.php';
                return;
            }

            $product_name = trim($_POST['product_name']);
            $price = floatval($_POST['price']);
            $description = trim($_POST['description'] ?? '');
            $stock_quantity = intval($_POST['stock_quantity']);
            $status = $_POST['status'] ?? 'available';
            $category_id = intval($_POST['category_id']);

            // Validate price and quantity
            if ($price <= 0) {
                MessageHelper::error("Giá sản phẩm phải lớn hơn 0!");
                $viewFile = "../../views/admins/products/add_product.php";
                include __DIR__ . '/../../views/admins/dashboard.php';
                return;
            }

            if ($stock_quantity < 0) {
                MessageHelper::error("Số lượng không được âm!");
                $viewFile = "../../views/admins/products/add_product.php";
                include __DIR__ . '/../../views/admins/dashboard.php';
                return;
            }

            // Handle image upload
            $image_url = null;
            if (!empty($_FILES['image_url']['name'])) {
                $image_url = uploadImage($_FILES['image_url']);
                if (!$image_url) {
                    MessageHelper::error("Lỗi tải lên ảnh! Vui lòng kiểm tra định dạng file (JPG, PNG, JPEG)");
                    $viewFile = "../../views/admins/products/add_product.php";
                    include __DIR__ . '/../../views/admins/dashboard.php';
                    return;
                }
            }

            $addProduct = $this->model->addProduct($product_name, $price, $description, $image_url, $stock_quantity, $status, $category_id);
            if ($addProduct) {
                MessageHelper::success("Thêm sản phẩm thành công !!!");
                header('Location: ../../../index.php?controller=product&action=listProduct');
                exit;
            } else {
                MessageHelper::error("Thêm sản phẩm thất bại !!!");
                $viewFile = "../../views/admins/products/add_product.php";
                include __DIR__ . '/../../views/admins/dashboard.php';
            }
        } else {
            $viewFile = "../../views/admins/products/add_product.php";
            include __DIR__ . '/../../views/admins/dashboard.php';
        }
    }

    public function deleteProduct()
    {
        if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $deleteProduct = $this->model->deleteProduct($product_id);
            if ($deleteProduct) {
                MessageHelper::success("Xóa sản phẩm thành công !!!");
                header("Location: index.php?controller=product&action=listProduct");
                exit;
            } else {
                MessageHelper::error("Xóa sản phẩm thất bại !!!");
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
                MessageHelper::success("Cập nhật thành công !!!");
                header("Location: index.php?controller=product&action=listProduct");
                exit;
            } else {
                MessageHelper::error("Cập nhật sản phẩm thất bại !!!");
            }
        } else {
            echo "Không tìm thấy ID cập nhật";
        }
        $viewFile = "../../views/admins/products/update_product.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }
}
