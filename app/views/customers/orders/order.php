<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<?php
/**
 * @var array $listCart
 * @var array $customer
 */
?>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Đặt hàng - FlowerTown</title>

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

        .checkout-container {
            margin-top: 3rem;
        }

        .checkout-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0,0,0,0.02);
            height: 100%;
        }

        .form-label {
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.8rem 1rem;
            border: 1px solid #eee;
            background-color: #fafafa;
            transition: var(--transition);
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(224, 90, 126, 0.1);
            border-color: var(--primary-color);
            background-color: #fff;
        }

        .order-summary-item {
            display: flex;
            gap: 15px;
            padding: 1rem 0;
            border-bottom: 1px solid #f3e9e2;
        }

        .order-summary-item:last-child {
            border-bottom: none;
        }

        .order-summary-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 12px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f3e9e2;
            font-size: 1.4rem;
            font-weight: 800;
        }

        .btn-place-order {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 1.2rem;
            border-radius: 16px;
            font-weight: 800;
            font-size: 1.1rem;
            transition: var(--transition);
            width: 100%;
            margin-top: 2rem;
        }

        .btn-place-order:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(224, 90, 126, 0.25);
            color: white;
        }

        .payment-method-card {
            border: 2px solid #eee;
            border-radius: 16px;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .payment-method-card:hover {
            border-color: var(--accent-color);
            background: #fffdfb;
        }

        .payment-method-card input:checked + .card-content {
            color: var(--primary-color);
        }

        .payment-method-card.active {
            border-color: var(--primary-color);
            background: #fffafa;
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
                <div class="col-6 text-end d-flex justify-content-end gap-3">
                    <a href="index.php?router=customers" class="text-muted text-decoration-none small fw-bold">
                        <i class="bi bi-house-door"></i> TRANG CHỦ
                    </a>
                    <a href="index.php?router=customers&controller=cart&action=listCart" class="text-muted text-decoration-none small fw-bold">
                        <i class="bi bi-bag"></i> GIỎ HÀNG
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container checkout-container mb-5">
        <h1 class="heading-font fw-bold mb-4 animate-fade-up">Hoàn tất đặt hàng</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger rounded-4 shadow-sm border-0 mb-4 animate-fade-up" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="index.php?router=customers&controller=order&action=placeOrder" method="POST">
            <div class="row g-4">
                <div class="col-lg-7 animate-fade-up">
                    <div class="checkout-card">
                        <h3 class="heading-font mb-4">Thông tin giao hàng</h3>
                        
                        <div class="mb-3">
                            <label class="form-label">Họ và tên người nhận</label>
                            <input type="text" name="receiver_name" class="form-control" value="<?= htmlspecialchars($customer['full_name']) ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="tel" name="receiver_phone" class="form-control" value="<?= htmlspecialchars($customer['phone'] ?? '') ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ giao hàng</label>
                            <textarea name="delivery_address" class="form-control" rows="3" required><?= htmlspecialchars($customer['address'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Ghi chú (tùy chọn)</label>
                            <textarea name="note" class="form-control" rows="2" placeholder="Ví dụ: Giao giờ hành chính, lời nhắn đính kèm hoa..."></textarea>
                        </div>

                        <h3 class="heading-font mb-4 mt-5">Phương thức thanh toán</h3>
                        
                        <div class="payment-methods">
                            <label class="payment-method-card active">
                                <input type="radio" name="payment_method" value="cod" checked class="d-none">
                                <i class="bi bi-cash-stack fs-3 text-success"></i>
                                <div>
                                    <div class="fw-bold">Thanh toán khi nhận hàng (COD)</div>
                                    <div class="small text-muted">Nhận hoa và thanh toán tiền mặt cho shipper</div>
                                </div>
                            </label>
                            
                            <label class="payment-method-card opacity-50" style="cursor: not-allowed;">
                                <i class="bi bi-bank fs-3 text-primary"></i>
                                <div>
                                    <div class="fw-bold">Chuyển khoản ngân hàng <span class="badge bg-secondary ms-2" style="font-size: 0.6rem;">Sắp ra mắt</span></div>
                                    <div class="small text-muted">Thanh toán qua số tài khoản ngân hàng</div>
                                </div>
                            </label>

                            <label class="payment-method-card opacity-50" style="cursor: not-allowed;">
                                <i class="bi bi-wallet2 fs-3 text-warning"></i>
                                <div>
                                    <div class="fw-bold">Ví điện tử <span class="badge bg-secondary ms-2" style="font-size: 0.6rem;">Sắp ra mắt</span></div>
                                    <div class="small text-muted">Momo, ZaloPay, Viettel Money</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 animate-fade-up" style="animation-delay: 100ms">
                    <div class="checkout-card">
                        <h3 class="heading-font mb-4">Tóm tắt đơn hàng</h3>
                        
                        <div class="order-items mb-4">
                            <?php $total = 0; ?>
                            <?php foreach ($listCart as $item): ?>
                                <?php
                                $price = $item['discounted_price'] ?? $item['price'];
                                $subtotal = $price * $item['quantity'];
                                $total += $subtotal;
                                ?>
                                <div class="order-summary-item">
                                    <img src="uploads/<?= htmlspecialchars($item['image_url']) ?>" class="order-summary-img" onerror="this.src='https://placehold.co/100x100?text=Flower'">
                                    <div class="flex-grow-1">
                                        <div class="fw-bold small"><?= htmlspecialchars($item['product_name']) ?></div>
                                        <div class="text-muted small">SL: <?= $item['quantity'] ?> × <?= number_format($price, 0, ',', '.') ?>đ</div>
                                    </div>
                                    <div class="fw-bold small"><?= number_format($subtotal, 0, ',', '.') ?>đ</div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="summary-details">
                            <div class="summary-row">
                                <span class="text-muted">Tạm tính</span>
                                <span><?= number_format($total, 0, ',', '.') ?>đ</span>
                            </div>
                            <div class="summary-row">
                                <span class="text-muted">Phí vận chuyển</span>
                                <span class="text-success fw-bold">Miễn phí</span>
                            </div>
                            
                            <div class="total-row">
                                <span>Tổng cộng</span>
                                <span style="color: var(--primary-color)"><?= number_format($total, 0, ',', '.') ?>đ</span>
                            </div>
                        </div>

                        <button type="submit" class="btn-place-order">
                            XÁC NHẬN ĐẶT HÀNG
                        </button>

                        <a href="index.php?router=customers&controller=cart&action=listCart" class="btn btn-outline-secondary w-100 rounded-4 py-3 mt-3 fw-bold border-2">
                            <i class="bi bi-bag"></i> QUAY LẠI GIỎ HÀNG
                        </a>
                        
                        <div class="text-center mt-4 text-muted small">
                            <i class="bi bi-shield-lock-fill"></i> Giao dịch của bạn được bảo mật tuyệt đối
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.payment-method-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.payment-method-card').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                this.querySelector('input').checked = true;
            });
        });
    </script>
</body>

</html>
