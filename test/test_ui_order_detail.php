    <?php
    // detail.php hoặc view khi click "Chi tiết"
    // Giả sử bạn đã có $order và $orderDetails từ Controller truyền sang

    // Nếu chưa có, ví dụ trong Controller:
    // $orderModel = new OrderModel();
    // $order = $orderModel->getOrderById($order_id);
    // $orderDetails = $orderModel->getOrderDetailsByOrderId($order_id);
    // $customer = $orderModel->getCustomerById($order['customer_id']);
    ?>

    <!DOCTYPE html>
    <html lang="vi">

    <head>
        <meta charset="UTF-8">
        <title>Chi tiết đơn hàng #<?= htmlspecialchars($order['order_code']) ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <style>
            .status-badge {
                font-size: 0.9rem;
                padding: 0.4rem 0.8rem;
            }

            .timeline {
                position: relative;
                padding-left: 40px;
            }

            .timeline::before {
                content: '';
                position: absolute;
                left: 18px;
                top: 0;
                bottom: 0;
                width: 4px;
                background: #e9ecef;
            }

            .timeline-item {
                position: relative;
                margin-bottom: 20px;
            }

            .timeline-item::before {
                content: '';
                position: absolute;
                left: -22px;
                top: 5px;
                width: 16px;
                height: 16px;
                border-radius: 50%;
                background: #007bff;
                border: 4px solid #fff;
                box-shadow: 0 0 0 4px #007bff4d;
            }

            .timeline-item.done::before {
                background: #28a745;
                box-shadow: 0 0 0 4px #28a7454d;
            }
        </style>
    </head>

    <body class="bg-light">
        <div class="container py-4">
            <div class="row">
                <!-- Header + Thông tin chung -->
                <div class="col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-receipt me-2"></i>
                                Đơn hàng #<?= htmlspecialchars($order['order_code']) ?>
                            </h4>
                            <a href="index.php?controller=order&action=list" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row text-center text-md-start">
                                <div class="col-md-3">
                                    <small class="text-muted">Ngày đặt hàng</small>
                                    <p class="fw-bold"><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Trạng thái đơn hàng</small>
                                    <p>
                                        <?php
                                        $statusClass = [
                                            'pending' => 'warning',
                                            'confirmed' => 'info',
                                            'shipping' => 'primary',
                                            'completed' => 'success',
                                            'cancelled' => 'danger'
                                        ];
                                        $statusText = [
                                            'pending' => 'Chờ xác nhận',
                                            'confirmed' => 'Đã xác nhận',
                                            'shipping' => 'Đang giao',
                                            'completed' => 'Hoàn thành',
                                            'cancelled' => 'Đã hủy'
                                        ];
                                        ?>
                                        <span class="badge status-badge bg-<?= $statusClass[$order['order_status']] ?? 'secondary' ?>">
                                            <?= $statusText[$order['order_status']] ?? 'Không xác định' ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Thanh toán</small>
                                    <p>
                                        <span class="badge bg-<?= $order['payment_status'] == 'paid' ? 'success' : 'danger' ?>">
                                            <?= $order['payment_status'] == 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Tổng tiền</small>
                                    <h4 class="text-danger fw-bold">
                                        <?= number_format($order['total_amount'], 0, '.', '.') ?> ₫
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <!-- Danh sách sản phẩm -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fas fa-box-open me-2"></i>Sản phẩm trong đơn hàng</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="80">Hình</th>
                                        <th>Sản phẩm</th>
                                        <th width="100" class="text-center">SL</th>
                                        <th width="150" class="text-end">Đơn giá</th>
                                        <th width="150" class="text-end">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listOrderDetail as $item): ?>
                                        <tr>
                                            <td>
                                                <?php if (!empty($item['image_url'])): ?>
                                                    <img src="<?= htmlspecialchars($item['image_url']) ?>" class="rounded" width="60" height="60" style="object-fit: cover;">
                                                <?php else: ?>
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="align-middle">
                                                <strong><?= htmlspecialchars($item['product_name']) ?></strong>
                                            </td>
                                            <td class="text-center align-middle"><?= $item['quantity'] ?></td>
                                            <td class="text-end align-middle"><?= number_format($item['unit_price'], 0, '.', '.') ?> ₫</td>
                                            <td class="text-end align-middle fw-bold"><?= number_format($item['subtotal'], 0, '.', '.') ?> ₫</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot class="border-top">
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                                        <td class="text-end fw-bold text-danger fs-5">
                                            <?= number_format($order['total_amount'], 0, '.', '.') ?> ₫
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Ghi chú của khách -->
                    <?php if (!empty($order['note'])): ?>
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-white">
                                <h6 class="mb-0"><i class="fas fa-sticky-note me-2"></i>Ghi chú từ khách hàng</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-0"><?= nl2br(htmlspecialchars($order['note'])) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4">
                    <!-- Thông tin giao hàng -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="fas fa-truck me-2"></i>Thông tin giao hàng</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Họ tên:</strong> <?= htmlspecialchars($order['receiver_name']) ?></p>
                            <p><strong>SĐT:</strong> <?= htmlspecialchars($order['receiver_phone']) ?></p>
                            <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['delivery_address']) ?></p>
                        </div>
                    </div>

                    <!-- Thông tin khách hàng -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white d-flex justify-content-between">
                            <h6 class="mb-0"><i class="fas fa-user me-2"></i>Khách hàng</h6>
                            <a href="index.php?controller=customer&action=detail&customer_id=<?= $order['customer_id'] ?>" class="btn btn-sm btn-outline-primary">Xem hồ sơ</a>
                        </div>
                        <div class="card-body">
                            <p><strong><?= htmlspecialchars($order['customer_name']) ?></strong></p>
                            <p class="text-muted small"><?= htmlspecialchars($order['email']) ?></p>
                            <p class="text-muted small"><?= htmlspecialchars($order['phone'] ?? 'Chưa có') ?></p>
                        </div>
                    </div>

                    <!-- Hành động nhanh -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h6 class="mb-0">Hành động</h6>
                        </div>
                        <div class="card-body">
                            <?php if ($order['order_status'] === 'pending'): ?>
                                <a href="index.php?controller=order&action=confirm&order_id=<?= $order['order_id'] ?>"
                                    class="btn btn-warning btn-sm w-100 mb-2" onclick="return confirm('Xác nhận đơn hàng này?')">
                                    <i class="fas fa-check"></i> Xác nhận đơn
                                </a>
                            <?php endif; ?>

                            <?php if ($order['order_status'] === 'confirmed' || $order['order_status'] === 'shipping'): ?>
                                <a href="index.php?controller=order&action=setShipping&order_id=<?= $order['order_id'] ?>"
                                    class="btn btn-primary btn-sm w-100 mb-2">
                                    <i class="fas fa-truck"></i> Chuyển sang đang giao
                                </a>
                            <?php endif; ?>

                            <?php if ($order['order_status'] === 'shipping'): ?>
                                <a href="index.php?controller=order&action=complete&order_id=<?= $order['order_id'] ?>"
                                    class="btn btn-success btn-sm w-100 mb-2" onclick="return confirm('Hoàn thành đơn hàng?')">
                                    <i class="fas fa-check-circle"></i> Hoàn thành
                                </a>
                            <?php endif; ?>

                            <?php if (!in_array($order['order_status'], ['completed', 'cancelled'])): ?>
                                <a href="index.php?controller=order&action=cancel&order_id=<?= $order['order_id'] ?>"
                                    class="btn btn-danger btn-sm w-100 mb-2" onclick="return confirm('Hủy đơn hàng này?')">
                                    <i class="fas fa-times"></i> Hủy đơn hàng
                                </a>
                            <?php endif; ?>

                            <a href="index.php?controller=order&action=printInvoice&order_id=<?= $order['order_id'] ?>"
                                target="_blank" class="btn btn-outline-secondary btn-sm w-100">
                                <i class="fas fa-print"></i> In hóa đơn
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>