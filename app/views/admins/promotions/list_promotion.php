<?php
// code test data

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="p-1 m-1">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold">Danh sách Code khuyến mãi</h2>
        <?php
        require_once __DIR__ . '/../../../../helpers/message_helper.php';
        MessageHelper::logMessage();
        ?>
        <div class="mb-3">
            <a class="btn btn-success me-2" href="index.php?controller=promotion&action=addPromotion">
                + Thêm mới khuyến mãi
            </a>
        </div>

        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Code khuyến mãi</th>
                    <th>Tên khuyến mãi</th>
                    <th>Mô tả</th>
                    <!-- <th>Loại</th> -->
                    <th>Giá trị</th>
                    <th>Thời gian áp dụng</th>
                    <th>Trạng thái</th>
                    <!-- <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th> -->
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listPromotion as $p): ?>
                    <tr>
                        <td style="font-weight: bold;"><?= $p['promotion_id'] ?></td>
                        <td><?= $p['promotion_code'] ?></td>
                        <td><?= $p['promotion_name'] ?></td>
                        <td><?= $p['description'] ?></td>
                        <!-- <td>
                            <?php
                            switch ($p['discount_type']) {
                                case 'percentage':
                                    echo "Phần trăm (%)";
                                    break;
                                case 'fixed_amount':
                                    echo "Giá trị cố định";
                                    break;
                                default:
                                    echo "Lỗi";
                                    break;
                            }
                            ?>
                        </td> -->
                        <td>
                            <?php
                            switch ($p['discount_type']) {
                                case 'fixed_amount':
                                    echo 'Giảm ' . number_format($p['discount_value'], 0, '.', '.') . 'đ';
                                    break;
                                case 'percentage':
                                    echo 'Giảm ' . number_format($p['discount_value'], 0, '.', '.') . '%';
                                    break;
                                default:
                                    echo 'Giảm ' . number_format($p['discount_value'], 0, '.', '.');
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <ul class="list-group text-center">
                                <li class="list-group-item list-group-item-success">
                                    Từ <?= date('d/m/Y', strtotime($p['start_date'])) ?>
                                </li>
                                <li class="list-group-item list-group-item-danger">
                                    Hết <?= date('d/m/Y', strtotime($p['end_date'])) ?>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <?php
                            switch ($p['status']) {
                                case 'active':
                                    echo '<div class="alert alert-success p-1 m-0 text-center">Đang hoạt động</div>';
                                    break;
                                case 'inactive':
                                    echo '<div class="alert alert-warning p-1 m-0 text-center">Tạm ngưng</div>';
                                    break;
                                case 'expired':
                                    echo '<div class="alert alert-danger p-1 m-0 text-center">Hết hạn</div>';
                                    break;
                                default:
                                    echo '<div class="alert alert-secondary p-1 m-0 text-center">Lỗi</div>';
                                    break;
                            }
                            ?>
                        </td>
    
                        <td class="align-middle text-center">
                            <div class="d-inline-flex justify-content-center align-items-center gap-2">
                                <a href="index.php?controller=promotion&action=updatePromotion&promotion_id=<?= $p['promotion_id'] ?>"
                                    onclick="return confirm('Bạn có chắc muốn cập nhật')"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i></a>|
                                <a href="index.php?controller=promotion&action=deletePromotion&promotion_id=<?= $p['promotion_id'] ?>"
                                    onclick="return confirm('Bạn có chắc muốn xóa')"
                                    class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            <nav>
                <ul class="pagination pagination-sm2">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="index.php?controller=promotion&action=listPromotion&page=<?= $page - 1 ?>">«</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="index.php?controller=promotion&action=listPromotion&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="index.php?controller=promotion&action=listPromotion&page=<?= $page + 1 ?>">»</a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>

</body>

</html>