<?php
require_once __DIR__ . '/../../models/category_model.php';
class CategoryController
{
    private $model;
    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    public function listCategory()
    {
        $listCategory = $this->model->getAllCategory();
        $viewFile = "../../views/admins/categories/list_category.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function addCategory()
    {
        if (isset($_POST['btnAddCategory']) && $_POST['btnAddCategory']) {
            $category_name = $_POST['category_name'];
            $description = $_POST['description'];
            $addCategory = $this->model->addCategory($category_name, $description);

            if ($addCategory) {
                header("Location: index.php?controller=category&action=listCategory");
                exit;
            } else {
                echo "Thêm thất bại";
            }
        }
        $viewFile = "../../views/admins/categories/add_category.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }

    public function deleteCategory()
    {
        $category_id = $_GET['category_id'];
        if (isset($category_id)) {
            $deleteCategory = $this->model->deleteCategory($category_id);
            if ($deleteCategory) {
                header("Location: index.php?controller=category&action=listCategory");
                exit;
            } else {
                echo "Xóa thất bại";
            }
        } else {
            echo "<h2>Không có ID nào để xóa</h2>";
        }
    }

    public function updateCategory()
    {
        $category_id = $_GET['category_id'];
        if (isset($_POST['btnUpdateCategory']) && $_POST['btnUpdateCategory']) {
            $category_name = $_POST['category_name'];
            $description = $_POST['description'];
            $updateCategory = $this->model->updateCategory($category_name, $description, $category_id);

            if ($updateCategory) {
                header("Location: index.php?controller=category&action=listCategory");
                exit;
            } else {
                echo "Cập nhật thất bại";
            }
        }
        $viewFile = "../../views/admins/categories/update_category.php";
        include __DIR__ . '/../../views/admins/dashboard.php';
    }
}
