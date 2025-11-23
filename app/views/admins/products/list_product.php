<?php
// code test data

// require_once __DIR__ . '/../../../models/product_model.php';
// require_once __DIR__ . '/../../../../config/config.php';
// $product = new ProductModel();
// $listProduct = $product->getAllProduct();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <!-- <link rel="stylesheet" href="../../../../assets/css/admins/products/list_product.css"> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="p-1 m-1">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold">Danh sách sản phẩm</h2>
        <?php
        require_once __DIR__ . '/../../../../helpers/message_helper.php';
        MessageHelper::logMessage();
        ?>
        <a href="index.php?controller=product&action=addProduct" class="btn btn-primary mb-3">+ Thêm mới sản phẩm</a>
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th>Danh mục</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listProduct as $p): ?>
                    <tr>
                        <td style="font-weight: bold;"><?= $p['product_id'] ?></td>
                        <td><?= $p['product_name'] ?></td>
                        <td><?= number_format($p['price'], 0, '.', '.') ?>đ</td>
                        <td><?= $p['description'] ?></td>
                        <td>
                            <img src="../../../../uploads/<?= $p['image_url'] ?>" alt="#" width="550px" class="img-thumbnail">
                        </td>
                        <td><?= $p['stock_quantity'] ?></td>
                        <td>
                            <?php

                            switch ($p['status']) {
                                case 'available':
                                    echo "<span class='badge bg-success'>Còn hàng</span>";
                                    break;
                                case 'out_of_stock':
                                    echo "<span class='badge bg-warning text-dark'>Tạm hết</span>";
                                    break;
                                case 'discontinued':
                                    echo "<span class='badge bg-danger'>Ngừng kinh doanh</span>";
                                    break;
                                default:
                                    echo "<span class='badge bg-secondary'>Lỗi-Không có trạng thái này!!!</span>";
                                    break;
                            }
                            ?>
                        </td>
                        <td><?= $p['category_name'] ?></td>
                        <td><?= $p['created_at'] ?></td>
                        <td><?= $p['updated_at'] ?></td>
                        <td class="align-middle text-center">
                            <div class="d-inline-flex justify-content-center align-items-center gap-2">
                                <a href="index.php?controller=product&action=updateProduct&product_id=<?= $p['product_id'] ?>"
                                    onclick="return confirm('Bạn có chắc muốn cập nhật')"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i></a>|
                                <a href="index.php?controller=product&action=deleteProduct&product_id=<?= $p['product_id'] ?>"
                                    onclick="return confirm('Bạn có chắc muốn xóa')"
                                    class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- PHÂN TRANG -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?controller=product&action=listProduct&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
        <!-- END PHÂN TRANG -->
    </div>

</body>

</html>