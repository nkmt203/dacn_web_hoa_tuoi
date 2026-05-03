<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<?php
/**
 * @var array $order
 * @var array $orderDetails
 */
?>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Chi tiết đơn hàng - FlowerTown</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #e91e63;
            --primary-gradient: linear-gradient(135deg, #e91e63, #c2185b);
            --secondary-color: #C2185B;
            --accent-color: #F06292;
            --bg-color: #FFF5F7;
            --card-bg: #ffffff;
            --text-main: #2d2a24;
            --text-muted: #6b5a4c;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --radius-lg: 24px;
            --radius-md: 16px;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 12px 30px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .header-icons {
            gap: 1.2rem;
        }

        .header-icons a {
            color: var(--text-main);
            font-size: 1.4rem;
            transition: var(--transition);
            position: relative;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .header-icons a:hover {
            color: var(--accent-color);
            transform: translateY(-2px);
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            line-height: 1.6;
        }

        .heading-font {
            font-family: 'Playfair Display', serif;
        }

        .header {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .logo i {
            -webkit-text-fill-color: var(--secondary-color);
            font-size: 1.8rem;
        }

        .detail-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0,0,0,0.02);
            margin-bottom: 2rem;
        }

        .product-item {
            display: flex;
            gap: 20px;
            padding: 1.5rem 0;
            border-bottom: 1px solid #f3e9e2;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
        }

        .status-badge {
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-pending { background: #fff8e1; color: #f57f17; }
        .status-confirmed { background: #e3f2fd; color: #1976d2; }
        .status-shipping { background: #f3e5f5; color: #7b1fa2; }
        .status-completed { background: #e8f5e9; color: #2e7d32; }
        .status-cancelled { background: #fce8e8; color: #c62828; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-up {
            animation: fadeUp 0.6s cubic-bezier(0.2, 0, 0, 1) forwards;
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
                    <a href="index.php?router=customers" class="logo">
                        <i class="bi bi-flower2"></i> FlowerTown
                    </a>
                </div>
                <div class="col-6">
                    <div class="header-icons d-flex justify-content-end align-items-center">
                        <a href="index.php?router=customers" title="Trang chủ"><i class="bi bi-house-door"></i></a>
                        <a href="index.php?router=customers&controller=order&action=listOrders" title="Đơn hàng của tôi"><i class="bi bi-receipt"></i></a>
                        <?php
                        $cartCount = 0;
                        if (isset($_SESSION['customer'])) {
                            require_once __DIR__ . '/../../../models/cart_model.php';
                            $cartModel = new CartModel();
                            $cartCount = $cartModel->getCartCount($_SESSION['customer']['customer_id']);
                        }
                        ?>
                        <a href="index.php?router=customers&controller=cart&action=listCart">
                            <i class="bi bi-bag"></i>
                            <span class="cart-badge"><?= $cartCount ?></span>
                        </a>
                        <?php if (isset($_SESSION['customer'])): ?>
                            <a href="index.php?router=logout" title="Đăng xuất"><i class="bi bi-box-arrow-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container my-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="detail-card animate-fade-up">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h2 class="heading-font fw-bold mb-1">Chi tiết đơn hàng</h2>
                            <p class="text-muted small mb-0">Mã đơn: <span class="fw-bold text-dark"><?= htmlspecialchars($order['order_code']) ?></span> | Ngày đặt: <?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></p>
                        </div>
                        <?php
                        $statusLabels = [
                            'pending' => 'Chờ xử lý',
                            'confirmed' => 'Đã xác nhận',
                            'shipping' => 'Đang giao hàng',
                            'completed' => 'Đã hoàn thành',
                            'cancelled' => 'Đã hủy'
                        ];
                        ?>
                        <span class="status-badge status-<?= $order['order_status'] ?>"><?= $statusLabels[$order['order_status']] ?? $order['order_status'] ?></span>
                    </div>

                    <div class="product-list border-top border-bottom my-4">
                        <?php foreach ($orderDetails as $item): ?>
                            <div class="product-item">
                                <img src="uploads/<?= htmlspecialchars($item['image_url']) ?>" class="product-img" onerror="this.src='https://placehold.co/100x100?text=Flower'">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1"><?= htmlspecialchars($item['product_name']) ?></h6>
                                    <div class="text-muted small">Số lượng: <?= $item['quantity'] ?> × <?= number_format($item['unit_price'], 0, ',', '.') ?>đ</div>
                                </div>
                                <div class="fw-bold"><?= number_format($item['subtotal'], 0, ',', '.') ?>đ</div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 ms-auto">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Tạm tính</span>
                                <span><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Phí vận chuyển</span>
                                <span class="text-success fw-bold">Miễn phí</span>
                            </div>
                            <div class="d-flex justify-content-between mt-3 pt-3 border-top">
                                <h5 class="fw-bold">Tổng cộng</h5>
                                <h5 class="fw-bold text-danger"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="detail-card animate-fade-up" style="animation-delay: 100ms">
                    <h5 class="fw-bold mb-4">Thông tin nhận hàng</h5>
                    <div class="mb-4">
                        <div class="text-muted small fw-bold text-uppercase mb-1">Người nhận</div>
                        <div><?= htmlspecialchars($order['receiver_name']) ?></div>
                    </div>
                    <div class="mb-4">
                        <div class="text-muted small fw-bold text-uppercase mb-1">Số điện thoại</div>
                        <div><?= htmlspecialchars($order['receiver_phone']) ?></div>
                    </div>
                    <div class="mb-4">
                        <div class="text-muted small fw-bold text-uppercase mb-1">Địa chỉ giao hàng</div>
                        <div><?= htmlspecialchars($order['delivery_address']) ?></div>
                    </div>
                    <?php if ($order['note']): ?>
                    <div class="mb-4">
                        <div class="text-muted small fw-bold text-uppercase mb-1">Ghi chú</div>
                        <div class="fst-italic"><?= htmlspecialchars($order['note']) ?></div>
                    </div>
                    <?php endif; ?>
                    <div class="mb-0">
                        <div class="text-muted small fw-bold text-uppercase mb-1">Phương thức thanh toán</div>
                        <div>
                            <?php
                            $methods = ['cod' => 'Thanh toán khi nhận hàng', 'bank_transfer' => 'Chuyển khoản ngân hàng', 'e_wallet' => 'Ví điện tử'];
                            echo $methods[$order['payment_method']] ?? $order['payment_method'];
                            ?>
                        </div>
                    </div>
                </div>

                <div class="mt-4 animate-fade-up d-flex flex-column gap-3">
                    <a href="index.php?router=customers&controller=order&action=listOrders" class="btn btn-primary w-100 rounded-4 py-3 fw-bold" style="background: var(--primary-color); border: none;">
                        <i class="bi bi-list-ul"></i> QUAY LẠI DANH SÁCH
                    </a>
                    <a href="index.php?router=customers" class="btn btn-outline-secondary w-100 rounded-4 py-3 fw-bold border-2">
                        <i class="bi bi-arrow-left"></i> TIẾP TỤC MUA SẮM
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
