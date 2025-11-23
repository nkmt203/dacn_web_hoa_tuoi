<?php
// code test data

require_once __DIR__ . '/../../../models/category_model.php';
require_once __DIR__ . '/../../../../config/config.php';
$category = new CategoryModel();
$listCategory = $category->getAllCategory();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách danh mục</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="p-1 m-1">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold">Danh sách danh mục</h2>
        <?php
        require_once __DIR__ . '/../../../../helpers/message_helper.php';
        MessageHelper::logMessage();
        ?>
        <a href="index.php?controller=category&action=addCategory" class="btn btn-primary mb-3">+ Thêm danh mục</a>
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-secondary">
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
                        <td style="font-weight: bold;"><?= $c['category_id'] ?></td>
                        <td><?= $c['category_name'] ?></td>
                        <td><?= $c['description'] ?></td>
                        <td><?= $c['created_at'] ?></td>
                        <td><?= $c['updated_at'] ?></td>
                        <td class="align-middle text-center">
                            <div class="d-inline-flex justify-content-center align-items-center gap-2">
                                <a href="index.php?controller=category&action=updateCategory&category_id=<?= $c['category_id'] ?>"
                                    onclick="return confirm('Bạn có chắc muốn cập nhật')"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i></a>|
                                <a href="index.php?controller=category&action=deleteCategory&category_id=<?= $c['category_id'] ?>"
                                    onclick="return confirm('Bạn có chắc muốn xóa')"
                                    class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>