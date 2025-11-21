<?php
require_once __DIR__ . '/../../../models/category_model.php';
require_once __DIR__ . '/../../../../config/config.php';
$category = new CategoryModel();
$listCategory = $category->getAllCategory();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin thêm danh mục</title>
</head>

<body class="p-3">
    <div class="container d-flex justify-content-center">
        <form action="index.php?controller=category&action=addCategory" method="post" enctype="multipart/form-data"
            class="p-4 border rounded" style="width: 450px; background-color: #f9f9f9;">
            <h3 class="text-center mb-4 fw-bold">Thêm danh mục</h3>

            <label class="fw-bold" for="category_name">Tên danh mục:</label>
            <input type="text" id="category_name" name="category_name" class="form-control mb-3" required> <br>

            <label class="fw-bold" for="description">Mô tả:</label>
            <textarea name="description" id="description" class="form-control mb-3" rows="4"></textarea> <br>

            <input type="submit" value="Thêm" name="btnAddCategory" class="btn btn-primary w-100">
        </form>
    </div>
</body>

</html>