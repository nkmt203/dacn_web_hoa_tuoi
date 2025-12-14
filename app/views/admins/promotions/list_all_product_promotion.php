<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả sản phẩm khuyến mãi</title>
</head>

<body>
    <div class="container py-5">
        <h2 class="mb-4 text-center">Tất cả sản phẩm đang có khuyến mãi</h2>

        <?php
        require_once __DIR__ . '/../../../../helpers/message_helper.php';
        MessageHelper::logMessage();
        ?>

        <div class="card shadow-sm">
            <div class="card-header">Danh sách tất cả khuyến mãi</div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Giá KM</th>
                            <th>Mã KM</th>
                            <th>Giá trị</th>
                            <th>Trạng thái</th>
                            <th>Ngày áp dụng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($listAll as $item): ?>

                            <?php 
                                // Tính giá sau giảm
                                $calc = $promotionModel->calculatePromotionPrice(
                                    $item['price'],
                                    $item['discount_type'],
                                    $item['discount_value']
                                );
                            ?>

                            <tr>
                                <td><?= $item['product_promotion_id'] ?></td>

                                <td>
                                    <img src="../../../../uploads/<?= $item['image_url'] ?>" width="90">
                                </td>

                                <td><?= $item['product_name'] ?></td>

                                <!-- Giá khuyến mãi -->
                                <td>
                                    <span class="text-decoration-line-through text-muted">
                                        <?= number_format($item['price'], 0, '.', '.') ?>đ
                                    </span><br>

                                    <span class="fw-bold text-danger">
                                        <?= number_format($calc['final_price'], 0, '.', '.') ?>đ
                                    </span><br>

                                    <small class="text-success">
                                        Tiết kiệm <?= number_format($calc['discount_amount'], 0, '.', '.') ?>đ
                                    </small>
                                </td>

                                <td><?= $item['promotion_code'] ?></td>

                                <td>
                                    <?php
                                    if ($item['discount_type'] == 'percentage') {
                                        echo "Giảm {$item['discount_value']}%";
                                    } else {
                                        echo "Giảm " . number_format($item['discount_value']) . "đ";
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    switch ($item['status']) {
                                        case 'active':
                                            echo '<span class="badge bg-success">Đang hoạt động</span>';
                                            break;
                                        case 'inactive':
                                            echo '<span class="badge bg-warning text-dark">Tạm ngưng</span>';
                                            break;
                                        default:
                                            echo '<span class="badge bg-danger">Hết hạn</span>';
                                    }
                                    ?>
                                </td>

                                <td><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></td>

                                <td>
                                    <a href="index.php?controller=promotion&action=updateProductPromotion&product_promotion_id=<?= $item['product_promotion_id'] ?>"
                                        class="btn btn-warning btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn cập nhật khuyến mãi này không?')">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a> |

                                    <a href="index.php?controller=promotion&action=removeProductPromotion&product_promotion_id=<?= $item['product_promotion_id'] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn gỡ khuyến mãi này không?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    <nav>
                        <ul class="pagination pagination-sm2">
                            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="index.php?controller=promotion&action=listAllProductPromotion&page=<?= $page - 1 ?>">«</a>
                            </li>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="index.php?controller=promotion&action=listAllProductPromotion&page=<?= $i ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link" href="index.php?controller=promotion&action=listAllProductPromotion&page=<?= $page + 1 ?>">»</a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
