<?php
// code test data

use BcMath\Number;

require_once __DIR__ . '/../../../models/order_model.php';
require_once __DIR__ . '/../../../../config/config.php';
$orderModel = new OrderModel();
$listOrder = $orderModel->getAllOrder();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách đơn hàng</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="p-1 m-1">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold">Danh sách đơn hàng</h2>
        <?php
        require_once __DIR__ . '/../../../../helpers/message_helper.php';
        MessageHelper::logMessage();
        ?>
        <table class="table table-hover table-bordered align-middle text-center ">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Phương thức thanh toán</th>
                    <th>Trạng thái đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listOrder as $o): ?>
                    <tr>
                        <td style="font-weight: bold;"><?= $o['order_id'] ?></td>
                        <td><?= $o['order_code'] ?></td>
                        <td><?= $o['customer_name'] ?></td>
                        <td><?= number_format($o['total_amount'], 0, '.', '.') ?></td>
                        <td>
                            <?php
                            switch ($o['payment_method']) {
                                case 'cod':
                                    echo 'COD';
                                    break;
                                case 'bank_transfer':
                                    echo 'Chuyển khoản ngân hàng';
                                    break;
                                case 'e_wallet':
                                    echo 'Ví điện tử';
                                    break;
                                default:
                                    echo 'Lỗi trạng thái';
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            // Sử dụng Bootstrap 5 để decor lại
                            switch ($o['order_status']) {
                                case 'pending':

                                    echo '<span class="badge status-badge bg-warning">Chờ xác nhận</span>';
                                    break;
                                case 'confirmed':

                                    echo '<span class="badge status-badge bg-primary">Đã xác nhận</span>';
                                    break;
                                case 'shipping':

                                    echo '<span class="badge status-badge bg-info">Đang giao</span>';
                                    break;
                                case 'completed':
                                    echo '<span class="badge status-badge bg-success">Hoàn thành</span>';
                                    break;
                                case 'cancelled':
                                    echo '<span class="badge status-badge bg-secondary">Đã hủy</span>';
                                    break;
                                default:
                                    echo '<span class="badge status-badge bg-danger">Lỗi trạng thái</span>';
                                    break;
                            }
                            ?>

                        </td>
                        <td><?= $o['order_date'] ?></td>
                        <td>
                            <a class="btn btn-sm btn-info mb-1" href="index.php?controller=order&action=listOrderDetail&order_id=<?= $o['order_id'] ?>">
                                <i class="fas fa-eye"></i> Chi tiết
                            </a>
                            <!-- 1.Xác nhận đơn -->
                            <?php if ($o['order_status'] === 'pending'): ?>
                                <a href="index.php?controller=order&action=confirm&order_id=<?= $o['order_id'] ?>"
                                    class="btn btn-sm btn-warning mb-1"
                                    onclick="return confirm('Xác nhận đơn hàng này?')">
                                    <i class="fas fa-check"></i> Xác nhận
                                </a>
                            <?php endif; ?>

                            <!-- 2.Chuyển sang giao hàng -->
                            <?php if ($o['order_status'] === 'confirmed'): ?>
                                <a href="index.php?controller=order&action=shipping&order_id=<?= $o['order_id'] ?>"
                                    class="btn btn-sm btn-primary mb-1"
                                    onclick="return confirm('Chuyển đơn sang ĐANG GIAO?')">
                                    <i class="fas fa-truck"></i> Giao hàng
                                </a>
                            <?php endif; ?>

                            <!-- 3.Hoàn thành đơn -->
                            <?php if ($o['order_status'] === 'shipping'): ?>
                                <a href="index.php?controller=order&action=completed&order_id=<?= $o['order_id'] ?>"
                                    class="btn btn-sm btn-success mb-1"
                                    onclick="return confirm('Đã giao thành công cho khách?')">
                                    <i class="fas fa-check-circle"></i> Hoàn thành
                                </a>
                            <?php endif; ?>

                            <!-- 4.Hủy đơn -->
                            <?php if (in_array($o['order_status'], ['pending', 'confirmed', 'shipping'])): ?>
                                <a href="index.php?controller=order&action=cancel&order_id=<?= $o['order_id'] ?>"
                                    class="btn btn-sm btn-danger mb-1"
                                    onclick="return confirm('Hủy đơn hàng này thật chứ?')">
                                    <i class="fas fa-times"></i> Hủy đơn
                                </a>
                            <?php endif; ?>

                            <!-- 5. Xóa -->
                            <?php if ($o['order_status'] === 'completed' || $o['order_status'] === 'cancelled'): ?>
                                <a href="index.php?controller=order&action=delete&order_id=<?= $o['order_id'] ?>"
                                    class="btn btn-sm btn-outline-danger mb-1"
                                    onclick="return confirm('XÓA VĨNH VIỄN đơn hàng này khỏi hệ thống?\nKhông thể khôi phục!')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>