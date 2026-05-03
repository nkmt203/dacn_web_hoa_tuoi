<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<?php
/**
 * @var array $orders
 */
?>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Đơn hàng của tôi - FlowerTown</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #e91e63;
            --primary-gradient: linear-gradient(135deg, #e91e63, #c2185b);
            --bg-color: #FFF5F7;
            --card-bg: #ffffff;
            --text-main: #2d2a24;
            --text-muted: #6b5a4c;
            --radius-md: 20px;
            --shadow-sm: 0 8px 20px rgba(194, 24, 91, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            line-height: 1.6;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .logo {
            font-size: 1.6rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-icons {
            gap: 1.2rem;
        }

        .header-icons a {
            color: var(--text-main);
            font-size: 1.5rem;
            position: relative;
            text-decoration: none;
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background: var(--primary-color);
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

        /* Upscaled Order Card */
        .order-card {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            padding: 1.2rem 1.8rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0,0,0,0.02);
            margin-bottom: 1.2rem;
            transition: var(--transition);
        }

        .order-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(224, 90, 126, 0.1);
        }

        .card-inner {
            display: flex;
            align-items: center;
            gap: 2rem;
            width: 100%;
        }

        .order-img-wrapper {
            position: relative;
            width: 70px;
            height: 70px;
            flex-shrink: 0;
        }

        .order-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        .more-items {
            position: absolute;
            bottom: -5px;
            right: -5px;
            background: var(--primary-color);
            color: white;
            font-size: 0.6rem;
            padding: 2px 6px;
            border-radius: 50px;
            border: 2px solid white;
        }

        .order-main-info {
            flex: 1;
            min-width: 0;
        }

        .order-code {
            font-weight: 800;
            font-size: 1.15rem;
            color: var(--text-main);
            display: block;
            margin-bottom: 2px;
        }

        .order-date {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .order-meta-info {
            display: flex;
            align-items: center;
            gap: 3rem;
            flex-shrink: 0;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            min-width: 110px;
        }

        .meta-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #bbb;
            margin-bottom: 3px;
        }

        .meta-val {
            font-weight: 700;
            font-size: 1rem;
        }

        .status-badge {
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-pending { background: #fff8e1; color: #f57f17; }
        .status-confirmed { background: #e3f2fd; color: #1976d2; }
        .status-shipping { background: #f3e5f5; color: #7b1fa2; }
        .status-completed { background: #e8f5e9; color: #2e7d32; }
        .status-cancelled { background: #ffebee; color: #c62828; }

        .btn-view {
            padding: 10px 22px;
            border-radius: 14px;
            background: #FCE4EC;
            color: var(--primary-color);
            font-weight: 800;
            font-size: 0.9rem;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-view:hover {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3);
        }

        /* Mobile Responsive */
        @media (max-width: 991px) {
            .order-meta-info {
                gap: 1.5rem;
            }
        }

        @media (max-width: 767px) {
            .order-card {
                padding: 1.2rem;
            }
            .card-inner {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }
            .order-top-row {
                display: flex;
                align-items: flex-start;
                gap: 1rem;
                width: 100%;
                border-bottom: 1px solid #f8f8f8;
                padding-bottom: 0.8rem;
            }
            .order-meta-info {
                flex-direction: row;
                flex-wrap: wrap;
                width: 100%;
                gap: 1rem;
                align-items: flex-start;
            }
            .meta-item {
                min-width: calc(50% - 0.5rem);
                flex: 1;
            }
            .meta-item.d-none.d-md-flex {
                display: flex !important;
                min-width: 100%;
                margin-bottom: 0.2rem;
            }
            .btn-view {
                width: 100%;
                text-align: center;
                padding: 10px;
                font-size: 0.9rem;
                margin-top: 0.5rem;
            }
        }

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
                <div class="col-6 text-end">
                    <div class="header-icons d-flex justify-content-end align-items-center">
                        <a href="index.php?router=customers" title="Trang chủ"><i class="bi bi-house-door"></i></a>
                        <a href="index.php?router=customers&controller=order&action=listOrders" title="Đơn hàng"><i class="bi bi-receipt"></i></a>
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
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container my-5" style="max-width: 1000px;">
        <h1 class="heading-font fw-bold mb-5 animate-fade-up">Đơn hàng của tôi</h1>

        <?php if (empty($orders)): ?>
            <div class="text-center py-5 animate-fade-up">
                <i class="bi bi-receipt-cutoff display-1 text-muted opacity-25"></i>
                <h3 class="fw-bold mt-4">Chưa có đơn hàng nào</h3>
                <p class="text-muted">Bạn chưa chọn được bó hoa nào sao?</p>
                <a href="index.php?router=customers" class="btn btn-primary rounded-pill px-5 py-3 mt-4 fw-bold" style="background: var(--primary-gradient); border: none;">MUA SẮM NGAY</a>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($orders as $order): ?>
                    <div class="col-12 animate-fade-up">
                        <div class="order-card">
                            <div class="card-inner">
                                <div class="order-top-row">
                                    <div class="order-img-wrapper">
                                        <img src="uploads/<?= htmlspecialchars($order['first_product_image']) ?>" 
                                             class="order-thumb" 
                                             onerror="this.src='https://placehold.co/100x100?text=Flower'">
                                        <?php if ($order['total_products'] > 1): ?>
                                            <span class="more-items">+<?= $order['total_products'] - 1 ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="order-main-info">
                                        <span class="order-code"><?= htmlspecialchars($order['order_code']) ?></span>
                                        <span class="order-date"><i class="bi bi-calendar3 me-1"></i> <?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></span>
                                    </div>
                                </div>

                                <div class="order-meta-info">
                                    <div class="meta-item d-none d-md-flex">
                                        <span class="meta-label">Trạng thái</span>
                                        <?php
                                        $statusLabels = [
                                            'pending' => 'Chờ xử lý',
                                            'confirmed' => 'Đã xác nhận',
                                            'shipping' => 'Đang giao hàng',
                                            'completed' => 'Đã hoàn thành',
                                            'cancelled' => 'Đã hủy'
                                        ];
                                        ?>
                                        <span class="status-badge status-<?= $order['order_status'] ?>" style="width: fit-content;">
                                            <?= $statusLabels[$order['order_status']] ?? $order['order_status'] ?>
                                        </span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Tổng cộng</span>
                                        <span class="meta-val text-danger fs-5"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Phương thức</span>
                                        <span class="meta-val">
                                            <?php
                                            $methods = ['cod' => 'Tiền mặt (COD)', 'bank_transfer' => 'Chuyển khoản', 'e_wallet' => 'Ví điện tử'];
                                            echo $methods[$order['payment_method']] ?? $order['payment_method'];
                                            ?>
                                        </span>
                                    </div>
                                    <a href="index.php?router=customers&controller=order&action=viewDetail&id=<?= $order['order_id'] ?>" class="btn-view">
                                        XEM CHI TIẾT
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="text-center mt-5">
            <a href="index.php?router=customers" class="text-muted text-decoration-none fw-bold">
                <i class="bi bi-arrow-left me-1"></i> TIẾP TỤC MUA SẮM
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
