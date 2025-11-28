    <?php
    //Code test data

    require_once __DIR__ . '/../../../models/order_model.php';
    require_once __DIR__ . '/../../../../config/config.php';
    $oderModel = new OrderModel();

    $order_id = $_GET['order_id'];
    $oneOrder = $oderModel->getByIdOrder($order_id);

    $oneOrderDetail = $oderModel->getByIdOrderDetail($order_id);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chi tiết đơn hàng</title>
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
            <h2 class="mb-4 text-center fw-bold">Chi tiết đơn hàng</h2>
            <div class="row">
                <!-- heder các thông tin  -->
                <div class="col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-receipt me-2"></i>
                                Mã đơn hàng #<?= $oneOrder['order_code'] ?>
                            </h4>
                            <a class="btn btn-primary btn-secondary" href="index.php?controller=order&action=listOrder">
                                <i class="fa-solid fa-left-long"></i>
                                Quay lại
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="row text-center text-md-start">
                                <div class="col-md-3">
                                    <small class="text-muted">Ngày đặt hàng</small>
                                    <p class="fw-bold"><?= date('d/m/y H:i', strtotime($oneOrder['order_date'])) ?></p>
                                </div>

                                <div class="col-md-3">
                                    <small class="text-muted">Trạng thái đơn hàng</small>
                                    <p class="fw-bold">
                                        <?php
                                        $orderStatus = $oneOrder['order_status'];
                                        switch ($orderStatus) {
                                            case 'pending':
                                                $statusClass = 'warning';
                                                $statusText = 'Chờ xác nhận';
                                                break;
                                            case 'confirmed':
                                                $statusClass = 'info';
                                                $statusText = 'Đã xác nhận';
                                                break;
                                            case 'shipping':
                                                $statusClass = 'primary';
                                                $statusText = 'Đang giao';
                                                break;
                                            case 'completed':
                                                $statusClass = 'success';
                                                $statusText = 'Hoàn thành';
                                                break;
                                            case 'cancelled':
                                                $statusClass = 'danger';
                                                $statusText = 'Hủy đơn';
                                                break;
                                            default:
                                                $statusClass = 'secondary';
                                                $statusText = 'Lỗi trạng thái';
                                                break;
                                        }
                                        ?>
                                        <span class="badge status-badge bg-<?= $statusClass ?>">
                                            <?= $statusText ?>
                                        </span>
                                    </p>
                                </div>

                                <div class="col-md-3">
                                    <small class="text-muted">Thanh toán</small>
                                    <p>
                                        <?php
                                        $paymentStatus = $oneOrder['payment_status'];
                                        switch ($paymentStatus) {
                                            case 'unpaid':
                                                $statusClass = 'danger';
                                                $statusText = 'Chưa thanh toán';
                                                break;
                                            case 'paid':
                                                $statusClass = 'success';
                                                $statusText = 'Đã thanh toán';
                                                break;
                                            case 'refunded':
                                                $statusClass = 'warning';
                                                $statusText = 'Đã hoàn tiền';
                                                break;
                                            default:
                                                $statusClass = 'secondary';
                                                $statusText = 'Lỗi trạng thái';
                                                break;
                                        }
                                        ?>
                                        <span class="badge bg-<?= $statusClass ?>">
                                            <?= $statusText ?>
                                        </span>
                                    </p>
                                </div>

                                <div class="col-md-3">
                                    <small class="text-muted">Tổng tiền</small>
                                    <h4 class="text-danger fw-bold"> <?= number_format($oneOrder['total_amount'], 0, '.', '.') ?>₫</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <!-- danh sách các sản phẩm -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">
                                <i class="fas fa-box"></i>Sản phẩm trong đơn hàng
                            </h5>
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
                                    <?php foreach ($oneOrderDetail as $item): ?>
                                        <tr>
                                            <td>
                                                <?php if (!empty($item['image_url'])): ?>
                                                    <img src="../../../../uploads/<?= $item['image_url'] ?>"
                                                        alt="" class="rounded" width="100px" style="object-fit: cover;">
                                                <?php else: ?>
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>

                                            <td class="align-middle">
                                                <strong><?= $item['product_name'] ?></strong>
                                            </td>
                                            <td class="text-center align-middle"><?= $item['quantity'] ?></td>
                                            <td class="text-end align-middle"><?= number_format($item['unit_price'], 0, '.', '.') ?>₫</td>
                                            <td class="text-end align-middle fw-bold"><?= number_format($item['subtotal'], 0, '.', '.') ?>₫</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot class="border-top">
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Tổng cộng</td>
                                        <td class="text-end fw-bold text-danger fs-5">
                                            <?= number_format($oneOrder['total_amount'], 0, '.', ',') ?>₫
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <?php if (!empty($oneOrder['note'])): ?>
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-white">
                                <h6 class="mb-0"><i class="fa-solid fa-note-sticky me-2"></i>Ghi chú của khách hàng</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-0"><?= nl2br($oneOrder['note'])  ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <!-- Thông tin giao hàng -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="fa-solid fa-truck me-2"></i></i>Thông tin giao hàng</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Người nhận:</strong> <?= $oneOrder['receiver_name'] ?></p>
                            <p><strong>SĐT người nhận:</strong> <?= $oneOrder['receiver_phone'] ?></p>
                            <p><strong>Địa chỉ nhận hàng:</strong> <?= $oneOrder['delivery_address'] ?></p>
                        </div>
                    </div>

                    <!-- Thông tin khách hàng -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white d-flex justify-content-between">
                            <h6 class="mb-0"><i class="fas fa-user me-2"></i>Khách đặt hàng</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Người nhận:</strong> <?= $oneOrder['customer_name'] ?></p>
                            <p><strong>Email:</strong> <?= $oneOrder['email'] ?></p>
                            <p><strong>SDT:</strong> <?= $oneOrder['phone'] ?></p>
                        </div>
                    </div>

                    <!-- Hành động nhanh -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h6 class="mb-0">Hành động nhanh</h6>
                        </div>
                        <div class="card-body">
                            <!-- 1.Xác nhận đơn -->
                            <?php if ($oneOrder['order_status'] === 'pending'): ?>
                                <a href="index.php?controller=order&action=confirm&order_id=<?= $oneOrder['order_id'] ?>"
                                    class="btn btn-sm btn-warning mb-1"
                                    onclick="return confirm('Xác nhận đơn hàng này?')">
                                    <i class="fas fa-check"></i> Xác nhận
                                </a>
                            <?php endif; ?>

                            <!-- 2.Chuyển sang giao hàng -->
                            <?php if ($oneOrder['order_status'] === 'confirmed'): ?>
                                <a href="index.php?controller=order&action=shipping&order_id=<?= $oneOrder['order_id'] ?>"
                                    class="btn btn-sm btn-primary mb-1"
                                    onclick="return confirm('Chuyển đơn sang ĐANG GIAO?')">
                                    <i class="fas fa-truck"></i> Giao hàng
                                </a>
                            <?php endif; ?>

                            <!-- 3.Hoàn thành đơn -->
                            <?php if ($oneOrder['order_status'] === 'shipping'): ?>
                                <a href="index.php?controller=order&action=completed&order_id=<?= $oneOrder['order_id'] ?>"
                                    class="btn btn-sm btn-success mb-1"
                                    onclick="return confirm('Đã giao thành công cho khách?')">
                                    <i class="fas fa-check-circle"></i> Hoàn thành
                                </a>
                            <?php endif; ?>

                            <!-- 4.Hủy đơn -->
                            <?php if (in_array($oneOrder['order_status'], ['pending', 'confirmed', 'shipping'])): ?>
                                <a href="index.php?controller=order&action=cancelled&order_id=<?= $oneOrder['order_id'] ?>"
                                    class="btn btn-sm btn-danger mb-1"
                                    onclick="return confirm('Hủy đơn hàng này thật chứ?')">
                                    <i class="fas fa-times"></i> Hủy đơn
                                </a>
                            <?php endif; ?>

                            <!-- 5. Xóa -->
                            <?php if ($oneOrder['order_status'] === 'completed' || $oneOrder['order_status'] === 'cancelled'): ?>
                                <a href="index.php?controller=order&action=deleted&order_id=<?= $oneOrder['order_id'] ?>"
                                    class="btn btn-sm btn-outline-danger mb-1"
                                    onclick="return confirm('XÓA VĨNH VIỄN đơn hàng này khỏi hệ thống?\nKhông thể khôi phục!')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            <?php endif; ?>

                            <!-- 6. IN hóa đơn-->
                            <a href="index.php?controller=order&action=printInvoice&order_id=<?= $oneOrder['order_id'] ?>"
                                target="_blank" class="btn btn-secondary mb-1"
                                onclick="return confirm('In hóa đơn?')">
                                <i class="fas fa-print"></i> In hóa đơn
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </body>

    </html>