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
    <link rel="stylesheet" href="../../../../assets/css/admins/products/add_product.css">
</head>

<body>
    <form action="index.php?controller=category&action=updateCategory&category_id=<?= $oneCategory['category_id'] ?>" method="post" enctype="multipart/form-data">

        <label for="category_name">Tên danh mục:</label>
        <input type="text" id="category_name" name="category_name" value="<?= $oneCategory['category_name'] ?>" required> <br>

        <label for="description">Mô tả:</label>
        <textarea name="description" id="description"><?= $oneCategory['description'] ?></textarea> <br>

        <input type="submit" value="Cập nhật" name="btnUpdateCategory">
    </form>
</body>

</html>