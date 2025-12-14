<?php
require_once __DIR__ . '/../../../../config/config.php';
require_once __DIR__ . '/../../../models/promotion_model.php';
require_once __DIR__ . '/../../../models/product_model.php';

$productModel = new ProductModel();
$promotionModel = new PromotionModel();

$listProduct = $productModel->getAllProduct();
$listPromotionActive = $promotionModel->getPromotionActive();
$listPaginationApplyProductPromotion = $promotionModel->getPaginationAllApplyProductPromotion($limit, $offset);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Apply Product Promotion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <h2 class="mb-4 text-center">Danh sách sản phẩm khuyến mãi đang hoạt động</h2>
        <?php
        require_once __DIR__ . '/../../../../helpers/message_helper.php';
        MessageHelper::logMessage();
        ?>

        <div class="card shadow-sm">
            <div class="card-header">Danh sách khuyến mãi đang hoạt động</div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Giá KM</th>
                            <th>Khuyến mãi</th>
                            <th>Code khuyến mãi</th>
                            <th>Trạng thái</th>
                            <th>Thời gian áp dụng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listPaginationApplyProductPromotion as $apply): ?>
                            <?php 
                                // Tính giá sau giảm
                                $calc = $promotionModel->calculatePromotionPrice(
                                    $apply['price'],
                                    $apply['discount_type'],
                                    $apply['discount_value']
                                );
                            ?>
                            <tr>
                                <td><?= $apply['product_promotion_id'] ?></td>
                                <td>
                                    <img src="../../../../uploads/<?= $apply['image_url'] ?>" alt="#" width="90px">
                                </td>
                                <td><?= $apply['product_name'] ?></td>
                                <!-- Giá khuyến mãi -->
                                <td>
                                    <span class="text-decoration-line-through text-muted">
                                        <?= number_format($apply['price'], 0, '.', '.') ?>đ
                                    </span><br>

                                    <span class="fw-bold text-danger">
                                        <?= number_format($calc['final_price'], 0, '.', '.') ?>đ
                                    </span><br>

                                    <small class="text-success">
                                        Tiết kiệm <?= number_format($calc['discount_amount'], 0, '.', '.') ?>đ
                                    </small>
                                </td>
                                <td>
                                    <?php
                                    switch ($apply['discount_type']) {
                                        case 'fixed_amount':
                                            echo 'Giảm ' . number_format($apply['discount_value'], 0, '.', '.') . 'đ';
                                            break;

                                        case 'percentage':
                                            echo 'Giảm ' . number_format($apply['discount_value'], 0, '.', '.') . '%';
                                            break;

                                        default:
                                            echo number_format($apply['discount_value'], 0, '.', '.');
                                            break;
                                    }
                                    ?>
                                </td>
                                <td><?= $apply['promotion_code'] ?? '' ?></td>
                                <td>
                                    <?php
                                    if ($apply['status'] === 'active') {
                                        echo ' <span class="badge bg-success">Đang hoạt động</span>';
                                    } else {
                                        echo ' <span class="badge bg-success">Lỗi</span>';
                                    }
                                    ?>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($apply['created_at'])) ?></td>
                                <td>
                                    <a href="index.php?controller=promotion&action=updateProductPromotion&product_promotion_id=<?= $apply['product_promotion_id'] ?>"
                                        class="btn btn-warning btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn cập nhật khuyến mãi này không?')">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a> |
                                    <a href="index.php?controller=promotion&action=removeProductPromotion&product_promotion_id=<?= $apply['product_promotion_id'] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn gỡ khuyến mãi này không?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>


                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-3">
                    <nav>
                        <ul class="pagination pagination-sm2">
                            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="index.php?controller=promotion&action=listApplyProductPromotion&page=<?= $page - 1 ?>">«</a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="index.php?controller=promotion&action=listApplyProductPromotion&page=<?= $i ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link" href="index.php?controller=promotion&action=listApplyProductPromotion&page=<?= $page + 1 ?>">»</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--END Phân trang -->
            </div>
        </div>
    </div>
</body>

</html>