<?php
require_once __DIR__ . '/../../../models/category_model.php';
require_once __DIR__ . '/../../../../config/config.php';

$category_id = $_GET['category_id'];
$categoryModel = new CategoryModel();
$oneCategory = $categoryModel->getByIdCategory($category_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin cập nhật danh mục</title>
</head>

<body>
    <div class="container d-flex justify-content-center mt-5">
        <form action="index.php?controller=category&action=updateCategory&category_id=<?= $oneCategory['category_id'] ?>" method="post" enctype="multipart/form-data"
            class="p-4 border rounded" style="width: 400px; background-color: #f8f9fa;">
            <h3 class="text-center mb-4">Cập nhật danh mục</h3>
            <div class="mb-3">
                <label class="form-label fw-bold" for="">Mã danh mục: #<?= $oneCategory['category_id'] ?></label>
            </div>
            <div class="mb-3">
                <label for="category_name" class="form-label fw-bold">Tên danh mục:</label>
                <input type="text" id="category_name" name="category_name" class="form-control" value="<?= $oneCategory['category_name'] ?>" required> <br>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Mô tả:</label>
                <textarea name="description" id="description" class="form-control" rows="5"><?= $oneCategory['description'] ?></textarea> <br>
            </div>
            <div class="text-center">
                <input type="submit" value="Cập nhật" name="btnUpdateCategory" class="btn btn-success">
            </div>
        </form>
    </div>
</body>

</html>