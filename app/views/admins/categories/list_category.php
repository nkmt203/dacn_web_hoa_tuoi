<?php
// code test data

require_once __DIR__ . '/../../../models/category_model.php';
require_once __DIR__ . '/../../../../config/config.php';
$category = new CategoryModel();
$listCategory= $category->getAllCategory();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách danh mục</title>
    <link rel="stylesheet" href="../../../../assets/css/admins/products/list_product.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <h2>Danh sách danh mục</h2>
    <a href="index.php?controller=category&action=addCategory">Thêm danh mục</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Mô tả</th>
                <th>Ngày tạo</th>
                <th>Ngày cập nhật</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listCategory as $c): ?>
                <tr>
                    <td><?= $c['category_id'] ?></td>
                    <td><?= $c['category_name'] ?></td>
                    <td><?= $c['description'] ?></td>
                    <td><?= $c['created_at'] ?></td>
                    <td><?= $c['updated_at'] ?></td>
                    <td>
                        <a href="index.php?controller=category&action=updateCategory&category_id=<?= $c['category_id'] ?>" onclick="return confirm('Bạn có chắc muốn cập nhật')">
                            <i class="fa-solid fa-pen-to-square"></i></a> /
                        <a href="index.php?controller=category&action=deleteCategory&category_id=<?= $c['category_id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa')">
                            <i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>